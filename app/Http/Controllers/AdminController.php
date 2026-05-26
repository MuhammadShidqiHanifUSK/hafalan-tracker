<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\OrtuSantri;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Tampilkan daftar semua user
    public function index()
    {
        $users = User::orderByRaw("FIELD(role, 'admin', 'ustadz', 'santri', 'ortu')")
            ->orderBy('name')
            ->get();
        return view('admin.index', compact('users'));
    }

    // Tampilkan form tambah user
    public function create()
    {
        return view('admin.create');
    }

    // Simpan user baru
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'role'     => 'required|in:admin,ustadz,ortu,santri',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
            'role'     => $request->role,
        ]);

        return redirect()->route('admin.index')
            ->with('success', 'User berhasil ditambahkan!');
    }

    // Tampilkan form edit user
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $santris = User::where('role', 'santri')->get();
        $ortuSantri = OrtuSantri::where('ortu_id', $id)->first();
        return view('admin.edit', compact('user', 'santris', 'ortuSantri'));
    }

    // Update user
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role'  => 'required|in:admin,ustadz,ortu,santri',
        ]);

        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
            'role'  => $request->role,
        ]);

        // Update password jika diisi
        if ($request->filled('password')) {
            $request->validate(['password' => 'min:6|confirmed']);
            $user->update(['password' => bcrypt($request->password)]);
        }

        // Update relasi ortu-santri jika role ortu
        if ($request->role == 'ortu' && $request->filled('santri_id')) {
            OrtuSantri::updateOrCreate(
                ['ortu_id' => $id],
                ['santri_id' => $request->santri_id]
            );
        }

        return redirect()->route('admin.index')
            ->with('success', 'User berhasil diupdate!');
    }

    // Hapus user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.index')
            ->with('success', 'User berhasil dihapus!');
    }
}