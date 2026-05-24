<x-layouts::app title="Edit Setoran">
<style>
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    input[type=number] {
        -moz-appearance: textfield;
    }
    .ts-wrapper .ts-control {
        background: #ffffff !important;
        color: #111827 !important;
        border: 1px solid #d1d5db !important;
        border-radius: 0.375rem !important;
        padding: 0.5rem 0.75rem !important;
        font-size: 0.875rem !important;
        box-shadow: none !important;
    }
    .ts-wrapper .ts-dropdown {
        background: #ffffff !important;
        color: #111827 !important;
        border: 1px solid #d1d5db !important;
    }
    .ts-wrapper .ts-dropdown .option:hover,
    .ts-wrapper .ts-dropdown .option.active {
        background: #dbeafe !important;
        color: #1e40af !important;
    }
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css">

    <div style="color: #111827;">
        <div style="max-width: 56rem; margin: 0 auto; padding: 1.5rem 1rem;">

            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                <h1 style="font-size: 1.5rem; font-weight: 700; color: #1f2937; background: #ffffff; padding: 0.5rem 1rem; border-radius: 0.5rem;">Edit Setoran</h1>
                <a href="{{ route('setoran.index') }}" style="color: #4b5563; text-decoration: underline;">← Kembali</a>
            </div>

            <form action="{{ route('setoran.update', $setoran->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div style="background: #f9fafb; border-radius: 0.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); padding: 1.5rem;">

                    {{-- Tanggal --}}
                    <div style="margin-bottom: 1.5rem;">
                        <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.25rem;">Tanggal</label>
                        <input type="date" name="tanggal" value="{{ old('tanggal', $setoran->tanggal) }}"
                            style="width: 100%; border: 1px solid #d1d5db; border-radius: 0.375rem; padding: 0.5rem 0.75rem; font-size: 0.875rem; background: #ffffff; color: #111827; color-scheme: light;">
                        @error('tanggal') <p style="color: #ef4444; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p> @enderror
                    </div>

                    {{-- Sabaq --}}
                    <div style="border: 1px solid #e5e7eb; border-radius: 0.5rem; padding: 1rem; background: #ffffff; margin-bottom: 1.5rem;">
                        <h2 style="font-weight: 600; color: #374151; margin-bottom: 0.75rem;">Sabaq (Hafalan Baru)</h2>
                        @php $sabaq = $setoran->sabaq->first(); @endphp
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                            <div>
                                <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.25rem;">Surah</label>
                                <select name="sabaq_surah_id" id="select-sabaq-surah" style="width: 100%;">
                                    <option value="">-- Cari Surah --</option>
                                    @foreach($surahs as $surah)
                                        <option value="{{ $surah->id }}" {{ old('sabaq_surah_id', $sabaq?->surah_id) == $surah->id ? 'selected' : '' }}>
                                            {{ $surah->nomor }}. {{ $surah->nama_latin }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('sabaq_surah_id') <p style="color: #ef4444; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.25rem;">Nilai</label>
                                <select name="sabaq_nilai" style="width: 100%; border: 1px solid #d1d5db; border-radius: 0.375rem; padding: 0.5rem 0.75rem; font-size: 0.875rem; background: #ffffff; color: #111827;">
                                    <option value="">-- Pilih Nilai --</option>
                                    <option value="L" {{ old('sabaq_nilai', $sabaq?->nilai) == 'L' ? 'selected' : '' }}>L (Lancar)</option>
                                    <option value="KL" {{ old('sabaq_nilai', $sabaq?->nilai) == 'KL' ? 'selected' : '' }}>KL (Kurang Lancar)</option>
                                    <option value="U" {{ old('sabaq_nilai', $sabaq?->nilai) == 'U' ? 'selected' : '' }}>U (Harus Diulang)</option>
                                </select>
                                @error('sabaq_nilai') <p style="color: #ef4444; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.25rem;">Ayat Mulai</label>
                                <input type="number" name="sabaq_ayat_mulai" value="{{ old('sabaq_ayat_mulai', $sabaq?->ayat_mulai) }}" min="1" placeholder="contoh: 1"
                                    style="width: 100%; border: 1px solid #d1d5db; border-radius: 0.375rem; padding: 0.5rem 0.75rem; font-size: 0.875rem; background: #ffffff; color: #111827;">
                                @error('sabaq_ayat_mulai') <p style="color: #ef4444; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.25rem;">Ayat Selesai</label>
                                <input type="number" name="sabaq_ayat_selesai" value="{{ old('sabaq_ayat_selesai', $sabaq?->ayat_selesai) }}" min="1" placeholder="contoh: 10"
                                    style="width: 100%; border: 1px solid #d1d5db; border-radius: 0.375rem; padding: 0.5rem 0.75rem; font-size: 0.875rem; background: #ffffff; color: #111827;">
                                @error('sabaq_ayat_selesai') <p style="color: #ef4444; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.25rem;">Jumlah Baris</label>
                                <input type="number" name="sabaq_jumlah_baris" value="{{ old('sabaq_jumlah_baris', $sabaq?->jumlah_baris) }}" min="1" placeholder="contoh: 8"
                                    style="width: 100%; border: 1px solid #d1d5db; border-radius: 0.375rem; padding: 0.5rem 0.75rem; font-size: 0.875rem; background: #ffffff; color: #111827;">
                                @error('sabaq_jumlah_baris') <p style="color: #ef4444; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>

                    <div style="display: flex; justify-content: flex-end;">
                        <button type="submit"
                            style="background: #2563eb; color: #ffffff; padding: 0.5rem 1.5rem; border-radius: 0.375rem; border: none; cursor: pointer; font-size: 0.875rem; font-weight: 500;">
                            Update Setoran
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
<script>
    new TomSelect('#select-sabaq-surah', {
        maxOptions: 114,
        allowEmptyOption: false,
        placeholder: 'Ketik nama atau nomor surah...',
    });
</script>
</x-layouts::app>