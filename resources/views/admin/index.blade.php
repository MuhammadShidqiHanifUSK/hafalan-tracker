<x-layouts::app title="Manajemen User">
<link rel="stylesheet" href="{{ asset('css/hafalan.css') }}">

<div class="hafalan-wrap">
    <div class="hafalan-header">
        <div class="hafalan-title-wrap">
            <div class="hafalan-icon">⚙️</div>
            <div>
                <h1 class="hafalan-title">Manajemen User</h1>
                <p class="hafalan-subtitle">Kelola akun pengguna sistem</p>
            </div>
        </div>
        <a href="{{ route('admin.create') }}" class="btn-tambah">＋ Tambah User</a>
    </div>

    @if(session('success'))
        <div class="alert-success">✓ {{ session('success') }}</div>
    @endif

    @php
        $admins  = $users->where('role', 'admin')->values();
        $ustadzs = $users->where('role', 'ustadz')->values();
        $santris = $users->where('role', 'santri')->values();
        $ortus   = $users->where('role', 'ortu')->values();

        $roleBadges = [
            'admin'  => ['label' => '👑 Admin',      'bg' => '#f3e8ff', 'color' => '#7c3aed'],
            'ustadz' => ['label' => '🎓 Ustadz',     'bg' => '#dcfce7', 'color' => '#15803d'],
            'santri' => ['label' => '📖 Santri',     'bg' => '#fef9c3', 'color' => '#854d0e'],
            'ortu'   => ['label' => '👨‍👦 Orang Tua', 'bg' => '#dbeafe', 'color' => '#1d4ed8'],
        ];
    @endphp

    <div class="table-wrap">
        <table class="setoran-table">
            <thead>
                <tr>
                    <th style="width: 50px;">No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Anak (Santri)</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp

                @foreach([['data' => $admins, 'role' => 'admin'], ['data' => $ustadzs, 'role' => 'ustadz'], ['data' => $santris, 'role' => 'santri'], ['data' => $ortus, 'role' => 'ortu']] as $group)
                    @if($group['data']->count() > 0)
                        {{-- Separator row --}}
                        <tr style="background: #f8fafc; border-top: 2px solid #e2e8f0;">
                            <td colspan="6" style="padding: 0.5rem 1.25rem;">
                                <span style="background: {{ $roleBadges[$group['role']]['bg'] }}; color: {{ $roleBadges[$group['role']]['color'] }}; padding: 0.2rem 0.75rem; border-radius: 999px; font-size: 0.8rem; font-weight: 700;">
                                    {{ $roleBadges[$group['role']]['label'] }}
                                </span>
                                <span style="color: #9ca3af; font-size: 0.75rem; margin-left: 0.5rem;">{{ $group['data']->count() }} akun</span>
                            </td>
                        </tr>

                        @foreach($group['data'] as $user)
                        @php
                            $relasiAnak = $group['role'] === 'ortu'
                                ? \App\Models\OrtuSantri::where('ortu_id', $user->id)->with('santri')->first()
                                : null;
                        @endphp
                        <tr>
                            <td class="no-cell">{{ $no++ }}</td>
                            <td class="santri-name">{{ $user->name }}</td>
                            <td style="color: #374151;">{{ $user->email }}</td>
                            <td>
                                <span style="background: {{ $roleBadges[$user->role]['bg'] }}; color: {{ $roleBadges[$user->role]['color'] }}; padding: 0.2rem 0.6rem; border-radius: 999px; font-size: 0.75rem; font-weight: 600;">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td>
                                @if($relasiAnak)
                                    <span style="background: #f0fdf4; color: #16a34a; padding: 0.2rem 0.6rem; border-radius: 999px; font-size: 0.8rem; font-weight: 600;">
                                        {{ $relasiAnak->santri->name }}
                                    </span>
                                @else
                                    <span style="color: #d1d5db; font-size: 0.8rem;">—</span>
                                @endif
                            </td>
                            <td>
                                <div class="aksi-wrap">
                                    <a href="{{ route('admin.edit', $user->id) }}" class="btn-edit">Edit</a>
                                    @if($user->id !== auth()->id())
                                        <form action="{{ route('admin.destroy', $user->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin hapus user ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-hapus">Hapus</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    @endif
                @endforeach

                @if($users->isEmpty())
                    <tr>
                        <td colspan="6">
                            <div class="empty-state">
                                <div class="empty-icon">👤</div>
                                <p>Belum ada user.</p>
                            </div>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
</x-layouts::app>