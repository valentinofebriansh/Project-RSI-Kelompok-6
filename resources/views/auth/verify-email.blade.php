@extends('layouts.app')

@section('title', 'Verifikasi Email - Game Corner FILKOM UB')

@section('content')
    <div class="scrollable-content background-screen-blurred" aria-hidden="true">
      @include('partials.welcome_content')
    </div>

    <section class="modal-backdrop-overlay" role="dialog" aria-modal="true" style="padding: 64px 16px 32px 16px; overflow-y: auto;">
      <div class="modal-login-card" style="cursor: default;">

        <div class="shield-icon-wrapper">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
            <polyline points="22,6 12,13 2,6"></polyline>
          </svg>
        </div>

        <span class="pill-iam-tag">KONFIRMASI AKUN</span>
        <h1 class="modal-login-title">Verifikasi Email UB</h1>
        <p class="modal-login-subtitle">
          Kami telah mengirimkan tautan verifikasi ke email <strong>{{ auth()->user()->email }}</strong>. Silakan periksa kotak masuk atau folder spam Anda.
        </p>

        <div class="login-form-content">
          @if (session('status'))
            <div style="background: #DCFCE7; color: #166534; padding: 10px 12px; border-radius: 10px; font-size: 12px;">
              {{ session('status') }}
            </div>
          @endif

          <form action="{{ route('verification.send') }}" method="POST">
            @csrf
            <button type="submit" class="btn-submit-sso">
              <span>Kirim Ulang Email Verifikasi</span>
            </button>
          </form>

          <form action="{{ route('logout') }}" method="POST" style="margin-top: 8px; text-align: center;">
            @csrf
            <button type="submit" style="width: 100%; padding: 11px; border-radius: 12px; border: 1.5px solid #E2E8F0; background-color: #F8FAFC; color: var(--neutral-600); font-family: var(--font-heading); font-size: 13px; font-weight: 700; cursor: pointer;">
              Keluar / Ganti Akun
            </button>
          </form>
        </div>

      </div>
    </section>
@endsection