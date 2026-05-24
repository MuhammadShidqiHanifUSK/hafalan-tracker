<x-layouts::app title="Edit Setoran">
<link rel="stylesheet" href="{{ asset('css/hafalan.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css">
<style>
    .optional-badge {
        font-size: 0.7rem;
        background: #f0fdf4;
        color: #16a34a;
        border: 1px solid #bbf7d0;
        padding: 0.15rem 0.5rem;
        border-radius: 999px;
        font-weight: 500;
        margin-left: 0.5rem;
        vertical-align: middle;
    }
    .required-badge {
        font-size: 0.7rem;
        background: #fef2f2;
        color: #dc2626;
        border: 1px solid #fecaca;
        padding: 0.15rem 0.5rem;
        border-radius: 999px;
        font-weight: 500;
        margin-left: 0.5rem;
        vertical-align: middle;
    }
</style>

<div class="hafalan-wrap">
    <div class="hafalan-header">
        <div class="hafalan-title-wrap">
            <div class="hafalan-icon">✏️</div>
            <div>
                <h1 class="hafalan-title">Edit Setoran</h1>
                <p class="hafalan-subtitle">{{ $setoran->user->name }} — {{ \Carbon\Carbon::parse($setoran->tanggal)->format('d M Y') }}</p>
            </div>
        </div>
        <a href="{{ route('setoran.index') }}" class="btn-kembali">← Kembali</a>
    </div>

    @if($errors->any())
        <div class="alert-error">
            <strong>Terdapat kesalahan input:</strong>
            <ul style="margin: 0.5rem 0 0 1rem; padding: 0;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('setoran.update', $setoran->id) }}" method="POST">
        @csrf
        @method('PUT')

        @php
            $sabaq  = $setoran->sabaq->first();
            $sabqi  = $setoran->sabqi->first();
            $manzil = $setoran->manzil->first();
        @endphp

        {{-- Tanggal --}}
        <div class="hafalan-card">
            <h2 class="hafalan-card-title">👤 Informasi Setoran</h2>
            <div class="form-group" style="max-width: 300px;">
                <label class="form-label">Tanggal Setoran <span class="required-badge">Wajib</span></label>
                <input type="date" name="tanggal" value="{{ old('tanggal', $setoran->tanggal) }}"
                    class="form-input" style="color-scheme: light;">
                @error('tanggal') <p class="form-error">{{ $message }}</p> @enderror
            </div>
        </div>

        {{-- Sabaq --}}
        <div class="hafalan-card">
            <h2 class="hafalan-card-title">📗 Sabaq (Hafalan Baru) <span class="required-badge">Wajib</span></h2>
            <div class="form-grid-2">
                <div class="form-group">
                    <label class="form-label">Surah</label>
                    <select name="sabaq_surah_id" id="select-sabaq-surah">
                        <option value="">-- Cari Surah --</option>
                        @foreach($surahs as $surah)
                            <option value="{{ $surah->id }}" {{ old('sabaq_surah_id', $sabaq?->surah_id) == $surah->id ? 'selected' : '' }}>
                                {{ $surah->nomor }}. {{ $surah->nama_latin }}
                            </option>
                        @endforeach
                    </select>
                    @error('sabaq_surah_id') <p class="form-error">{{ $message }}</p> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Nilai</label>
                    <select name="sabaq_nilai" class="form-select">
                        <option value="">-- Pilih Nilai --</option>
                        <option value="L" {{ old('sabaq_nilai', $sabaq?->nilai) == 'L' ? 'selected' : '' }}>L — Lancar</option>
                        <option value="KL" {{ old('sabaq_nilai', $sabaq?->nilai) == 'KL' ? 'selected' : '' }}>KL — Kurang Lancar</option>
                        <option value="U" {{ old('sabaq_nilai', $sabaq?->nilai) == 'U' ? 'selected' : '' }}>U — Harus Diulang</option>
                    </select>
                    @error('sabaq_nilai') <p class="form-error">{{ $message }}</p> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Ayat Mulai</label>
                    <input type="number" name="sabaq_ayat_mulai" value="{{ old('sabaq_ayat_mulai', $sabaq?->ayat_mulai) }}"
                        min="1" placeholder="contoh: 1" class="form-input">
                    @error('sabaq_ayat_mulai') <p class="form-error">{{ $message }}</p> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Ayat Selesai</label>
                    <input type="number" name="sabaq_ayat_selesai" value="{{ old('sabaq_ayat_selesai', $sabaq?->ayat_selesai) }}"
                        min="1" placeholder="contoh: 10" class="form-input">
                    @error('sabaq_ayat_selesai') <p class="form-error">{{ $message }}</p> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Jumlah Baris</label>
                    <input type="number" name="sabaq_jumlah_baris" value="{{ old('sabaq_jumlah_baris', $sabaq?->jumlah_baris) }}"
                        min="1" placeholder="contoh: 8" class="form-input">
                    @error('sabaq_jumlah_baris') <p class="form-error">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        {{-- Sabqi --}}
        <div class="hafalan-card">
            <h2 class="hafalan-card-title">📘 Sabqi (Murajaah Hafalan Baru) <span class="required-badge">Wajib</span></h2>
            <div class="form-grid-2">
                <div class="form-group">
                    <label class="form-label">Surah</label>
                    <select name="sabqi_surah_id" id="select-sabqi-surah">
                        <option value="">-- Cari Surah --</option>
                        @foreach($surahs as $surah)
                            <option value="{{ $surah->id }}" {{ old('sabqi_surah_id', $sabqi?->surah_id) == $surah->id ? 'selected' : '' }}>
                                {{ $surah->nomor }}. {{ $surah->nama_latin }}
                            </option>
                        @endforeach
                    </select>
                    @error('sabqi_surah_id') <p class="form-error">{{ $message }}</p> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Nilai</label>
                    <select name="sabqi_nilai" class="form-select">
                        <option value="">-- Pilih Nilai --</option>
                        <option value="L" {{ old('sabqi_nilai', $sabqi?->nilai) == 'L' ? 'selected' : '' }}>L — Lancar</option>
                        <option value="KL" {{ old('sabqi_nilai', $sabqi?->nilai) == 'KL' ? 'selected' : '' }}>KL — Kurang Lancar</option>
                        <option value="U" {{ old('sabqi_nilai', $sabqi?->nilai) == 'U' ? 'selected' : '' }}>U — Harus Diulang</option>
                    </select>
                    @error('sabqi_nilai') <p class="form-error">{{ $message }}</p> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Ayat Mulai</label>
                    <input type="number" name="sabqi_ayat_mulai" value="{{ old('sabqi_ayat_mulai', $sabqi?->ayat_mulai) }}"
                        min="1" placeholder="contoh: 1" class="form-input">
                    @error('sabqi_ayat_mulai') <p class="form-error">{{ $message }}</p> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Ayat Selesai</label>
                    <input type="number" name="sabqi_ayat_selesai" value="{{ old('sabqi_ayat_selesai', $sabqi?->ayat_selesai) }}"
                        min="1" placeholder="contoh: 10" class="form-input">
                    @error('sabqi_ayat_selesai') <p class="form-error">{{ $message }}</p> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Jumlah Halaman</label>
                    <input type="number" name="sabqi_jumlah_halaman" value="{{ old('sabqi_jumlah_halaman', $sabqi?->jumlah_halaman) }}"
                        min="1" placeholder="contoh: 2" class="form-input">
                    @error('sabqi_jumlah_halaman') <p class="form-error">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        {{-- Manzil --}}
        <div class="hafalan-card">
            <h2 class="hafalan-card-title">📙 Manzil (Murajaah di Rumah) <span class="required-badge">Wajib</span></h2>
            <div class="form-grid-2">
                <div class="form-group">
                    <label class="form-label">Surah</label>
                    <select name="manzil_surah_id" id="select-manzil-surah">
                        <option value="">-- Cari Surah --</option>
                        @foreach($surahs as $surah)
                            <option value="{{ $surah->id }}" {{ old('manzil_surah_id', $manzil?->surah_id) == $surah->id ? 'selected' : '' }}>
                                {{ $surah->nomor }}. {{ $surah->nama_latin }}
                            </option>
                        @endforeach
                    </select>
                    @error('manzil_surah_id') <p class="form-error">{{ $message }}</p> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Nilai</label>
                    <select name="manzil_nilai" class="form-select">
                        <option value="">-- Pilih Nilai --</option>
                        <option value="L" {{ old('manzil_nilai', $manzil?->nilai) == 'L' ? 'selected' : '' }}>L — Lancar</option>
                        <option value="KL" {{ old('manzil_nilai', $manzil?->nilai) == 'KL' ? 'selected' : '' }}>KL — Kurang Lancar</option>
                        <option value="U" {{ old('manzil_nilai', $manzil?->nilai) == 'U' ? 'selected' : '' }}>U — Harus Diulang</option>
                    </select>
                    @error('manzil_nilai') <p class="form-error">{{ $message }}</p> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Ayat Mulai</label>
                    <input type="number" name="manzil_ayat_mulai" value="{{ old('manzil_ayat_mulai', $manzil?->ayat_mulai) }}"
                        min="1" placeholder="contoh: 1" class="form-input">
                    @error('manzil_ayat_mulai') <p class="form-error">{{ $message }}</p> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Ayat Selesai</label>
                    <input type="number" name="manzil_ayat_selesai" value="{{ old('manzil_ayat_selesai', $manzil?->ayat_selesai) }}"
                        min="1" placeholder="contoh: 10" class="form-input">
                    @error('manzil_ayat_selesai') <p class="form-error">{{ $message }}</p> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Jumlah Halaman</label>
                    <input type="number" name="manzil_jumlah_halaman" value="{{ old('manzil_jumlah_halaman', $manzil?->jumlah_halaman) }}"
                        min="1" placeholder="contoh: 2" class="form-input">
                    @error('manzil_jumlah_halaman') <p class="form-error">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <div style="display: flex; justify-content: flex-end; gap: 0.75rem; margin-bottom: 2rem;">
            <a href="{{ route('setoran.index') }}" class="btn-kembali">Batal</a>
            <button type="submit" class="btn-submit">💾 Update Setoran</button>
        </div>

    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
<script>
    new TomSelect('#select-sabaq-surah', { maxOptions: 114, allowEmptyOption: false, placeholder: 'Ketik nama atau nomor surah...' });
    new TomSelect('#select-sabqi-surah', { maxOptions: 114, allowEmptyOption: false, placeholder: 'Ketik nama atau nomor surah...' });
    new TomSelect('#select-manzil-surah', { maxOptions: 114, allowEmptyOption: false, placeholder: 'Ketik nama atau nomor surah...' });
</script>
</x-layouts::app>