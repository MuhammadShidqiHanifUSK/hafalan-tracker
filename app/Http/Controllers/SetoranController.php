<?php

namespace App\Http\Controllers;

use App\Models\Setoran;
use App\Models\Surah;
use App\Models\Sabaq;
use App\Models\Sabqi;
use App\Models\Manzil;
use Illuminate\Http\Request;

class SetoranController extends Controller
{
    // Tampilkan daftar semua setoran
    public function index()
    {
        $setorans = Setoran::with('user')->latest()->paginate(10);
        return view('setoran.index', compact('setorans'));
    }

    // Tampilkan form tambah setoran
    public function create()
    {
        $surahs = Surah::orderBy('nomor')->get();
        $santris = \App\Models\User::where('role', 'santri')->get();
        return view('setoran.create', compact('surahs', 'santris'));
    }

    // Simpan setoran baru
    public function store(Request $request)
    {
        $request->validate([
            'user_id'               => 'required|exists:users,id',
            'tanggal'               => 'required|date',
            // Sabaq (wajib)
            'sabaq_surah_id'        => 'required|exists:surahs,id',
            'sabaq_ayat_mulai'      => 'required|integer|min:1',
            'sabaq_ayat_selesai'    => 'required|integer|min:1',
            'sabaq_jumlah_baris'    => 'required|integer|min:1',
            'sabaq_nilai'           => 'required|in:L,KL,U',
            // Sabqi (wajib)
            'sabqi_surah_id'        => 'required|exists:surahs,id',
            'sabqi_ayat_mulai'      => 'required|integer|min:1',
            'sabqi_ayat_selesai'    => 'required|integer|min:1',
            'sabqi_jumlah_halaman'  => 'required|integer|min:1',
            'sabqi_nilai'           => 'required|in:L,KL,U',
            // Manzil (wajib)
            'manzil_surah_id'       => 'required|exists:surahs,id',
            'manzil_ayat_mulai'     => 'required|integer|min:1',
            'manzil_ayat_selesai'   => 'required|integer|min:1',
            'manzil_jumlah_halaman' => 'required|integer|min:1',
            'manzil_nilai'          => 'required|in:L,KL,U',
        ]);

        // Simpan setoran
        $setoran = Setoran::create([
            'user_id'    => $request->user_id,
            'tanggal'    => $request->tanggal,
            'paraf_guru' => false,
            'paraf_ortu' => false,
        ]);

        // Simpan sabaq
        Sabaq::create([
            'setoran_id'   => $setoran->id,
            'surah_id'     => $request->sabaq_surah_id,
            'ayat_mulai'   => $request->sabaq_ayat_mulai,
            'ayat_selesai' => $request->sabaq_ayat_selesai,
            'jumlah_baris' => $request->sabaq_jumlah_baris,
            'nilai'        => $request->sabaq_nilai,
        ]);

        // Simpan sabqi jika diisi
        if ($request->filled('sabqi_surah_id')) {
            Sabqi::create([
                'setoran_id'     => $setoran->id,
                'surah_id'       => $request->sabqi_surah_id,
                'ayat_mulai'     => $request->sabqi_ayat_mulai,
                'ayat_selesai'   => $request->sabqi_ayat_selesai,
                'jumlah_halaman' => $request->sabqi_jumlah_halaman,
                'nilai'          => $request->sabqi_nilai,
            ]);
        }

        // Simpan manzil jika diisi
        if ($request->filled('manzil_surah_id')) {
            Manzil::create([
                'setoran_id'     => $setoran->id,
                'surah_id'       => $request->manzil_surah_id,
                'ayat_mulai'     => $request->manzil_ayat_mulai,
                'ayat_selesai'   => $request->manzil_ayat_selesai,
                'jumlah_halaman' => $request->manzil_jumlah_halaman,
                'nilai'          => $request->manzil_nilai,
            ]);
        }

        return redirect()->route('setoran.index')
            ->with('success', 'Setoran berhasil disimpan!');
    }

    // Tampilkan detail setoran
    public function show($id)
    {
        $setoran = Setoran::with(['user', 'sabaq.surah', 'sabqi.surah', 'manzil.surah', 'catatanSetoran.user'])->findOrFail($id);
        return view('setoran.show', compact('setoran'));
    }

    // Tampilkan form edit setoran
    public function edit($id)
    {
        $setoran = Setoran::with(['sabaq.surah', 'sabqi.surah', 'manzil.surah'])->findOrFail($id);
        $surahs = Surah::orderBy('nomor')->get();
        return view('setoran.edit', compact('setoran', 'surahs'));
    }

    // Update setoran
    public function update(Request $request, $id)
    {
        $setoran = Setoran::findOrFail($id);

        $request->validate([
            'tanggal'               => 'required|date',
            // Sabaq (wajib)
            'sabaq_surah_id'        => 'required|exists:surahs,id',
            'sabaq_ayat_mulai'      => 'required|integer|min:1',
            'sabaq_ayat_selesai'    => 'required|integer|min:1',
            'sabaq_jumlah_baris'    => 'required|integer|min:1',
            'sabaq_nilai'           => 'required|in:L,KL,U',
            // Sabqi (opsional)
            'sabqi_surah_id'        => 'nullable|exists:surahs,id',
            'sabqi_ayat_mulai'      => 'nullable|integer|min:1',
            'sabqi_ayat_selesai'    => 'nullable|integer|min:1',
            'sabqi_jumlah_halaman'  => 'nullable|integer|min:1',
            'sabqi_nilai'           => 'nullable|in:L,KL,U',
            // Manzil (opsional)
            'manzil_surah_id'       => 'nullable|exists:surahs,id',
            'manzil_ayat_mulai'     => 'nullable|integer|min:1',
            'manzil_ayat_selesai'   => 'nullable|integer|min:1',
            'manzil_jumlah_halaman' => 'nullable|integer|min:1',
            'manzil_nilai'          => 'nullable|in:L,KL,U',
        ]);

        // Update setoran
        $setoran->update(['tanggal' => $request->tanggal]);

        // Update sabaq
        $setoran->sabaq()->updateOrCreate(
            ['setoran_id' => $setoran->id],
            [
                'surah_id'     => $request->sabaq_surah_id,
                'ayat_mulai'   => $request->sabaq_ayat_mulai,
                'ayat_selesai' => $request->sabaq_ayat_selesai,
                'jumlah_baris' => $request->sabaq_jumlah_baris,
                'nilai'        => $request->sabaq_nilai,
            ]
        );

        // Update atau hapus sabqi
        if ($request->filled('sabqi_surah_id')) {
            $setoran->sabqi()->updateOrCreate(
                ['setoran_id' => $setoran->id],
                [
                    'surah_id'       => $request->sabqi_surah_id,
                    'ayat_mulai'     => $request->sabqi_ayat_mulai,
                    'ayat_selesai'   => $request->sabqi_ayat_selesai,
                    'jumlah_halaman' => $request->sabqi_jumlah_halaman,
                    'nilai'          => $request->sabqi_nilai,
                ]
            );
        } else {
            $setoran->sabqi()->delete();
        }

        // Update atau hapus manzil
        if ($request->filled('manzil_surah_id')) {
            $setoran->manzil()->updateOrCreate(
                ['setoran_id' => $setoran->id],
                [
                    'surah_id'       => $request->manzil_surah_id,
                    'ayat_mulai'     => $request->manzil_ayat_mulai,
                    'ayat_selesai'   => $request->manzil_ayat_selesai,
                    'jumlah_halaman' => $request->manzil_jumlah_halaman,
                    'nilai'          => $request->manzil_nilai,
                ]
            );
        } else {
            $setoran->manzil()->delete();
        }

        return redirect()->route('setoran.index')
            ->with('success', 'Setoran berhasil diupdate!');
    }

    // Hapus setoran
    public function destroy($id)
    {
        $setoran = Setoran::findOrFail($id);
        $setoran->delete();

        return redirect()->route('setoran.index')
            ->with('success', 'Setoran berhasil dihapus!');
    }
}