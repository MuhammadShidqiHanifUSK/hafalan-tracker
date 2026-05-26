<x-layouts::app :title="__('Dashboard')">
<link rel="stylesheet" href="{{ asset('css/hafalan.css') }}">

@php
    $user = auth()->user();
    $role = $user->role;
@endphp

<div class="hafalan-wrap">

    {{-- Header --}}
    <div style="margin-bottom: 2rem;">
        <h1 class="hafalan-title" style="font-size: 1.75rem;">
            Assalamu'alaikum, {{ $user->name }} 👋
        </h1>
        <p class="hafalan-subtitle" style="font-size: 0.9rem; margin-top: 0.25rem;">
            @if($role == 'admin') Selamat datang di panel admin sistem hafalan.
            @elseif($role == 'ustadz') Semoga Allah memudahkan dalam membimbing para santri.
            @elseif($role == 'santri') Semangat menghafal! Sedikit demi sedikit, lama-lama menjadi bukit.
            @elseif($role == 'ortu') Pantau terus perkembangan hafalan putra/putri Anda.
            @endif
        </p>
    </div>

    {{-- ADMIN DASHBOARD --}}
    @if($role == 'admin')
    @php
        $totalUser    = \App\Models\User::count();
        $totalAdmin   = \App\Models\User::where('role', 'admin')->count();
        $totalUstadz  = \App\Models\User::where('role', 'ustadz')->count();
        $totalSantri  = \App\Models\User::where('role', 'santri')->count();
        $totalOrtu    = \App\Models\User::where('role', 'ortu')->count();
    @endphp

    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; margin-bottom: 1.5rem;">
        <div class="hafalan-card" style="margin-bottom: 0; text-align: center;">
            <div style="font-size: 2rem; margin-bottom: 0.5rem;">👑</div>
            <div style="font-size: 1.75rem; font-weight: 700; color: #7c3aed;">{{ $totalAdmin }}</div>
            <div style="font-size: 0.8rem; color: #6b7280; margin-top: 0.25rem;">Admin</div>
        </div>
        <div class="hafalan-card" style="margin-bottom: 0; text-align: center;">
            <div style="font-size: 2rem; margin-bottom: 0.5rem;">🎓</div>
            <div style="font-size: 1.75rem; font-weight: 700; color: #15803d;">{{ $totalUstadz }}</div>
            <div style="font-size: 0.8rem; color: #6b7280; margin-top: 0.25rem;">Ustadz</div>
        </div>
        <div class="hafalan-card" style="margin-bottom: 0; text-align: center;">
            <div style="font-size: 2rem; margin-bottom: 0.5rem;">📖</div>
            <div style="font-size: 1.75rem; font-weight: 700; color: #854d0e;">{{ $totalSantri }}</div>
            <div style="font-size: 0.8rem; color: #6b7280; margin-top: 0.25rem;">Santri</div>
        </div>
        <div class="hafalan-card" style="margin-bottom: 0; text-align: center;">
            <div style="font-size: 2rem; margin-bottom: 0.5rem;">👨‍👦</div>
            <div style="font-size: 1.75rem; font-weight: 700; color: #1d4ed8;">{{ $totalOrtu }}</div>
            <div style="font-size: 0.8rem; color: #6b7280; margin-top: 0.25rem;">Orang Tua</div>
        </div>
    </div>

    <div class="hafalan-card">
        <h2 class="hafalan-card-title">⚙️ Aksi Cepat</h2>
        <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
            <a href="{{ route('admin.create') }}" class="btn-tambah">＋ Tambah User</a>
            <a href="{{ route('admin.index') }}" class="btn-kembali">👥 Kelola User</a>
        </div>
    </div>
    @endif

    {{-- USTADZ DASHBOARD --}}
    @if($role == 'ustadz')
    @php
        $totalSantri   = \App\Models\User::where('role', 'santri')->count();
        $totalSetoran  = \App\Models\Setoran::count();
        $setoranHariIni = \App\Models\Setoran::whereDate('tanggal', today())->count();
        $belumParaf    = \App\Models\Setoran::where('paraf_guru', false)->count();
    @endphp

    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; margin-bottom: 1.5rem;">
        <div class="hafalan-card" style="margin-bottom: 0; text-align: center;">
            <div style="font-size: 2rem; margin-bottom: 0.5rem;">📖</div>
            <div style="font-size: 1.75rem; font-weight: 700; color: #15803d;">{{ $totalSantri }}</div>
            <div style="font-size: 0.8rem; color: #6b7280; margin-top: 0.25rem;">Total Santri</div>
        </div>
        <div class="hafalan-card" style="margin-bottom: 0; text-align: center;">
            <div style="font-size: 2rem; margin-bottom: 0.5rem;">📋</div>
            <div style="font-size: 1.75rem; font-weight: 700; color: #15803d;">{{ $totalSetoran }}</div>
            <div style="font-size: 0.8rem; color: #6b7280; margin-top: 0.25rem;">Total Setoran</div>
        </div>
        <div class="hafalan-card" style="margin-bottom: 0; text-align: center;">
            <div style="font-size: 2rem; margin-bottom: 0.5rem;">📅</div>
            <div style="font-size: 1.75rem; font-weight: 700; color: #2563eb;">{{ $setoranHariIni }}</div>
            <div style="font-size: 0.8rem; color: #6b7280; margin-top: 0.25rem;">Setoran Hari Ini</div>
        </div>
        <div class="hafalan-card" style="margin-bottom: 0; text-align: center;">
            <div style="font-size: 2rem; margin-bottom: 0.5rem;">✍️</div>
            <div style="font-size: 1.75rem; font-weight: 700; color: #dc2626;">{{ $belumParaf }}</div>
            <div style="font-size: 0.8rem; color: #6b7280; margin-top: 0.25rem;">Belum Diparaf</div>
        </div>
    </div>

    <div class="hafalan-card">
        <h2 class="hafalan-card-title">⚡ Aksi Cepat</h2>
        <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
            <a href="{{ route('setoran.create') }}" class="btn-tambah">＋ Tambah Setoran</a>
            <a href="{{ route('setoran.index') }}" class="btn-kembali">📋 Daftar Santri</a>
        </div>
    </div>
    @endif

    {{-- SANTRI DASHBOARD --}}
    @if($role == 'santri')
    @php
        $totalSetoran  = \App\Models\Setoran::where('user_id', $user->id)->count();
        $setoranLancar = \App\Models\Sabaq::whereHas('setoran', fn($q) => $q->where('user_id', $user->id))->where('nilai', 'L')->count();
        $setoranKL     = \App\Models\Sabaq::whereHas('setoran', fn($q) => $q->where('user_id', $user->id))->where('nilai', 'KL')->count();
        $setoranU      = \App\Models\Sabaq::whereHas('setoran', fn($q) => $q->where('user_id', $user->id))->where('nilai', 'U')->count();
        $setoranTerakhir = \App\Models\Setoran::with('sabaq.surah')->where('user_id', $user->id)->latest()->first();
    @endphp

    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; margin-bottom: 1.5rem;">
        <div class="hafalan-card" style="margin-bottom: 0; text-align: center;">
            <div style="font-size: 2rem; margin-bottom: 0.5rem;">📋</div>
            <div style="font-size: 1.75rem; font-weight: 700; color: #15803d;">{{ $totalSetoran }}</div>
            <div style="font-size: 0.8rem; color: #6b7280; margin-top: 0.25rem;">Total Setoran</div>
        </div>
        <div class="hafalan-card" style="margin-bottom: 0; text-align: center;">
            <div style="font-size: 2rem; margin-bottom: 0.5rem;">✅</div>
            <div style="font-size: 1.75rem; font-weight: 700; color: #15803d;">{{ $setoranLancar }}</div>
            <div style="font-size: 0.8rem; color: #6b7280; margin-top: 0.25rem;">Lancar (L)</div>
        </div>
        <div class="hafalan-card" style="margin-bottom: 0; text-align: center;">
            <div style="font-size: 2rem; margin-bottom: 0.5rem;">⚠️</div>
            <div style="font-size: 1.75rem; font-weight: 700; color: #854d0e;">{{ $setoranKL }}</div>
            <div style="font-size: 0.8rem; color: #6b7280; margin-top: 0.25rem;">Kurang Lancar (KL)</div>
        </div>
        <div class="hafalan-card" style="margin-bottom: 0; text-align: center;">
            <div style="font-size: 2rem; margin-bottom: 0.5rem;">🔄</div>
            <div style="font-size: 1.75rem; font-weight: 700; color: #dc2626;">{{ $setoranU }}</div>
            <div style="font-size: 0.8rem; color: #6b7280; margin-top: 0.25rem;">Harus Diulang (U)</div>
        </div>
    </div>

    @if($setoranTerakhir)
    <div class="hafalan-card">
        <h2 class="hafalan-card-title">📌 Setoran Terakhir</h2>
        <table class="info-table">
            <tr>
                <td class="info-label">Tanggal</td>
                <td class="info-value">{{ \Carbon\Carbon::parse($setoranTerakhir->tanggal)->format('d M Y') }}</td>
            </tr>
            <tr>
                <td class="info-label">Sabaq</td>
                <td class="info-value">
                    @if($setoranTerakhir->sabaq->first())
                        {{ $setoranTerakhir->sabaq->first()->surah->nama_latin }}
                        ({{ $setoranTerakhir->sabaq->first()->ayat_mulai }}-{{ $setoranTerakhir->sabaq->first()->ayat_selesai }})
                    @else — @endif
                </td>
            </tr>
            <tr>
                <td class="info-label">Nilai</td>
                <td class="info-value">
                    @if($setoranTerakhir->sabaq->first())
                        <span class="badge-nilai-{{ strtolower($setoranTerakhir->sabaq->first()->nilai) }}">
                            {{ $setoranTerakhir->sabaq->first()->nilai }}
                        </span>
                    @else — @endif
                </td>
            </tr>
        </table>
        <div style="margin-top: 1rem;">
            <a href="{{ route('santri.index') }}" class="btn-kembali">📋 Lihat Semua Riwayat</a>
        </div>
    </div>
    @endif
    @endif

    {{-- ORTU DASHBOARD --}}
    @if($role == 'ortu')
    @php
        $relasiAnak = \App\Models\OrtuSantri::where('ortu_id', $user->id)->with('santri')->first();
        $santriId   = $relasiAnak?->santri_id;
        $totalSetoran   = $santriId ? \App\Models\Setoran::where('user_id', $santriId)->count() : 0;
        $belumParafOrtu = $santriId ? \App\Models\Setoran::where('user_id', $santriId)->where('paraf_ortu', false)->count() : 0;
        $setoranTerakhir = $santriId ? \App\Models\Setoran::with('sabaq.surah')->where('user_id', $santriId)->latest()->first() : null;
    @endphp

    @if($relasiAnak)
    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; margin-bottom: 1.5rem;">
        <div class="hafalan-card" style="margin-bottom: 0; text-align: center;">
            <div style="font-size: 2rem; margin-bottom: 0.5rem;">👦</div>
            <div style="font-size: 1.1rem; font-weight: 700; color: #15803d;">{{ $relasiAnak->santri->name }}</div>
            <div style="font-size: 0.8rem; color: #6b7280; margin-top: 0.25rem;">Nama Anak</div>
        </div>
        <div class="hafalan-card" style="margin-bottom: 0; text-align: center;">
            <div style="font-size: 2rem; margin-bottom: 0.5rem;">📋</div>
            <div style="font-size: 1.75rem; font-weight: 700; color: #15803d;">{{ $totalSetoran }}</div>
            <div style="font-size: 0.8rem; color: #6b7280; margin-top: 0.25rem;">Total Setoran</div>
        </div>
        <div class="hafalan-card" style="margin-bottom: 0; text-align: center;">
            <div style="font-size: 2rem; margin-bottom: 0.5rem;">✍️</div>
            <div style="font-size: 1.75rem; font-weight: 700; color: #dc2626;">{{ $belumParafOrtu }}</div>
            <div style="font-size: 0.8rem; color: #6b7280; margin-top: 0.25rem;">Belum Diparaf</div>
        </div>
    </div>

    @if($setoranTerakhir)
    <div class="hafalan-card">
        <h2 class="hafalan-card-title">📌 Setoran Terakhir Anak</h2>
        <table class="info-table">
            <tr>
                <td class="info-label">Tanggal</td>
                <td class="info-value">{{ \Carbon\Carbon::parse($setoranTerakhir->tanggal)->format('d M Y') }}</td>
            </tr>
            <tr>
                <td class="info-label">Sabaq</td>
                <td class="info-value">
                    @if($setoranTerakhir->sabaq->first())
                        {{ $setoranTerakhir->sabaq->first()->surah->nama_latin }}
                        ({{ $setoranTerakhir->sabaq->first()->ayat_mulai }}-{{ $setoranTerakhir->sabaq->first()->ayat_selesai }})
                    @else — @endif
                </td>
            </tr>
            <tr>
                <td class="info-label">Nilai</td>
                <td class="info-value">
                    @if($setoranTerakhir->sabaq->first())
                        <span class="badge-nilai-{{ strtolower($setoranTerakhir->sabaq->first()->nilai) }}">
                            {{ $setoranTerakhir->sabaq->first()->nilai }}
                        </span>
                    @else — @endif
                </td>
            </tr>
            <tr>
                <td class="info-label">Paraf Ortu</td>
                <td class="info-value">
                    @if($setoranTerakhir->paraf_ortu)
                        <span class="badge-sudah">✓ Sudah</span>
                    @else
                        <span class="badge-belum">✗ Belum</span>
                    @endif
                </td>
            </tr>
        </table>
        <div style="margin-top: 1rem;">
            <a href="{{ route('ortu.index') }}" class="btn-kembali">📋 Lihat Semua Setoran</a>
        </div>
    </div>
    @endif

    @else
    <div class="hafalan-card">
        <div class="empty-state">
            <div class="empty-icon">👨‍👦</div>
            <p>Akun Anda belum dihubungkan ke santri. Hubungi admin untuk menghubungkan.</p>
        </div>
    </div>
    @endif
    @endif

</div>
</x-layouts::app>