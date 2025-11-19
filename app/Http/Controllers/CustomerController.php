<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Customer::query();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $editUrl = route('customers.edit', $row->id);
                    $deleteUrl = route('customers.destroy', $row->id);
                    
                    $btn = '<button class="btn btn-sm btn-warning editBtn" data-url="'.$editUrl.'">Edit</button> ';
                    $btn .= '<button class="btn btn-sm btn-danger deleteBtn" data-url="'.$deleteUrl.'">Hapus</button>';
                    
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.customers.index');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:150',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:30',
            'email' => 'nullable|email|max:150',
        ], [
            'name.required' => 'Nama customer wajib diisi.',
            'name.max' => 'Nama customer maksimal 150 karakter.',
            'phone.max' => 'Nomor telepon maksimal 30 karakter.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email maksimal 150 karakter.',
        ]);

        try {
            Customer::create([
                'name' => $validatedData['name'],
                'address' => $validatedData['address'] ?? null,
                'phone' => $validatedData['phone'] ?? null,
                'email' => $validatedData['email'] ?? null,
            ]);

            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'msg' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        try {
            $customer = Customer::findOrFail($id);

            return response()->json([
                'status' => 'success',
                'data' => $customer
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
            'name.required' => 'Nama customer wajib diisi.',
            'name.max' => 'Nama customer maksimal 150 karakter.',
            'phone.max' => 'Nomor telepon maksimal 30 karakter.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email maksimal 150 karakter.',
        ]);

        try {
            $customer = Customer::findOrFail($id);

            $customer->update([
                'name' => $validatedData['name'],
                'address' => $validatedData['address'] ?? null,
                'phone' => $validatedData['phone'] ?? null,
                'email' => $validatedData['email'] ?? null,
            ]);

            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'msg' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $customer = Customer::findOrFail($id);
            $customer->delete();

            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'msg' => $e->getMessage()]);
        }
    }
}