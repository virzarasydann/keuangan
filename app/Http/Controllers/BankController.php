<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\ChartOfAccounts;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BankController extends Controller
{
    public function index(Request $request)
    {
        // Ambil data COA untuk select dropdown
        $coa = ChartOfAccounts::all();

        if ($request->ajax()) {
            $data = Bank::with('coa')->select('bank_accounts.*');

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('coa_name', function ($row) {
                    return $row->coa ? $row->coa->name : '-';
                })
                ->addColumn('opening_balance_formatted', function ($row) {
                    return 'Rp ' . number_format($row->opening_balance, 0, ',', '.');
                })
                ->addColumn('action', function ($row) {
                    $editUrl   = route('bank-accounts.edit', $row->id);
                    $deleteUrl = route('bank-accounts.destroy', $row->id);
                
                    $btn  = '<button class="btn btn-sm btn-warning editBtn" data-id="'.$row->id.'" data-url="'.$editUrl.'">Edit</button> ';
                    $btn .= '<button class="btn btn-sm btn-danger deleteBtn" data-id="'.$row->id.'" data-url="'.$deleteUrl.'">Hapus</button>';
                
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.bank.index', compact('coa'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'account_name'    => 'required|string|max:100',
            'account_number'  => 'required|string|max:50',
            'bank_name'       => 'required|string|max:100',
            'coa_id'          => 'required|exists:chart_of_accounts,id',
            'opening_balance' => 'required|numeric|min:0',
        ], [
            'account_name.required'    => 'Nama Akun wajib diisi.',
            'account_number.required'  => 'Nomor Rekening wajib diisi.',
            'bank_name.required'       => 'Nama Bank wajib diisi.',
            'coa_id.required'          => 'Chart of Account wajib dipilih.',
            'coa_id.exists'            => 'Chart of Account tidak valid.',
            'opening_balance.required' => 'Saldo Awal wajib diisi.',
            'opening_balance.numeric'  => 'Saldo Awal harus berupa angka.',
            'opening_balance.min'      => 'Saldo Awal minimal 0.',
        ]);

        try {
            Bank::create([
                'account_name'    => $validatedData['account_name'],
                'account_number'  => $validatedData['account_number'],
                'bank_name'       => $validatedData['bank_name'],
                'coa_id'          => $validatedData['coa_id'],
                'opening_balance' => $validatedData['opening_balance'],
            ]);

            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'msg' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        try {
            $bank = Bank::findOrFail($id);

            return response()->json([
                'status' => 'success',
                'data' => [
                    'id'              => $bank->id,
                    'account_name'    => $bank->account_name,
                    'account_number'  => $bank->account_number,
                    'bank_name'       => $bank->bank_name,
                    'coa_id'          => $bank->coa_id,
                    'opening_balance' => $bank->opening_balance,
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'msg' => $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'account_name'    => 'required|string|max:100',
            'account_number'  => 'required|string|max:50',
            'bank_name'       => 'required|string|max:100',
            'coa_id'          => 'required|exists:chart_of_accounts,id',
            'opening_balance' => 'required|numeric|min:0',
        ], [
            'account_name.required'    => 'Nama Akun wajib diisi.',
            'account_number.required'  => 'Nomor Rekening wajib diisi.',
            'bank_name.required'       => 'Nama Bank wajib diisi.',
            'coa_id.required'          => 'Chart of Account wajib dipilih.',
            'coa_id.exists'            => 'Chart of Account tidak valid.',
            'opening_balance.required' => 'Saldo Awal wajib diisi.',
            'opening_balance.numeric'  => 'Saldo Awal harus berupa angka.',
            'opening_balance.min'      => 'Saldo Awal minimal 0.',
        ]);

        try {
            $bank = Bank::findOrFail($id);

            $bank->update([
                'account_name'    => $validatedData['account_name'],
                'account_number'  => $validatedData['account_number'],
                'bank_name'       => $validatedData['bank_name'],
                'coa_id'          => $validatedData['coa_id'],
                'opening_balance' => $validatedData['opening_balance'],
            ]);

            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'msg' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $bank = Bank::findOrFail($id);
            $bank->delete();

            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'msg' => $e->getMessage()]);
        }
    }
}