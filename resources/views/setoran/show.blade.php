<x-layouts::app title="Detail Setoran">
    <div style="color: #111827;">
        <div style="max-width: 56rem; margin: 0 auto; padding: 1.5rem 1rem;">

            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                <h1 style="font-size: 1.5rem; font-weight: 700; color: #1f2937; background: #ffffff; padding: 0.5rem 1rem; border-radius: 0.5rem;">Detail Setoran</h1>
                <a href="{{ route('setoran.index') }}" style="color: #4b5563; text-decoration: underline;">← Kembali</a>
            </div>

            {{-- Info Setoran --}}
            <div style="background: #ffffff; border-radius: 0.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); padding: 1.5rem; margin-bottom: 1.5rem;">
                <h2 style="font-weight: 600; color: #374151; margin-bottom: 1rem;">Informasi Setoran</h2>
                <table style="width: 100%; font-size: 0.875rem;">
                    <tr>
                        <td style="padding: 0.4rem 0; color: #6b7280; width: 150px;">Santri</td>
                        <td style="padding: 0.4rem 0; color: #111827; font-weight: 500;">{{ $setoran->user->name }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 0.4rem 0; color: #6b7280;">Tanggal</td>
                        <td style="padding: 0.4rem 0; color: #111827;">{{ \Carbon\Carbon::parse($setoran->tanggal)->format('d M Y') }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 0.4rem 0; color: #6b7280;">Paraf Guru</td>
                        <td style="padding: 0.4rem 0;">
                            @if($setoran->paraf_guru)
                                <span style="color: #16a34a; font-weight: 600;">✓ Sudah</span>
                            @else
                                <span style="color: #dc2626;">✗ Belum</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 0.4rem 0; color: #6b7280;">Paraf Ortu</td>
                        <td style="padding: 0.4rem 0;">
                            @if($setoran->paraf_ortu)
                                <span style="color: #16a34a; font-weight: 600;">✓ Sudah</span>
                            @else
                                <span style="color: #dc2626;">✗ Belum</span>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>

            {{-- Sabaq --}}
            <div style="background: #ffffff; border-radius: 0.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); padding: 1.5rem; margin-bottom: 1.5rem;">
                <h2 style="font-weight: 600; color: #374151; margin-bottom: 1rem;">Sabaq (Hafalan Baru)</h2>
                @forelse($setoran->sabaq as $sabaq)
                    <table style="width: 100%; font-size: 0.875rem; margin-bottom: 0.5rem;">
                        <tr>
                            <td style="padding: 0.4rem 0; color: #6b7280; width: 150px;">Surah</td>
                            <td style="padding: 0.4rem 0; color: #111827;">{{ $sabaq->surah->nomor }}. {{ $sabaq->surah->nama_latin }}</td>
                        </tr>
                        <tr>
                            <td style="padding: 0.4rem 0; color: #6b7280;">Ayat</td>
                            <td style="padding: 0.4rem 0; color: #111827;">{{ $sabaq->ayat_mulai }} - {{ $sabaq->ayat_selesai }}</td>
                        </tr>
                        <tr>
                            <td style="padding: 0.4rem 0; color: #6b7280;">Jumlah Baris</td>
                            <td style="padding: 0.4rem 0; color: #111827;">{{ $sabaq->jumlah_baris }}</td>
                        </tr>
                        <tr>
                            <td style="padding: 0.4rem 0; color: #6b7280;">Nilai</td>
                            <td style="padding: 0.4rem 0;">
                                <span style="background: {{ $sabaq->nilai == 'L' ? '#dcfce7' : ($sabaq->nilai == 'KL' ? '#fef9c3' : '#fee2e2') }}; color: {{ $sabaq->nilai == 'L' ? '#16a34a' : ($sabaq->nilai == 'KL' ? '#854d0e' : '#dc2626') }}; padding: 0.2rem 0.6rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600;">
                                    {{ $sabaq->nilai }}
                                </span>
                            </td>
                        </tr>
                    </table>
                @empty
                    <p style="color: #9ca3af; font-size: 0.875rem;">Tidak ada data sabaq.</p>
                @endforelse
            </div>

            {{-- Sabqi --}}
            <div style="background: #ffffff; border-radius: 0.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); padding: 1.5rem; margin-bottom: 1.5rem;">
                <h2 style="font-weight: 600; color: #374151; margin-bottom: 1rem;">Sabqi (Murajaah Hafalan Baru)</h2>
                @forelse($setoran->sabqi as $sabqi)
                    <table style="width: 100%; font-size: 0.875rem; margin-bottom: 0.5rem;">
                        <tr>
                            <td style="padding: 0.4rem 0; color: #6b7280; width: 150px;">Surah</td>
                            <td style="padding: 0.4rem 0; color: #111827;">{{ $sabqi->surah->nomor }}. {{ $sabqi->surah->nama_latin }}</td>
                        </tr>
                        <tr>
                            <td style="padding: 0.4rem 0; color: #6b7280;">Ayat</td>
                            <td style="padding: 0.4rem 0; color: #111827;">{{ $sabqi->ayat_mulai }} - {{ $sabqi->ayat_selesai }}</td>
                        </tr>
                        <tr>
                            <td style="padding: 0.4rem 0; color: #6b7280;">Jumlah Halaman</td>
                            <td style="padding: 0.4rem 0; color: #111827;">{{ $sabqi->jumlah_halaman }}</td>
                        </tr>
                        <tr>
                            <td style="padding: 0.4rem 0; color: #6b7280;">Nilai</td>
                            <td style="padding: 0.4rem 0;">
                                <span style="background: {{ $sabqi->nilai == 'L' ? '#dcfce7' : ($sabqi->nilai == 'KL' ? '#fef9c3' : '#fee2e2') }}; color: {{ $sabqi->nilai == 'L' ? '#16a34a' : ($sabqi->nilai == 'KL' ? '#854d0e' : '#dc2626') }}; padding: 0.2rem 0.6rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600;">
                                    {{ $sabqi->nilai }}
                                </span>
                            </td>
                        </tr>
                    </table>
                @empty
                    <p style="color: #9ca3af; font-size: 0.875rem;">Tidak ada data sabqi.</p>
                @endforelse
            </div>

            {{-- Manzil --}}
            <div style="background: #ffffff; border-radius: 0.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); padding: 1.5rem; margin-bottom: 1.5rem;">
                <h2 style="font-weight: 600; color: #374151; margin-bottom: 1rem;">Manzil (Murajaah di Rumah)</h2>
                @forelse($setoran->manzil as $manzil)
                    <table style="width: 100%; font-size: 0.875rem; margin-bottom: 0.5rem;">
                        <tr>
                            <td style="padding: 0.4rem 0; color: #6b7280; width: 150px;">Surah</td>
                            <td style="padding: 0.4rem 0; color: #111827;">{{ $manzil->surah->nomor }}. {{ $manzil->surah->nama_latin }}</td>
                        </tr>
                        <tr>
                            <td style="padding: 0.4rem 0; color: #6b7280;">Ayat</td>
                            <td style="padding: 0.4rem 0; color: #111827;">{{ $manzil->ayat_mulai }} - {{ $manzil->ayat_selesai }}</td>
                        </tr>
                        <tr>
                            <td style="padding: 0.4rem 0; color: #6b7280;">Jumlah Halaman</td>
                            <td style="padding: 0.4rem 0; color: #111827;">{{ $manzil->jumlah_halaman }}</td>
                        </tr>
                        <tr>
                            <td style="padding: 0.4rem 0; color: #6b7280;">Nilai</td>
                            <td style="padding: 0.4rem 0;">
                                <span style="background: {{ $manzil->nilai == 'L' ? '#dcfce7' : ($manzil->nilai == 'KL' ? '#fef9c3' : '#fee2e2') }}; color: {{ $manzil->nilai == 'L' ? '#16a34a' : ($manzil->nilai == 'KL' ? '#854d0e' : '#dc2626') }}; padding: 0.2rem 0.6rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600;">
                                    {{ $manzil->nilai }}
                                </span>
                            </td>
                        </tr>
                    </table>
                @empty
                    <p style="color: #9ca3af; font-size: 0.875rem;">Tidak ada data manzil.</p>
                @endforelse
            </div>

            {{-- Catatan --}}
            <div style="background: #ffffff; border-radius: 0.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); padding: 1.5rem;">
                <h2 style="font-weight: 600; color: #374151; margin-bottom: 1rem;">Catatan</h2>
                @forelse($setoran->catatanSetoran as $catatan)
                    <div style="border: 1px solid #e5e7eb; border-radius: 0.375rem; padding: 0.75rem; margin-bottom: 0.75rem;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 0.25rem;">
                            <span style="font-weight: 600; font-size: 0.875rem; color: #374151;">{{ $catatan->user->name }}</span>
                            <span style="font-size: 0.75rem; color: #9ca3af;">{{ $catatan->created_at->format('d M Y H:i') }}</span>
                        </div>
                        <p style="font-size: 0.875rem; color: #111827; margin: 0;">{{ $catatan->isi_catatan }}</p>
                    </div>
                @empty
                    <p style="color: #9ca3af; font-size: 0.875rem;">Belum ada catatan.</p>
                @endforelse
            </div>

        </div>
    </div>
</x-layouts::app>