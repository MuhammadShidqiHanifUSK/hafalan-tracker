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

    <div class="table-wrap">
        <table class="setoran-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td class="no-cell">{{ $loop->iteration }}</td>
                        <td class="santri-name">{{ $user->name }}</td>
                        <td style="color: #374151;">{{ $user->email }}</td>
                        <td>
                            @if($user->role == 'admin')
                                <span style="background: #f3e8ff; color: #7c3aed; padding: 0.2rem 0.6rem; border-radius: 999px; font-size: 0.75rem; font-weight: 600;">Admin</span>
                            @elseif($user->role == 'ustadz')
                                <span style="background: #dcfce7; color: #16a34a; padding: 0.2rem 0.6rem; border-radius: 999px; font-size: 0.75rem; font-weight: 600;">Ustadz</span>
                            @elseif($user->role == 'ortu')
                                <span style="background: #dbeafe; color: #2563eb; padding: 0.2rem 0.6rem; border-radius: 999px; font-size: 0.75rem; font-weight: 600;">Ortu</span>
                            @else
                                <span style="background: #fef9c3; color: #854d0e; padding: 0.2rem 0.6rem; border-radius: 999px; font-size: 0.75rem; font-weight: 600;">Santri</span>
                            @endif
                        </td>
                        <td>
                            <div class="aksi-wrap">
                                <a href="{{ route('admin.edit', $user->id) }}" class="btn-edit">Edit</a>
                                @if($user->id !== auth()->id())
                                    <form action="{{ route('admin.destroy', $user->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-hapus">Hapus</button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">
                            <div class="empty-state">
                                <div class="empty-icon">👤</div>
                                <p>Belum ada user.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top: 1rem;">
        {{ $users->links() }}
    </div>
</div>
</x-layouts::app>