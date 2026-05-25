<x-layouts::app title="Setoran Anak Saya">
<link rel="stylesheet" href="{{ asset('css/hafalan.css') }}">

<div class="hafalan-wrap">
    <div class="hafalan-header">
        <div class="hafalan-title-wrap">
            <div class="hafalan-icon">👨‍👦</div>
            <div>
                <h1 class="hafalan-title">Setoran Anak Saya</h1>
                <p class="hafalan-subtitle">Monitor Hafalan Anak</p>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert-success">✓ {{ session('success') }}</div>
    @endif

    <div class="table-wrap">
        <table class="setoran-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Santri</th>
                    <th>Tanggal</th>
                    <th>Sabaq</th>
                    <th>Paraf Guru</th>
                    <th>Paraf Ortu</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($setorans as $setoran)
                    <tr>
                        <td class="no-cell">{{ $loop->iteration }}</td>
                        <td class="santri-name">{{ $setoran->user->name }}</td>
                        <td class="tanggal-text">{{ \Carbon\Carbon::parse($setoran->tanggal)->format('d M Y') }}</td>
                        <td style="color: #111827;">
                            @if($setoran->sabaq->first())
                                {{ $setoran->sabaq->first()->surah->nama_latin }}
                                <span style="color: #6b7280; font-size: 0.75rem;">
                                    ({{ $setoran->sabaq->first()->ayat_mulai }}-{{ $setoran->sabaq->first()->ayat_selesai }})
                                </span>
                            @else
                                <span style="color: #9ca3af;">-</span>
                            @endif
                        </td>
                        <td>
                            @if($setoran->paraf_guru)
                                <span class="badge-sudah">✓ Sudah</span>
                            @else
                                <span class="badge-belum">✗ Belum</span>
                            @endif
                        </td>
                        <td>
                            @if($setoran->paraf_ortu)
                                <span class="badge-sudah">✓ Sudah</span>
                            @else
                                <span class="badge-belum">✗ Belum</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('ortu.show', $setoran->id) }}" class="btn-detail">Detail</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">
                            <div class="empty-state">
                                <div class="empty-icon">📋</div>
                                <p>Belum ada data setoran anak.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top: 1rem;">
        {{ $setorans->links() }}
    </div>
</div>
</x-layouts::app>