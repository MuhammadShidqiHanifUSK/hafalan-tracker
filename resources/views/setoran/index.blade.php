<x-layouts::app title="Daftar Setoran">
    <div class="max-w-7xl mx-auto px-4 py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Daftar Setoran</h1>
            <a href="{{ route('setoran.create') }}"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                + Tambah Setoran
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded shadow overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-100 text-gray-600">
                    <tr>
                        <th class="px-4 py-3 text-left">No</th>
                        <th class="px-4 py-3 text-left">Santri</th>
                        <th class="px-4 py-3 text-left">Tanggal</th>
                        <th class="px-4 py-3 text-left">Paraf Guru</th>
                        <th class="px-4 py-3 text-left">Paraf Ortu</th>
                        <th class="px-4 py-3 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($setorans as $setoran)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3">{{ $setoran->user->name }}</td>
                            <td class="px-4 py-3">{{ \Carbon\Carbon::parse($setoran->tanggal)->format('d M Y') }}</td>
                            <td class="px-4 py-3">
                                @if($setoran->paraf_guru)
                                    <span class="text-green-600 font-bold">✓ Sudah</span>
                                @else
                                    <span class="text-red-500">✗ Belum</span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                @if($setoran->paraf_ortu)
                                    <span class="text-green-600 font-bold">✓ Sudah</span>
                                @else
                                    <span class="text-red-500">✗ Belum</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 flex gap-2">
                                <a href="{{ route('setoran.show', $setoran->id) }}"
                                    class="text-blue-600 hover:underline">Detail</a>
                                <a href="{{ route('setoran.edit', $setoran->id) }}"
                                    class="text-yellow-600 hover:underline">Edit</a>
                                <form action="{{ route('setoran.destroy', $setoran->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin hapus setoran ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-6 text-center text-gray-400">Belum ada data setoran.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $setorans->links() }}
        </div>
    </div>
</x-layouts::app>