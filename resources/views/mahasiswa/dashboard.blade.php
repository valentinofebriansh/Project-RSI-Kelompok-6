@extends('layouts.app')

@section('title', 'UI-003.1: Pengguna Login - Game Corner FILKOM UB')

@section('content')
    <!-- 1. LAYAR UTAMA: DASHBOARD PENGGUNA TERAUTENTIKASI (UI-003.1) -->
    <div class="scrollable-content" id="dashboardContent">

      <!-- 1. TOPBAR PENGGUNA TERAUTENTIKASI -->
      <header class="topbar-header-auth">
        <div class="user-profile-meta">
          <div class="avatar-initial-circle">
            <span>{{ strtoupper(substr(Auth::user()->name ?? 'M', 0, 1)) }}</span>
            <span class="status-indicator-dot"></span>
          </div>
          <div class="user-details">
            <span class="greeting-small">Selamat Datang,</span>
            <strong class="user-fullname">{{ Auth::user()->name ?? 'Mahasiswa' }}</strong>
            <span class="user-nim">NIM: {{ Auth::user()->nim ?? '-' }}</span>
          </div>
        </div>

        <!-- Tombol Logout: Membuka Popup Konfirmasi Logout (UI-003) -->
        <button type="button" class="btn-logout-trigger" id="btnLogoutTrigger" title="Logout Sesi" aria-label="Logout">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
            <polyline points="16 17 21 12 16 7"></polyline>
            <line x1="21" y1="12" x2="9" y2="12"></line>
          </svg>
        </button>
      </header>

      <!-- 2. STATUS BANNER SESI AKTIF MAHASISWA FILKOM -->
      <section class="session-status-banner" style="display: flex; flex-direction: column; gap: 10px; padding: 20px 22px;">
        @if (session('success'))
          <div style="background: #DCFCE7; color: #166534; padding: 12px 14px; border-radius: 12px; font-size: 13px; margin-bottom: 4px; font-weight: 600;">
            {{ session('success') }}
          </div>
        @endif

        {{-- Baris Atas: Status Pill Badge dengan 3 Warna --}}
        <div>
          @if ($latestReservasi)
            @if ($latestReservasi->status === 'pending')
              <span style="display: inline-block; background: #22C55E; color: #FFFFFF; font-size: 11px; font-weight: 700; padding: 5px 14px; border-radius: 999px; letter-spacing: 0.3px;">
                PENDING • Menunggu Persetujuan
              </span>
            @elseif ($latestReservasi->status === 'disetujui')
              <span style="display: inline-block; background: #16A34A; color: #FFFFFF; font-size: 11px; font-weight: 700; padding: 5px 14px; border-radius: 999px; letter-spacing: 0.3px;">
                DISETUJUI • Siap Check-in
              </span>
            @elseif ($latestReservasi->status === 'ditolak')
              <span style="display: inline-block; background: #EF4444; color: #FFFFFF; font-size: 11px; font-weight: 700; padding: 5px 14px; border-radius: 999px; letter-spacing: 0.3px;">
                DITOLAK • Pengajuan Ditolak
              </span>
            @else
              <span style="display: inline-block; background: rgba(255,255,255,0.25); color: #FFFFFF; font-size: 11px; font-weight: 700; padding: 5px 14px; border-radius: 999px; letter-spacing: 0.3px;">
                {{ strtoupper($latestReservasi->status) }}
              </span>
            @endif
          @else
            <span style="display: inline-block; background: rgba(255, 255, 255, 0.2); color: #FFFFFF; font-size: 11px; font-weight: 700; padding: 5px 14px; border-radius: 999px; letter-spacing: 0.3px;">
              BELUM ADA TIKET AKTIF
            </span>
          @endif
        </div>

        {{-- Judul Utama Kartu (Ukuran Besar 20px–22px, Bold, Putih) --}}
        <h2 style="font-size: 21px; font-weight: 700; color: #FFFFFF; margin: 0; line-height: 1.35; letter-spacing: -0.3px;">
          @if ($latestReservasi)
            {{ $latestReservasi->unit_kode }} — {{ $latestReservasi->fasilitas->nama_fasilitas }}
          @else
            Belum Ada Reservasi Aktif
          @endif
        </h2>

        {{-- Detail Tiket & Keterangan Status di Bagian Bawah Kartu (Ukuran 13px–14px) --}}
        <div style="display: flex; flex-direction: column; gap: 4px; border-top: 1px solid rgba(255, 255, 255, 0.18); padding-top: 8px;">
          @if ($latestReservasi)
            <span style="font-size: 13.5px; color: #FFFFFF; font-weight: 600; line-height: 1.4;">
              Kode: {{ $latestReservasi->kode_booking }} • {{ \Carbon\Carbon::parse($latestReservasi->tanggal_reservasi)->format('d M Y') }}, {{ substr($latestReservasi->jadwalSlot->jam_mulai, 0, 5) }} - {{ substr($latestReservasi->jadwalSlot->jam_selesai, 0, 5) }} WIB
            </span>
            <span style="font-size: 13px; color: rgba(255, 255, 255, 0.85); line-height: 1.4;">
              @if ($latestReservasi->status === 'disetujui')
                Tunjukkan KTM ke meja satpam 10 menit sebelum sesi
              @elseif ($latestReservasi->status === 'ditolak')
                Pengajuan ditolak admin. Silakan ajukan sesi/unit lain
              @else
                Menunggu konfirmasi dari admin Game Corner
              @endif
            </span>
          @else
            <span style="font-size: 13px; color: rgba(255, 255, 255, 0.85); line-height: 1.4;">
              Pilih lokasi Game Corner di bawah untuk mulai membuat tiket reservasi.
            </span>
          @endif
        </div>
      </section>

      <!-- Sub-Bar Layanan Aktif -->
      <div class="service-meta-bar">
        <div class="service-status-active">
          <span class="status-dot"></span>
          <span>Layanan Aktif: FILKOM &amp; GKM</span>
        </div>
        <a href="#hub-info" class="service-hub-link">FILKOM UB</a>
      </div>

      <!-- 3. SECTION TITLE & LOKASI -->
      <section class="section-header">
        <div>
          <h2 class="section-title">Lokasi Game Corner</h2>
          <p class="section-subtitle">Pilih spot favorit untuk bermain &amp; relaksasi</p>
        </div>
        <span class="badge-counter">{{ count($fasilitas) }} Lokasi Tersedia</span>
      </section>

      <!-- 4. DAFTAR KARTU FASILITAS LENGKAP -->
      <div class="facility-card-list">
        @foreach ($fasilitas as $item)
          <article class="facility-card">
            <div class="card-thumbnail-wrapper">
              <img class="card-thumbnail-img" src="{{ $item->gambar }}" alt="{{ $item->nama_fasilitas }}">
              <div class="overlay-status-badge">
                <span class="indicator-dot"></span>
                <span>Tersedia {{ count($item->units ?? []) }} Unit</span>
              </div>
              @if ($item->is_populer)
                <span class="overlay-populer-badge">Populer</span>
              @endif
              <div class="overlay-location-footer">{{ $item->lokasi }}</div>
            </div>

            <div class="card-body">
              <h3 class="card-item-title">{{ $item->nama_fasilitas }}</h3>
              <p class="card-item-desc">{{ $item->deskripsi }}</p>
              <div class="card-tags-row">
                @foreach ($item->tags ?? [] as $tag)
                  <span class="feature-tag">{{ $tag }}</span>
                @endforeach
              </div>
            </div>

            <a href="{{ route('mahasiswa.pilih_unit', ['fasilitas_id' => $item->id]) }}" class="btn-action-booking">
              <span>Pesan Sekarang</span>
            </a>
          </article>
        @endforeach
      </div>

      <!-- 5. KETENTUAN RESERVASI CALLOUT -->
      <footer class="booking-policy-callout">
        <svg class="callout-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="12" cy="12" r="10"></circle>
          <line x1="12" y1="16" x2="12" y2="12"></line>
          <line x1="12" y1="8" x2="12.01" y2="8"></line>
        </svg>
        <p>
          <strong>Ketentuan Reservasi:</strong> Maksimal peminjaman 90 menit per sesi.
        </p>
      </footer>

    </div>

    <!-- 2. MODAL OVERLAY: DIALOG POPUP KONFIRMASI LOGOUT (UI-003) -->
    <section class="modal-backdrop-overlay" id="modalLogout" role="dialog" aria-modal="true" aria-labelledby="modalLogoutTitle" style="display: none;">
      <div class="modal-logout-card">

        <!-- Tombol Tutup (X) Menutup Dialog Modal -->
        <button type="button" class="btn-close-modal" id="btnCloseModal" aria-label="Tutup Dialog">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="18" y1="6" x2="6" y2="18"></line>
            <line x1="6" y1="6" x2="18" y2="18"></line>
          </svg>
        </button>

        <!-- Ikon Alert Segitiga Peringatan -->
        <div class="warning-icon-wrapper">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
            <line x1="12" y1="9" x2="12" y2="13"></line>
            <line x1="12" y1="17" x2="12.01" y2="17"></line>
          </svg>
        </div>

        <h1 class="modal-logout-title" id="modalLogoutTitle">Konfirmasi Logout</h1>
        <p class="modal-logout-subtitle">Apakah anda yakin ingin logout?</p>

        <!-- Tombol Aksi: Ya, Logout dan Batal -->
        <div class="modal-actions-container">
          <form action="{{ url('/logout') }}" method="POST" style="width: 100%;">
            @csrf
            <button type="submit" class="btn-confirm-logout" id="btnConfirmLogout">
              Ya, Logout
            </button>
          </form>
          <button type="button" class="btn-cancel-logout" id="btnCancelLogout">
            Batal
          </button>
        </div>

      </div>
    </section>
@endsection

@push('scripts')
  <!-- Script Interaksi: Event Handler Buka/Tutup Modal Konfirmasi Logout -->
  <script>
    const dashboardContent = document.getElementById('dashboardContent');
    const modalLogout = document.getElementById('modalLogout');
    const btnLogoutTrigger = document.getElementById('btnLogoutTrigger');
    const btnCloseModal = document.getElementById('btnCloseModal');
    const btnCancelLogout = document.getElementById('btnCancelLogout');

    // Membuka dialog modal konfirmasi logout & memberi efek blur pada latar belakang
    const handleOpenLogoutModal = () => {
      dashboardContent.classList.add('background-screen-blurred');
      dashboardContent.setAttribute('aria-hidden', 'true');
      modalLogout.style.display = 'flex';
    };

    // Menutup dialog modal dan kembali ke halaman dashboard aktif (UI-003.1)
    const handleCloseLogoutModal = () => {
      modalLogout.style.display = 'none';
      dashboardContent.classList.remove('background-screen-blurred');
      dashboardContent.removeAttribute('aria-hidden');
    };

    btnLogoutTrigger.addEventListener('click', handleOpenLogoutModal);
    btnCloseModal.addEventListener('click', handleCloseLogoutModal);
    btnCancelLogout.addEventListener('click', handleCloseLogoutModal);

    // Tutup modal jika area gelap di luar kartu dialog diklik
    modalLogout.addEventListener('click', (event) => {
      if (event.target === modalLogout) {
        handleCloseLogoutModal();
      }
    });
  </script>
@endpush