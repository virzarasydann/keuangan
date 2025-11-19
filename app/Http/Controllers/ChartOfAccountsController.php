<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChartOfAccounts;
use Yajra\DataTables\Facades\DataTables;
class ChartOfAccountsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = ChartOfAccounts::query();

            return DataTables::of($data)
                ->addIndexColumn() // untuk DT_RowIndex
                ->addColumn('action', function ($row) {

                    $editUrl   = route('chart-of-accounts.edit', $row->id);
                    $deleteUrl = route('chart-of-accounts.destroy', $row->id);
                
                    $btn  = '<button class="btn btn-sm btn-warning editBtn" data-id="'.$row->id.'" data-url="'.$editUrl.'">Edit</button> ';
                    $btn .= '<button class="btn btn-sm btn-danger deleteBtn" data-id="'.$row->id.'" data-url="'.$deleteUrl.'">Hapus</button>';
                
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.chart_of_accounts.index'); // halaman blade Anda
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
        $validatedData = $request->validate([
            'code' => 'required|string|max:50',
            'name' => 'required|string|max:100',
            'type' => 'required|string|max:50',
            'description' => 'nullable|string|max:255',
        ], [
            'code.required' => 'Code wajib diisi.',
            'name.required' => 'Name wajib diisi.',
            'type.required' => 'Type wajib diisi.',
        ]);

        try {
            ChartOfAccounts::create([
                'code'        => $validatedData['code'],
                'name'        => $validatedData['name'],
                'type'        => $validatedData['type'],
                'description' => $validatedData['description'] ?? null,
            ]);

            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'msg' => $e]);
        }
    }
    


    public function update(Request $request, $id)
    {
        
        $validatedData = $request->validate([
            'code' => 'required|string|max:50',
            'name' => 'required|string|max:100',
            'type' => 'required|string|max:50',
            'description' => 'nullable|string|max:255',
        ], [
            'code.required' => 'Code wajib diisi.',
            'name.required' => 'Name wajib diisi.',
            'type.required' => 'Type wajib diisi.',
        ]);

        try {
            $coa = ChartOfAccounts::findOrFail($id);

            $coa->update([
                'code'        => $validatedData['code'],
                'name'        => $validatedData['name'],
                'type'        => $validatedData['type'],
                'description' => $validatedData['description'] ?? null,
            ]);

            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error']);
        }
    }






    public function destroy($id)
    {
        try {
            $coa = ChartOfAccounts::findOrFail($id);
            $coa->delete();

            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $coa = ChartOfAccounts::findOrFail($id);

        return response()->json([
            'status' => 'success',
            'data'   => $coa,
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    

    /**
     * Remove the specified resource from storage.
     */
    
}
