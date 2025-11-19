<?php

namespace App\Http\Controllers;

use App\Models\Departments;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DepartmentsController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Departments::query();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $editUrl = route('departments.edit', $row->id);
                    $deleteUrl = route('departments.destroy', $row->id);
                    
                    $btn = '<button class="btn btn-sm btn-warning editBtn" data-url="'.$editUrl.'">Edit</button> ';
                    $btn .= '<button class="btn btn-sm btn-danger deleteBtn" data-url="'.$deleteUrl.'">Hapus</button>';
                    
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.departments.index');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string|max:255',
        ], [
            'name.required' => 'Nama department wajib diisi.',
            'name.max' => 'Nama department maksimal 100 karakter.',
        ]);

        try {
            Departments::create([
                'name' => $validatedData['name'],
                'description' => $validatedData['description'] ?? null,
            ]);

            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'msg' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        try {
            $department = Departments::findOrFail($id);

            return response()->json([
                'status' => 'success',
                'data' => $department
            ]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'msg' => $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string|max:255',
        ], [
            'name.required' => 'Nama department wajib diisi.',
            'name.max' => 'Nama department maksimal 100 karakter.',
        ]);

        try {
            $department = Departments::findOrFail($id);

            $department->update([
                'name' => $validatedData['name'],
                'description' => $validatedData['description'] ?? null,
            ]);

            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'msg' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $department = Departments::findOrFail($id);
            $department->delete();

            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'msg' => $e->getMessage()]);
        }
    }
}