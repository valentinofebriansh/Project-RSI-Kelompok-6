@extends('layouts.app')

@section('title', 'Daftar Akun Mahasiswa - Game Corner FILKOM UB')

@section('content')
    <!-- 1. LATAR BELAKANG: SELURUH KONTEN WELCOME.BLADE.PHP (BLUR & DIM) -->
    <div class="scrollable-content background-screen-blurred" aria-hidden="true">
      @include('partials.welcome_content')
    </div>

    <!-- 2. MODAL OVERLAY: FORMULIR PENDAFTARAN MAHASISWA -->
    <section class="modal-backdrop-overlay" id="modalRegisterMahasiswa" data-home-url="{{ route('home') }}" role="dialog" aria-modal="true" aria-labelledby="registerTitle" style="padding: 28px 16px 32px 16px; overflow-y: auto; cursor: pointer;">
      <div class="modal-login-card" style="padding: 24px 20px; cursor: default;">

        <!-- Tombol Tutup (X) Kembali ke Halaman Utama -->
        <button type="button" class="btn-close-modal" data-href="{{ route('home') }}" onclick="window.location.href=this.dataset.href" aria-label="Tutup Dialog Pendaftaran">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="18" y1="6" x2="6" y2="18"></line>
            <line x1="6" y1="6" x2="18" y2="18"></line>
          </svg>
        </button>

        <span class="pill-iam-tag">REGISTRASI AKUN</span>
        <h1 class="modal-login-title" id="registerTitle">Buat Akun Baru</h1>
        <p class="modal-login-subtitle" style="margin-bottom: 18px;">
          Lengkapi data mahasiswa FILKOM UB untuk mulai melakukan reservasi Game Corner.
        </p>

        <!-- Formulir Registrasi (Sesuai Kolom Tabel users) -->
        <form class="login-form-content" action="{{ route('register.submit') }}" method="POST" style="gap: 13px;">
          @csrf
          @if ($errors->any())
            <div style="background: #FEE2E2; color: #B91C1C; padding: 10px 12px; border-radius: 10px; font-size: 12px;">
              {{ $errors->first() }}
            </div>
          @endif

          <!-- Field Nama Lengkap -->
          <div class="form-group-field">
            <label for="txtNama" class="field-label">Nama Lengkap</label>
            <div class="input-icon-container">
              <svg class="leading-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                <circle cx="12" cy="7" r="4"></circle>
              </svg>
              <input type="text" id="txtNama" name="name" value="{{ old('name') }}" class="form-input-text" placeholder="Masukkan nama lengkap sesuai KTM" required autocomplete="name">
            </div>
          </div>

          <!-- Field NIM -->
          <div class="form-group-field">
            <label for="txtNim" class="field-label">NIM</label>
            <div class="input-icon-container">
              <svg class="leading-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="4" width="18" height="16" rx="2"></rect>
                <line x1="7" y1="9" x2="17" y2="9"></line>
                <line x1="7" y1="13" x2="13" y2="13"></line>
              </svg>
              <input type="text" id="txtNim" name="nim" value="{{ old('nim') }}" class="form-input-text" placeholder="Contoh: 25515040..." required>
            </div>
          </div>

          <!-- Field Email UB -->
          <div class="form-group-field">
            <label for="txtEmail" class="field-label">Email UB</label>
            <div class="input-icon-container">
              <svg class="leading-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="2" y="4" width="20" height="16" rx="2"></rect>
                <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
              </svg>
              <input type="email" id="txtEmail" name="email" value="{{ old('email') }}" class="form-input-text" placeholder="Contoh: nama@student.ub.ac.id" required autocomplete="email">
            </div>
          </div>

          <!-- Field No. WhatsApp -->
          <div class="form-group-field">
            <label for="txtWhatsapp" class="field-label">No. WhatsApp</label>
            <div class="input-icon-container">
              <svg class="leading-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
              </svg>
              <input type="tel" id="txtWhatsapp" name="no_whatsapp" value="{{ old('no_whatsapp') }}" class="form-input-text" placeholder="Contoh: 081234567890" required autocomplete="tel">
            </div>
          </div>

          <!-- Field Password -->
          <div class="form-group-field">
            <label for="txtRegPassword" class="field-label">Password</label>
            <div class="input-icon-container">
              <svg class="leading-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
              </svg>
              <input type="password" id="txtRegPassword" name="password" class="form-input-text has-trailing" placeholder="Minimal 8 karakter" required autocomplete="new-password">
              <button type="button" class="trailing-icon-btn" id="btnToggleRegPassword" aria-label="Lihat Password">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                  <circle cx="12" cy="12" r="3"></circle>
                </svg>
              </button>
            </div>
          </div>

          <!-- Field Konfirmasi Password -->
          <div class="form-group-field">
            <label for="txtRegPasswordConfirm" class="field-label">Konfirmasi Password</label>
            <div class="input-icon-container">
              <svg class="leading-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
              </svg>
              <input type="password" id="txtRegPasswordConfirm" name="password_confirmation" class="form-input-text" placeholder="Ulangi password Anda" required autocomplete="new-password">
            </div>
          </div>

          <!-- Tombol Daftar -->
          <button type="submit" class="btn-submit-sso" id="btnSubmitRegister">
            <span>Daftar Sekarang</span>
          </button>

          <!-- Tautan Kembali ke Login -->
          <p style="text-align: center; font-family: var(--font-caption); font-size: 12px; color: var(--neutral-600); margin-top: 4px;">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="forgot-password-link">Masuk di sini</a>
          </p>

        </form>

      </div>
    </section>
@endsection

@push('scripts')
  <script>
    const btnToggleRegPassword = document.getElementById('btnToggleRegPassword');
    const inputRegPassword = document.getElementById('txtRegPassword');
    const modalRegisterBackdrop = document.getElementById('modalRegisterMahasiswa');
    const modalRegisterCard = modalRegisterBackdrop.querySelector('.modal-login-card');

    btnToggleRegPassword.addEventListener('click', () => {
      const isPassword = inputRegPassword.type === 'password';
      inputRegPassword.type = isPassword ? 'text' : 'password';
      btnToggleRegPassword.style.color = isPassword ? '#160BB6' : '#585860';
    });

    // Klik pada area blur di luar kotak modal akan kembali ke welcome.blade.php
    modalRegisterBackdrop.addEventListener('click', (event) => {
      if (!modalRegisterCard.contains(event.target)) {
        window.location.href = modalRegisterBackdrop.dataset.homeUrl;
      }
    });
  </script>
@endpush