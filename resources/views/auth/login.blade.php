@extends('layouts.app')

@section('title', 'Halaman Login Mahasiswa - Game Corner FILKOM UB')

@section('content')
    <!-- 1. LATAR BELAKANG: SELURUH KONTEN WELCOME.BLADE.PHP (BLUR & DIM) -->
    <div class="scrollable-content background-screen-blurred" aria-hidden="true">
      @include('partials.welcome_content')
    </div>

    <!-- 2. MODAL OVERLAY: DIALOG LOGIN MAHASISWA -->
    <section class="modal-backdrop-overlay" id="modalLoginMahasiswa" data-home-url="{{ route('home') }}" role="dialog" aria-modal="true" aria-labelledby="loginTitle" style="padding: 64px 16px 32px 16px; overflow-y: auto; cursor: pointer;">
      <div class="modal-login-card" style="cursor: default;">

        <!-- Tombol Tutup (X) Mengembalikan ke Halaman Utama -->
        <button type="button" class="btn-close-modal" data-href="{{ route('home') }}" onclick="window.location.href=this.dataset.href" id="btnCloseModal" aria-label="Tutup Dialog Login">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="18" y1="6" x2="6" y2="18"></line>
            <line x1="6" y1="6" x2="18" y2="18"></line>
          </svg>
        </button>

        <!-- Icon Shield & Identitas Akun -->
        <div class="shield-icon-wrapper">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
            <polyline points="9 12 11 14 15 10"></polyline>
          </svg>
        </div>

        <span class="pill-iam-tag">HALAMAN MASUK</span>
        <h1 class="modal-login-title" id="loginTitle">Login Mahasiswa</h1>
        <p class="modal-login-subtitle">
          Masuk dengan akun Game Corner terdaftar Anda untuk melakukan reservasi fasilitas.
        </p>

        <!-- Formulir Login Mahasiswa -->
        <form class="login-form-content" action="{{ route('login.submit') }}" method="POST">
          @csrf
          @if ($errors->any())
            <div style="background: #FEE2E2; color: #B91C1C; padding: 10px 12px; border-radius: 10px; font-size: 12px;">
              {{ $errors->first() }}
            </div>
          @endif
          
          <!-- Field NIM / Email UB -->
          <div class="form-group-field">
            <label for="txtEmailNim" class="field-label">NIM / Email UB</label>
            <div class="input-icon-container">
              <svg class="leading-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                <circle cx="12" cy="7" r="4"></circle>
              </svg>
              <input type="text" id="txtEmailNim" name="email" value="{{ old('email') }}" class="form-input-text" placeholder="Contoh: 25515040... / nama@student.ub.ac.id" required autocomplete="username">
            </div>
          </div>

          <!-- Field Password -->
          <div class="form-group-field">
            <label for="txtPassword" class="field-label">Password</label>
            <div class="input-icon-container">
              <svg class="leading-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
              </svg>
              <input type="password" id="txtPassword" name="password" class="form-input-text has-trailing" placeholder="Masukkan password akun Anda" required autocomplete="current-password">
              <button type="button" class="trailing-icon-btn" id="btnTogglePassword" aria-label="Lihat Password">
                <svg id="eyeIcon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                  <circle cx="12" cy="12" r="3"></circle>
                </svg>
              </button>
            </div>
          </div>

          <!-- Pilihan Ingat Saya -->
          <div class="form-options-row">
            <label class="remember-me-checkbox">
              <input type="checkbox" id="chkRememberMe" name="remember">
              <span>Ingat Saya</span>
            </label>
          </div>

          <!-- Tombol Masuk -->
          <button type="submit" class="btn-submit-sso" id="btnSubmitLogin">
            <span>Masuk</span>
          </button>

          <!-- Pemisah & Tombol Arahkan ke Halaman Daftar -->
          <div style="margin-top: 2px; padding-top: 14px; border-top: 1px solid #F0F0F0; display: flex; flex-direction: column; gap: 8px; text-align: center;">
            <span style="font-family: var(--font-caption); font-size: 12px; color: var(--neutral-600);">
              Belum punya akun Game Corner?
            </span>
            <a href="{{ route('register') }}" style="width: 100%; padding: 11px; border-radius: 12px; border: 1.5px solid var(--primary-500); background-color: var(--primary-50); color: var(--primary-500); font-family: var(--font-heading); font-size: 13px; font-weight: 700; text-decoration: none; display: flex; align-items: center; justify-content: center;">
              Daftar Akun Baru
            </a>
          </div>

          <!-- Disclaimer Mahasiswa Aktif FILKOM -->
          <div class="disclaimer-box">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="12" cy="12" r="10"></circle>
              <polyline points="12 6 12 12 14 14"></polyline>
            </svg>
            <p>
              Hanya mahasiswa aktif <strong>Fakultas Ilmu Komputer, Universitas Brawijaya</strong> yang dapat mendaftar dan melakukan booking.
            </p>
          </div>

        </form>

      </div>
    </section>
@endsection

@push('scripts')
  <script>
    const btnTogglePassword = document.getElementById('btnTogglePassword');
    const inputPassword = document.getElementById('txtPassword');
    const modalLoginBackdrop = document.getElementById('modalLoginMahasiswa');
    const modalLoginCard = modalLoginBackdrop.querySelector('.modal-login-card');

    btnTogglePassword.addEventListener('click', () => {
      const isPassword = inputPassword.type === 'password';
      inputPassword.type = isPassword ? 'text' : 'password';
      btnTogglePassword.style.color = isPassword ? '#160BB6' : '#585860';
    });

    // Klik pada area blur di luar kotak modal akan kembali ke welcome.blade.php
    modalLoginBackdrop.addEventListener('click', (event) => {
      if (!modalLoginCard.contains(event.target)) {
        window.location.href = modalLoginBackdrop.dataset.homeUrl;
      }
    });
  </script>
@endpush