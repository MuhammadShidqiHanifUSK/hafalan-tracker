<x-layouts::app title="Edit User">
<link rel="stylesheet" href="{{ asset('css/hafalan.css') }}">

<div class="hafalan-wrap">
    <div class="hafalan-header">
        <div class="hafalan-title-wrap">
            <div class="hafalan-icon">✏️</div>
            <div>
                <h1 class="hafalan-title">Edit User</h1>
                <p class="hafalan-subtitle">{{ $user->name }}</p>
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

    <form action="{{ route('admin.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="hafalan-card">
            <h2 class="hafalan-card-title">👤 Informasi User</h2>
            <div class="form-grid-2">
                <div class="form-group">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}"
                        class="form-input">
                    @error('name') <p class="form-error">{{ $message }}</p> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}"
                        class="form-input">
                    @error('email') <p class="form-error">{{ $message }}</p> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Password Baru <span style="color: #9ca3af; font-weight: 400;">(kosongkan jika tidak diubah)</span></label>
                    <input type="password" name="password"
                        class="form-input" placeholder="Minimal 6 karakter">
                    @error('password') <p class="form-error">{{ $message }}</p> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation"
                        class="form-input" placeholder="Ulangi password baru">
                </div>
                <div class="form-group">
                    <label class="form-label">Role</label>
                    <select name="role" class="form-select" id="role-select">
                        <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="ustadz" {{ old('role', $user->role) == 'ustadz' ? 'selected' : '' }}>Ustadz</option>
                        <option value="ortu" {{ old('role', $user->role) == 'ortu' ? 'selected' : '' }}>Orang Tua</option>
                        <option value="santri" {{ old('role', $user->role) == 'santri' ? 'selected' : '' }}>Santri</option>
                    </select>
                    @error('role') <p class="form-error">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        {{-- Relasi ortu-santri (muncul kalau role ortu) --}}
        <div class="hafalan-card" id="ortu-section" style="{{ old('role', $user->role) == 'ortu' ? '' : 'display:none;' }}">
            <h2 class="hafalan-card-title">👨‍👦 Hubungkan ke Santri</h2>
            <div class="form-group">
                <label class="form-label">Santri</label>
                <select name="santri_id" class="form-select">
                    <option value="">-- Pilih Santri --</option>
                    @foreach($santris as $santri)
                        <option value="{{ $santri->id }}"
                            {{ old('santri_id', $ortuSantri?->santri_id) == $santri->id ? 'selected' : '' }}>
                            {{ $santri->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div style="display: flex; justify-content: flex-end; gap: 0.75rem; margin-bottom: 2rem;">
            <a href="{{ route('admin.index') }}" class="btn-kembali">Batal</a>
            <button type="submit" class="btn-submit">💾 Update User</button>
        </div>
    </form>
</div>

<script>
    document.getElementById('role-select').addEventListener('change', function() {
        const ortuSection = document.getElementById('ortu-section');
        ortuSection.style.display = this.value === 'ortu' ? '' : 'none';
    });
</script>
</x-layouts::app>