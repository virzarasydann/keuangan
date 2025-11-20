<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class VendorController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Vendor::query();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $editUrl = route('vendors.edit', $row->id);
                    $deleteUrl = route('vendors.destroy', $row->id);

                    $btn = '<button class="btn btn-sm btn-warning editBtn" data-url="'.$editUrl.'">Edit</button> ';
                    $btn .= '<button class="btn btn-sm btn-danger deleteBtn" data-url="'.$deleteUrl.'">Hapus</button>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.vendors.index');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:150',
            'address' => 'required|string',
            'phone' => 'required|string|max:30',
            'email' => 'required|email|max:150',
        ], [
            'name.required' => 'Nama customer wajib diisi.',
            'name.max' => 'Nama customer maksimal 150 karakter.',
            'address.required' => 'Alamat wajib diisi',
            'phone.max' => 'Nomor telepon maksimal 30 karakter.',
            'phone.required' => 'Nomor telepon wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email maksimal 150 karakter.',
        ]);

        try {
            Vendor::create($validatedData);

            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'msg' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        try {
            $vendor = Vendor::findOrFail($id);

            return response()->json([
                'status' => 'success',
                'data' => $vendor
            ]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'msg' => $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:150',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:30',
            'email' => 'nullable|email|max:150',
        ], [
            'name.required' => 'Nama vendor wajib diisi.',
            'email.email' => 'Format email tidak valid.',
        ]);

        try {
            $vendor = Vendor::findOrFail($id);
            $vendor->update($validatedData);

            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'msg' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $vendor = Vendor::findOrFail($id);
            $vendor->delete();

            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'msg' => $e->getMessage()]);
        }
    }
}