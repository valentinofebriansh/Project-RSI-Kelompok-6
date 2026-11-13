@extends('layouts.app')

@section('title', 'UI-007.1: Halaman Login Admin - Game Corner FILKOM UB')

@section('content')
    <!-- HALAMAN LOGIN ADMIN LANGSUNG (TANPA MODAL & TANPA BACKGROUND BLUR) -->
    <section class="admin-login-wrapper" aria-labelledby="adminLoginTitle">

      <!-- Icon Shield & Identitas Portal Admin -->
      <div class="shield-icon-wrapper">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
          <polyline points="9 12 11 14 15 10"></polyline>
        </svg>
      </div>

      <span class="pill-admin-tag">Admin Portal • FILKOM UB</span>
      <h1 class="admin-login-title" id="adminLoginTitle">Login Admin</h1>
      <p class="admin-login-subtitle">
        Masuk menggunakan akun Email UB Admin untuk mengelola reservasi &amp; operasional Game Corner.
      </p>

      <!-- Formulir Kredensial Admin (2 Kolom Vertikal) -->
      <form class="login-form-content" action="{{ route('admin.login.submit') }}" method="POST">
        @csrf

        <!-- Kolom 1: Email UB Admin -->
        <div class="form-group-field">
          <label for="txtEmailAdmin" class="field-label">Email UB Admin</label>
          <div class="input-icon-container">
            <svg class="leading-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <rect x="2" y="4" width="20" height="16" rx="2"></rect>
              <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
            </svg>
            <input type="email" id="txtEmailAdmin" name="email" class="form-input-text" placeholder="Contoh: admin.gamecorner@ub.ac.id" required autocomplete="email">
          </div>
        </div>

        <!-- Kolom 2: Password -->
        <div class="form-group-field">
          <label for="txtPassword" class="field-label">Password</label>
          <div class="input-icon-container">
            <svg class="leading-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
              <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
            </svg>
            <input type="password" id="txtPassword" name="password" class="form-input-text has-trailing" placeholder="Masukkan password akun Admin" required autocomplete="current-password">
            <button type="button" class="trailing-icon-btn" id="btnTogglePassword" aria-label="Lihat Password">
              <svg id="eyeIcon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                <circle cx="12" cy="12" r="3"></circle>
              </svg>
            </button>
          </div>
        </div>

        <!-- Tombol Masuk Admin -->
        <button type="submit" class="btn-submit-admin" id="btnSubmitAdmin">
          <span>Masuk Admin</span>
        </button>

      </form>

    </section>
@endsection

@push('scripts')
  <!-- Script Interaksi: Toggle Password -->
  <script>
    const btnTogglePassword = document.getElementById('btnTogglePassword');
    const inputPassword = document.getElementById('txtPassword');

    btnTogglePassword.addEventListener('click', () => {
      const isPassword = inputPassword.type === 'password';
      inputPassword.type = isPassword ? 'text' : 'password';
      btnTogglePassword.style.color = isPassword ? '#160BB6' : '#585860';
    });
  </script>
@endpush