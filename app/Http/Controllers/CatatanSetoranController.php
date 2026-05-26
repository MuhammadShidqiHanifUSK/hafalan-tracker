<?php

namespace App\Http\Controllers;

use App\Models\CatatanSetoran;
use App\Models\Setoran;
use Illuminate\Http\Request;

class CatatanSetoranController extends Controller
{
    public function store(Request $request, $setoranId)
    {
        $request->validate([
            'isi_catatan' => 'required|string|max:500',
        ]);

        $setoran = Setoran::findOrFail($setoranId);

        CatatanSetoran::create([
            'setoran_id'  => $setoranId,
            'user_id'     => auth()->id(),
            'role'        => auth()->user()->role,
            'isi_catatan' => $request->isi_catatan,
        ]);

        // Redirect sesuai role
        if (auth()->user()->role == 'ortu') {
            return redirect()->route('ortu.show', $setoranId)
                ->with('success', 'Catatan berhasil ditambahkan!');
        }

        return redirect()->route('setoran.show', $setoranId)
            ->with('success', 'Catatan berhasil ditambahkan!');
    }
}