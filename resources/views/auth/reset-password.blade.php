Blade
@extends('layouts.app')

@section('title', 'Reset Password Baru - Game Corner FILKOM UB')

@section('content')
    <div class="scrollable-content background-screen-blurred" aria-hidden="true">
      @include('partials.welcome_content')
    </div>

    <section class="modal-backdrop-overlay" role="dialog" aria-modal="true" style="padding: 64px 16px 32px 16px; overflow-y: auto;">
      <div class="modal-login-card" style="cursor: default;">

        <div class="shield-icon-wrapper">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
            <polyline points="9 12 11 14 15 10"></polyline>
          </svg>
        </div>

        <span class="pill-iam-tag">PASSWORD BARU</span>
        <h1 class="modal-login-title">Atur Ulang Password</h1>
        <p class="modal-login-subtitle">
          Silakan buat password baru minimal 8 karakter untuk akun Game Corner Anda.
        </p>

        <form class="login-form-content" action="{{ route('password.update') }}" method="POST">
          @csrf
          <input type="hidden" name="token" value="{{ $token }}">

          @if ($errors->any())
            <div style="background: #FEE2E2; color: #B91C1C; padding: 10px 12px; border-radius: 10px; font-size: 12px;">
              {{ $errors->first() }}
            </div>
          @endif

          <div class="form-group-field">
            <label for="txtEmailConfirm" class="field-label">Email UB</label>
            <div class="input-icon-container">
              <svg class="leading-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                <polyline points="22,6 12,13 2,6"></polyline>
              </svg>
              <input type="email" id="txtEmailConfirm" name="email" value="{{ old('email', $email) }}" class="form-input-text" required readonly>
            </div>
          </div>

          <div class="form-group-field">
            <label for="txtNewPassword" class="field-label">Password Baru</label>
            <div class="input-icon-container">
              <svg class="leading-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
              </svg>
              <input type="password" id="txtNewPassword" name="password" class="form-input-text" placeholder="Minimal 8 karakter" required autocomplete="new-password">
            </div>
          </div>

          <div class="form-group-field">
            <label for="txtConfirmPassword" class="field-label">Konfirmasi Password Baru</label>
            <div class="input-icon-container">
              <svg class="leading-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
              </svg>
              <input type="password" id="txtConfirmPassword" name="password_confirmation" class="form-input-text" placeholder="Ulangi password baru" required autocomplete="new-password">
            </div>
          </div>

          <button type="submit" class="btn-submit-sso">
            <span>Simpan Password Baru</span>
          </button>
        </form>

      </div>
    </section>
@endsection