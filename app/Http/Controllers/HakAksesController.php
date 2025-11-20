<?php

namespace App\Http\Controllers;

use App\Models\HakAkses;
use App\Models\Menu;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class HakAksesController extends Controller
{
    public function index(Request $request)
    {
        // Ambil semua user untuk dropdown
        $users = User::all();

        // Cek permission untuk tombol simpan
        $permissions = [
            'edit' => 1 // Sesuaikan dengan sistem permission Anda
        ];

        if ($request->ajax()) {
            $userId = $request->get('user_id');

            if (!$userId) {
                return response()->json(['data' => []]);
            }

            // Ambil semua menu dengan relasi children
            $menus = Menu::with('children')
                ->whereNull('id_parent')
                ->orWhere('id_parent', 0)
                ->orderBy('urutan')
                ->get();

            // Ambil hak akses user yang dipilih
            $hakAkses = HakAkses::where('id_user', $userId)
                ->pluck('id_menu')
                ->toArray();

            $hakAksesData = HakAkses::where('id_user', $userId)
                ->get()
                ->keyBy('id_menu');

            $data = [];
            $no = 1;

            foreach ($menus as $parent) {
                // Parent menu
                $parentAccess = $hakAksesData->get($parent->id);
                
                $data[] = [
                    'no' => $no++,
                    'id' => $parent->id,
                    'parent_menu' => '-',
                    'title' => '<strong>' . $parent->title . '</strong>',
                    'route_name' => $parent->route_name ?? '-',
                    'lihat' => $this->generateCheckbox($userId, $parent->id, 'lihat', $parentAccess ? $parentAccess->lihat : 0),
                    'beranda' => $this->generateCheckbox($userId, $parent->id, 'beranda', $parentAccess ? $parentAccess->beranda : 0),
                    'tambah' => $this->generateCheckbox($userId, $parent->id, 'tambah', $parentAccess ? $parentAccess->tambah : 0),
                    'edit' => $this->generateCheckbox($userId, $parent->id, 'edit', $parentAccess ? $parentAccess->edit : 0),
                    'hapus' => $this->generateCheckbox($userId, $parent->id, 'hapus', $parentAccess ? $parentAccess->hapus : 0),
                ];

                // Children menu
                if ($parent->children->count() > 0) {
                    foreach ($parent->children as $child) {
                        $childAccess = $hakAksesData->get($child->id);
                        
                        $data[] = [
                            'no' => $no++,
                            'id' => $child->id,
                            'parent_menu' => $parent->title,
                            'title' => '&nbsp;&nbsp;&nbsp;↳ ' . $child->title,
                            'route_name' => $child->route_name ?? '-',
                            'lihat' => $this->generateCheckbox($userId, $child->id, 'lihat', $childAccess ? $childAccess->lihat : 0),
                            'beranda' => $this->generateCheckbox($userId, $child->id, 'beranda', $childAccess ? $childAccess->beranda : 0),
                            'tambah' => $this->generateCheckbox($userId, $child->id, 'tambah', $childAccess ? $childAccess->tambah : 0),
                            'edit' => $this->generateCheckbox($userId, $child->id, 'edit', $childAccess ? $childAccess->edit : 0),
                            'hapus' => $this->generateCheckbox($userId, $child->id, 'hapus', $childAccess ? $childAccess->hapus : 0),
                        ];
                    }
                }
            }

            return DataTables::of(collect($data))
                ->rawColumns(['title', 'lihat', 'beranda', 'tambah', 'edit', 'hapus'])
                ->make(true);
        }

        return view('admin.hak_akses.index', compact('users', 'permissions'));
    }

    private function generateCheckbox($userId, $menuId, $type, $checked = 0)
    {
        $isChecked = $checked == 1 ? 'checked' : '';
        return '<input type="checkbox" 
                    class="form-check-input checkbox-akses" 
                    data-user="'.$userId.'" 
                    data-menu="'.$menuId.'" 
                    data-type="'.$type.'" 
                    '.$isChecked.'>';
    }

    public function store(Request $request)
    {
        try {
            $userId = $request->user_id;
            $permissions = $request->permissions; // Array dari checkbox yang dicentang

            DB::beginTransaction();

            // Hapus semua hak akses user ini dulu
            HakAkses::where('id_user', $userId)->delete();

            // Group permissions by menu_id
            $groupedPermissions = [];
            
            foreach ($permissions as $perm) {
                $menuId = $perm['menu_id'];
                $type = $perm['type'];
                
                if (!isset($groupedPermissions[$menuId])) {
                    $groupedPermissions[$menuId] = [
                        'id_user' => $userId,
                        'id_menu' => $menuId,
                        'lihat' => 0,
                        'beranda' => 0,
                        'tambah' => 0,
                        'edit' => 0,
                        'hapus' => 0,
                    ];
                }
                
                $groupedPermissions[$menuId][$type] = 1;
            }

            // Insert ke database
            foreach ($groupedPermissions as $data) {
                HakAkses::create($data);
            }

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Hak akses berhasil disimpan'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menyimpan hak akses: ' . $e->getMessage()
            ], 500);
        }
    }
}