<x-layouts::app title="Tambah User">
<link rel="stylesheet" href="{{ asset('css/hafalan.css') }}">

<div class="hafalan-wrap">
    <div class="hafalan-header">
        <div class="hafalan-title-wrap">
            <div class="hafalan-icon">➕</div>
            <div>
                <h1 class="hafalan-title">Tambah User</h1>
                <p class="hafalan-subtitle">Buat akun pengguna baru</p>
            </div>
        </div>
        <a href="{{ route('admin.index') }}" class="btn-kembali">← Kembali</a>
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

    <form action="{{ route('admin.store') }}" method="POST">
        @csrf
        <div class="hafalan-card">
            <h2 class="hafalan-card-title">👤 Informasi User</h2>
            <div class="form-grid-2">
                <div class="form-group">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                        class="form-input" placeholder="contoh: Ahmad Fauzi">
                    @error('name') <p class="form-error">{{ $message }}</p> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                        class="form-input" placeholder="contoh: ahmad@gmail.com">
                    @error('email') <p class="form-error">{{ $message }}</p> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Password</label>
                    <input type="password" name="password"
                        class="form-input" placeholder="Minimal 6 karakter">
                    @error('password') <p class="form-error">{{ $message }}</p> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation"
                        class="form-input" placeholder="Ulangi password">
                </div>
                <div class="form-group">
                    <label class="form-label">Role</label>
                    <select name="role" class="form-select">
                        <option value="">-- Pilih Role --</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="ustadz" {{ old('role') == 'ustadz' ? 'selected' : '' }}>Ustadz</option>
                        <option value="ortu" {{ old('role') == 'ortu' ? 'selected' : '' }}>Orang Tua</option>
                        <option value="santri" {{ old('role') == 'santri' ? 'selected' : '' }}>Santri</option>
                    </select>
                    @error('role') <p class="form-error">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <div style="display: flex; justify-content: flex-end; gap: 0.75rem; margin-bottom: 2rem;">
            <a href="{{ route('admin.index') }}" class="btn-kembali">Batal</a>
            <button type="submit" class="btn-submit">💾 Simpan User</button>
        </div>
    </form>
</div>
</x-layouts::app>