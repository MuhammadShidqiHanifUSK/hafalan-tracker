<x-layouts::app title="Detail Setoran">
<link rel="stylesheet" href="{{ asset('css/hafalan.css') }}">

<div class="hafalan-wrap">
    <div class="hafalan-header">
        <div class="hafalan-title-wrap">
            <div class="hafalan-icon">🔍</div>
            <div>
                <h1 class="hafalan-title">Detail Setoran</h1>
                <p class="hafalan-subtitle">{{ \Carbon\Carbon::parse($setoran->tanggal)->format('d M Y') }}</p>
            </div>
        </div>
        <a href="{{ route('setoran.index') }}" class="btn-kembali">← Kembali</a>
    </div>

    {{-- Info Setoran --}}
    <div class="hafalan-card">
        <h2 class="hafalan-card-title">👤 Informasi Setoran</h2>
        <table class="info-table">
            <tr>
                <td class="info-label">Santri</td>
                <td class="info-value" style="color: #14532d; font-weight: 700;">{{ $setoran->user->name }}</td>
            </tr>
            <tr>
                <td class="info-label">Tanggal</td>
                <td class="info-value">{{ \Carbon\Carbon::parse($setoran->tanggal)->format('d M Y') }}</td>
            </tr>
            <tr>
                <td class="info-label">Paraf Guru</td>
                <td class="info-value">
                    @if($setoran->paraf_guru)
                        <span class="badge-sudah">✓ Sudah</span>
                     @else
                        <span class="badge-belum">✗ Belum</span>
                        <form action="{{ route('setoran.paraf-guru', $setoran->id) }}" method="POST" style="display:inline; margin-left: 0.5rem;">
                             @csrf
                            @method('PATCH')
                            <button type="submit" style="background: #16a34a; color: #fff; border: none; border-radius: 6px; padding: 0.25rem 0.75rem; font-size: 0.75rem; font-weight: 600; cursor: pointer;">
                                ✍️ Paraf Sekarang
                            </button>
                        </form>
                    @endif
                </td>
            </tr>
            <tr>
                <td class="info-label">Paraf Ortu</td>
                <td class="info-value">
                    @if($setoran->paraf_ortu)
                        <span class="badge-sudah">✓ Sudah</span>
                     @else
                        <span class="badge-belum">✗ Belum</span>
                    @endif
                </td>
            </tr>
        </table>
    </div>

    {{-- Sabaq --}}
    <div class="hafalan-card">
        <h2 class="hafalan-card-title">📗 Sabaq (Hafalan Baru)</h2>
        @forelse($setoran->sabaq as $sabaq)
            <table class="info-table" style="margin-bottom: 1rem;">
                <tr>
                    <td class="info-label">Surah</td>
                    <td class="info-value">{{ $sabaq->surah->nomor }}. {{ $sabaq->surah->nama_latin }}</td>
                </tr>
                <tr>
                    <td class="info-label">Ayat</td>
                    <td class="info-value">{{ $sabaq->ayat_mulai }} – {{ $sabaq->ayat_selesai }}</td>
                </tr>
                <tr>
                    <td class="info-label">Jumlah Baris</td>
                    <td class="info-value">{{ $sabaq->jumlah_baris }} baris</td>
                </tr>
                <tr>
                    <td class="info-label">Nilai</td>
                    <td class="info-value">
                        <span class="badge-nilai-{{ strtolower($sabaq->nilai) }}">{{ $sabaq->nilai }}</span>
                    </td>
                </tr>
            </table>
        @empty
            <p style="color: #9ca3af; font-size: 0.875rem;">Tidak ada data sabaq.</p>
        @endforelse
    </div>

    {{-- Sabqi --}}
    <div class="hafalan-card">
        <h2 class="hafalan-card-title">📘 Sabqi (Murajaah Hafalan Baru)</h2>
        @forelse($setoran->sabqi as $sabqi)
            <table class="info-table" style="margin-bottom: 1rem;">
                <tr>
                    <td class="info-label">Surah</td>
                    <td class="info-value">{{ $sabqi->surah->nomor }}. {{ $sabqi->surah->nama_latin }}</td>
                </tr>
                <tr>
                    <td class="info-label">Ayat</td>
                    <td class="info-value">{{ $sabqi->ayat_mulai }} – {{ $sabqi->ayat_selesai }}</td>
                </tr>
                <tr>
                    <td class="info-label">Jumlah Halaman</td>
                    <td class="info-value">{{ $sabqi->jumlah_halaman }} halaman</td>
                </tr>
                <tr>
                    <td class="info-label">Nilai</td>
                    <td class="info-value">
                        <span class="badge-nilai-{{ strtolower($sabqi->nilai) }}">{{ $sabqi->nilai }}</span>
                    </td>
                </tr>
            </table>
        @empty
            <p style="color: #9ca3af; font-size: 0.875rem;">Tidak ada data sabqi.</p>
        @endforelse
    </div>

    {{-- Manzil --}}
    <div class="hafalan-card">
        <h2 class="hafalan-card-title">📙 Manzil (Murajaah di Rumah)</h2>
        @forelse($setoran->manzil as $manzil)
            <table class="info-table" style="margin-bottom: 1rem;">
                <tr>
                    <td class="info-label">Surah</td>
                    <td class="info-value">{{ $manzil->surah->nomor }}. {{ $manzil->surah->nama_latin }}</td>
                </tr>
                <tr>
                    <td class="info-label">Ayat</td>
                    <td class="info-value">{{ $manzil->ayat_mulai }} – {{ $manzil->ayat_selesai }}</td>
                </tr>
                <tr>
                    <td class="info-label">Jumlah Halaman</td>
                    <td class="info-value">{{ $manzil->jumlah_halaman }} halaman</td>
                </tr>
                <tr>
                    <td class="info-label">Nilai</td>
                    <td class="info-value">
                        <span class="badge-nilai-{{ strtolower($manzil->nilai) }}">{{ $manzil->nilai }}</span>
                    </td>
                </tr>
            </table>
        @empty
            <p style="color: #9ca3af; font-size: 0.875rem;">Tidak ada data manzil.</p>
        @endforelse
    </div>

    {{-- Catatan --}}
    <div class="hafalan-card">
        <h2 class="hafalan-card-title">💬 Catatan Ustadz & Orang Tua</h2>
        @forelse($setoran->catatanSetoran as $catatan)
            <div style="border: 1px solid #e5e7eb; border-radius: 10px; padding: 1rem; margin-bottom: 0.75rem; background: #f9fafb;">
                <div style="display: flex; justify-content: space-between; margin-bottom: 0.4rem;">
                    <span style="font-weight: 700; font-size: 0.875rem; color: #14532d;">{{ $catatan->user->name }}</span>
                    <span style="font-size: 0.75rem; color: #9ca3af;">{{ $catatan->created_at->format('d M Y H:i') }}</span>
                </div>
                <p style="font-size: 0.875rem; color: #374151; margin: 0;">{{ $catatan->isi_catatan }}</p>
            </div>
        @empty
            <p style="color: #9ca3af; font-size: 0.875rem;">Belum ada catatan.</p>
        @endforelse
    </div>

</div>
</x-layouts::app>