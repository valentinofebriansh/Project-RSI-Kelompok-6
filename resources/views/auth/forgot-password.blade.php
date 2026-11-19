@extends('layouts.app')

@section('title', 'Lupa Password - Game Corner FILKOM UB')

@section('content')
    <div class="scrollable-content background-screen-blurred" aria-hidden="true">
      @include('partials.welcome_content')
    </div>

    <section class="modal-backdrop-overlay" role="dialog" aria-modal="true" style="padding: 64px 16px 32px 16px; overflow-y: auto;">
      <div class="modal-login-card" style="cursor: default;">

        <button type="button" class="btn-close-modal" onclick="window.location.href='{{ route('login') }}'" aria-label="Kembali ke Login">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="18" y1="6" x2="6" y2="18"></line>
            <line x1="6" y1="6" x2="18" y2="18"></line>
          </svg>
        </button>

        <div class="shield-icon-wrapper">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
          </svg>
        </div>

        <span class="pill-iam-tag">PEMULIHAN AKUN</span>
        <h1 class="modal-login-title">Lupa Password</h1>
        <p class="modal-login-subtitle">
          Masukkan alamat Email UB terdaftar Anda untuk menerima tautan pengaturan ulang password.
        </p>

        <form class="login-form-content" action="{{ route('password.email') }}" method="POST">
          @csrf

          @if (session('status'))
            <div style="background: #DCFCE7; color: #166534; padding: 10px 12px; border-radius: 10px; font-size: 12px;">
              {{ session('status') }}
            </div>
          @endif

          @if ($errors->any())
            <div style="background: #FEE2E2; color: #B91C1C; padding: 10px 12px; border-radius: 10px; font-size: 12px;">
              {{ $errors->first() }}
            </div>
          @endif

          <div class="form-group-field">
            <label for="txtResetEmail" class="field-label">Email UB Terdaftar</label>
            <div class="input-icon-container">
              <svg class="leading-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                <polyline points="22,6 12,13 2,6"></polyline>
              </svg>
              <input type="email" id="txtResetEmail" name="email" value="{{ old('email') }}" class="form-input-text" placeholder="Contoh: nama@student.ub.ac.id" required autocomplete="email">
            </div>
          </div>

          <button type="submit" class="btn-submit-sso">
            <span>Kirim Link Reset Password</span>
          </button>

          <div style="margin-top: 4px; padding-top: 14px; border-top: 1px solid #F0F0F0; text-align: center;">
            <a href="{{ route('login') }}" style="font-family: var(--font-heading); font-size: 13px; font-weight: 700; color: var(--primary-500); text-decoration: none;">
              ← Kembali ke Halaman Login
            </a>
          </div>
        </form>

      </div>
    </section>
@endsection