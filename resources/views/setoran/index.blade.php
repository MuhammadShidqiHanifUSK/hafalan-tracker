<x-layouts::app title="Daftar Setoran">
<style>
    .setoran-table th, .setoran-table td {
        color: #111827 !important;
    }
</style>
    <div style="color: #111827;">
        <div style="max-width: 72rem; margin: 0 auto; padding: 1.5rem 1rem;">

            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                <h1 style="font-size: 1.5rem; font-weight: 700; color: #1f2937; background: #ffffff; padding: 0.5rem 1rem; border-radius: 0.5rem;">Daftar Setoran</h1>
                <a href="{{ route('setoran.create') }}"
                    style="background: #2563eb; color: #ffffff; padding: 0.5rem 1rem; border-radius: 0.375rem; text-decoration: none; font-size: 0.875rem;">
                    + Tambah Setoran
                </a>
            </div>

            @if(session('success'))
                <div style="background: #dcfce7; color: #166534; padding: 0.75rem 1rem; border-radius: 0.375rem; margin-bottom: 1rem;">
                    {{ session('success') }}
                </div>
            @endif

            <div style="background: #ffffff; border-radius: 0.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); overflow-x: auto;">
                <table class="setoran-table" style="width: 100%; border-collapse: collapse; font-size: 0.875rem;">
                    <thead>
                        <tr style="background: #f3f4f6;">
                            <th style="padding: 0.75rem 1rem; text-align: left; color: #374151; font-weight: 600;">No</th>
                            <th style="padding: 0.75rem 1rem; text-align: left; color: #374151; font-weight: 600;">Santri</th>
                            <th style="padding: 0.75rem 1rem; text-align: left; color: #374151; font-weight: 600;">Tanggal</th>
                            <th style="padding: 0.75rem 1rem; text-align: left; color: #374151; font-weight: 600;">Paraf Guru</th>
                            <th style="padding: 0.75rem 1rem; text-align: left; color: #374151; font-weight: 600;">Paraf Ortu</th>
                            <th style="padding: 0.75rem 1rem; text-align: left; color: #374151; font-weight: 600;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($setorans as $setoran)
                            <tr style="border-top: 1px solid #f3f4f6;">
                                <td style="padding: 0.75rem 1rem; color: #111827;">{{ $loop->iteration }}</td>
                                <td style="padding: 0.75rem 1rem; color: #111827;">{{ $setoran->user->name }}</td>
                                <td style="padding: 0.75rem 1rem; color: #111827;">{{ \Carbon\Carbon::parse($setoran->tanggal)->format('d M Y') }}</td>
                                <td style="padding: 0.75rem 1rem;">
                                    @if($setoran->paraf_guru)
                                        <span style="color: #16a34a; font-weight: 600;">✓ Sudah</span>
                                    @else
                                        <span style="color: #dc2626;">✗ Belum</span>
                                    @endif
                                </td>
                                <td style="padding: 0.75rem 1rem;">
                                    @if($setoran->paraf_ortu)
                                        <span style="color: #16a34a; font-weight: 600;">✓ Sudah</span>
                                    @else
                                        <span style="color: #dc2626;">✗ Belum</span>
                                    @endif
                                </td>
                                <td style="padding: 0.75rem 1rem;">
                                    <div style="display: flex; gap: 0.75rem;">
                                        <a href="{{ route('setoran.show', $setoran->id) }}"
                                            style="color: #2563eb; text-decoration: underline; font-size: 0.875rem;">Detail</a>
                                        <a href="{{ route('setoran.edit', $setoran->id) }}"
                                            style="color: #d97706; text-decoration: underline; font-size: 0.875rem;">Edit</a>
                                        <form action="{{ route('setoran.destroy', $setoran->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin hapus setoran ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                style="color: #dc2626; text-decoration: underline; font-size: 0.875rem; background: none; border: none; cursor: pointer; padding: 0;">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" style="padding: 2rem 1rem; text-align: center; color: #6b7280;">
                                    Belum ada data setoran.
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
    </div>
</x-layouts::app>