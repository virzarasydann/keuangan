<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

use App\Models\User;
use App\Models\HakAkses;
use App\Models\Menu;
class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('admin.login');
    }

    public function postLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ], [
            'username.required' => 'Username harus diisi.',
            'password.required' => 'Password harus diisi.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validasi gagal.',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = User::where('username', $request->username)->first();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Username tidak ditemukan.'
            ], 404);
        }

        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Password salah.'
            ], 401);
        }

        Auth::login($user);

        // Ambil menu untuk user dan simpan ke session
        $menus = $this->getMenuForUser($user->id);
        session(['user_menus' => $menus]);

        // Cari route pertama yang diizinkan untuk user
        $redirectRoute = $this->getDefaultRedirectRoute($user);

        return response()->json([
            'status' => 'success',
            'message' => 'Login berhasil.',
            'redirect' => route($redirectRoute),
            'user' => $user
        ], 200);
    }

    private function getMenuForUser($userId)
    {
        $allowedMenuIds = HakAkses::where('id_user', $userId)
            ->where('lihat', 1)
            ->pluck('id_menu')
            ->toArray();

        return Menu::where('id_parent', 0)
            ->whereIn('id', $allowedMenuIds)
            ->with(['children' => function($query) use ($allowedMenuIds) {
                $query->whereIn('id', $allowedMenuIds)
                      ->orderBy('urutan');
            }])
            ->orderBy('urutan')
            ->get()
            ->toArray(); // Convert to array for session storage
    }

    private function getDefaultRedirectRoute($user)
    {
        $hakAkses = HakAkses::where('id_user', $user->id)
            ->where('lihat', 1)
            ->with('menu')
            ->first();

        if ($hakAkses && $hakAkses->menu && $hakAkses->menu->route_name) {
            return $hakAkses->menu->route_name;
        }

        return 'bank-accounts.index';
    }

    


    public function logout(): RedirectResponse
    {
        Auth::guard('web')->logout();

        return redirect()->route('login')->with('success', 'Logout Berhasil.');
    }

    /**
     * Store a newly created resource in storage.
     */
    

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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
