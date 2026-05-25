<?php

namespace App\Http\Controllers;

use App\Models\Setoran;
use App\Models\OrtuSantri;
use Illuminate\Http\Request;

class OrtuController extends Controller
{
    // Tampilkan daftar setoran anak
    public function index()
    {
        // Ambil semua santri yang terhubung dengan ortu ini
        $santriIds = OrtuSantri::where('ortu_id', auth()->id())
            ->pluck('santri_id');

        $setorans = Setoran::with(['user', 'sabaq.surah'])
            ->whereIn('user_id', $santriIds)
            ->latest()
            ->paginate(10);

        return view('ortu.index', compact('setorans'));
    }

    // Tampilkan detail setoran anak
    public function show($id)
    {
        $santriIds = OrtuSantri::where('ortu_id', auth()->id())
            ->pluck('santri_id');

        $setoran = Setoran::with(['user', 'sabaq.surah', 'sabqi.surah', 'manzil.surah', 'catatanSetoran.user'])
            ->whereIn('user_id', $santriIds)
            ->findOrFail($id);

        return view('ortu.show', compact('setoran'));
    }

    // Paraf ortu
    public function parafOrtu($id)
    {
        $santriIds = OrtuSantri::where('ortu_id', auth()->id())
            ->pluck('santri_id');

        $setoran = Setoran::whereIn('user_id', $santriIds)->findOrFail($id);
        $setoran->update(['paraf_ortu' => true]);

        return redirect()->route('ortu.show', $id)
            ->with('success', 'Paraf berhasil disimpan!');
    }
}