<x-layouts.app>
    <x-slot name="title">Tambah Setoran</x-slot>

    <div class="max-w-4xl mx-auto px-4 py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Tambah Setoran</h1>
            <a href="{{ route('setoran.index') }}"
                class="text-gray-600 hover:underline">← Kembali</a>
        </div>

        <form action="{{ route('setoran.store') }}" method="POST">
            @csrf

            <div class="bg-white rounded shadow p-6 space-y-6">

                {{-- Pilih Santri & Tanggal --}}
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Santri</label>
                        <select name="user_id" class="w-full border rounded px-3 py-2 text-sm">
                            <option value="">-- Pilih Santri --</option>
                            @foreach($santris as $santri)
                                <option value="{{ $santri->id }}" {{ old('user_id') == $santri->id ? 'selected' : '' }}>
                                    {{ $santri->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('user_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                        <input type="date" name="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}"
                            class="w-full border rounded px-3 py-2 text-sm">
                        @error('tanggal') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                {{-- Sabaq --}}
                <div class="border rounded p-4">
                    <h2 class="font-semibold text-gray-700 mb-3">Sabaq (Hafalan Baru)</h2>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Surah</label>
                            <select name="sabaq_surah_id" class="w-full border rounded px-3 py-2 text-sm">
                                <option value="">-- Pilih Surah --</option>
                                @foreach($surahs as $surah)
                                    <option value="{{ $surah->id }}" {{ old('sabaq_surah_id') == $surah->id ? 'selected' : '' }}>
                                        {{ $surah->nomor }}. {{ $surah->nama_latin }}
                                    </option>
                                @endforeach
                            </select>
                            @error('sabaq_surah_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nilai</label>
                            <select name="sabaq_nilai" class="w-full border rounded px-3 py-2 text-sm">
                                <option value="">-- Pilih Nilai --</option>
                                <option value="L" {{ old('sabaq_nilai') == 'L' ? 'selected' : '' }}>L (Lancar)</option>
                                <option value="KL" {{ old('sabaq_nilai') == 'KL' ? 'selected' : '' }}>KL (Kurang Lancar)</option>
                                <option value="U" {{ old('sabaq_nilai') == 'U' ? 'selected' : '' }}>U (Harus Diulang)</option>
                            </select>
                            @error('sabaq_nilai') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Ayat Mulai</label>
                            <input type="number" name="sabaq_ayat_mulai" value="{{ old('sabaq_ayat_mulai') }}"
                                class="w-full border rounded px-3 py-2 text-sm" min="1">
                            @error('sabaq_ayat_mulai') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Ayat Selesai</label>
                            <input type="number" name="sabaq_ayat_selesai" value="{{ old('sabaq_ayat_selesai') }}"
                                class="w-full border rounded px-3 py-2 text-sm" min="1">
                            @error('sabaq_ayat_selesai') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah Baris</label>
                            <input type="number" name="sabaq_jumlah_baris" value="{{ old('sabaq_jumlah_baris') }}"
                                class="w-full border rounded px-3 py-2 text-sm" min="1">
                            @error('sabaq_jumlah_baris') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                        Simpan Setoran
                    </button>
                </div>

            </div>
        </form>
    </div>
</x-layouts.app>