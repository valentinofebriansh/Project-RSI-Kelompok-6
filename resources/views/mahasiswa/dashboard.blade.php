@extends('layouts.app')

@section('title', 'UI-003.1: Pengguna Login - Game Corner FILKOM UB')

@section('content')
    <!-- 1. LAYAR UTAMA: DASHBOARD PENGGUNA TERAUTENTIKASI (UI-003.1) -->
    <div class="scrollable-content" id="dashboardContent">

      <!-- 1. TOPBAR PENGGUNA TERAUTENTIKASI (Kaysan Nawfal) -->
      <header class="topbar-header-auth">
        <div class="user-profile-meta">
          <div class="avatar-initial-circle">
            <span>KN</span>
            <span class="status-indicator-dot"></span>
          </div>
          <div class="user-details">
            <span class="greeting-small">Selamat Datang,</span>
            <strong class="user-fullname">Kaysan Nawfal Niscal N.</strong>
            <span class="user-nim">NIM: 255150407111082</span>
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
      <section class="session-status-banner">
        <div class="banner-top-badges">
          <span class="badge-sso-pill">SSO Brawijaya Aktif</span>
          <span class="badge-ticket-pill">1 Tiket Aktif</span>
        </div>
        <h2 class="banner-faculty-title">Fakultas Ilmu Komputer</h2>
        <div class="banner-bottom-info">
          <span>Booking Terakhir: Hari ini, 14:00</span>
          <span class="link-view-ticket">Lihat Tiket</span>
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
        <span class="badge-counter">3 Lokasi Tersedia</span>
      </section>

      <!-- 4. DAFTAR 3 KARTU FASILITAS LENGKAP -->
      <div class="facility-card-list">

        <!-- KARTU 1: PLAYSTATION & XBOX GEDUNG F -->
        <article class="facility-card">
          <div class="card-thumbnail-wrapper">
            <img class="card-thumbnail-img" src="https://images.unsplash.com/photo-1606813907291-d86efa9b94db?auto=format&fit=crop&w=700&q=80" alt="Ruang Game Corner Gedung F FILKOM UB">
            <div class="overlay-status-badge">
              <span class="indicator-dot"></span>
              <span>Tersedia 4 Slot</span>
            </div>
            <span class="overlay-populer-badge">Populer</span>
            <div class="overlay-location-footer">Lantai 2 Gedung F FILKOM UB</div>
          </div>

          <div class="card-body">
            <h3 class="card-item-title">Playstation &amp; Xbox Gedung F</h3>
            <p class="card-item-desc">
              Dilengkapi sofa santai, TV 4K HDR, serta ragam koleksi game sports, adventure, dan multiplayer terbaru.
            </p>
            <div class="card-tags-row">
              <span class="feature-tag">PS5 DualSense</span>
              <span class="feature-tag">Xbox Series X</span>
              <span class="feature-tag">TV 4K 55 Inch</span>
              <span class="feature-tag">Free WiFi UB</span>
            </div>
          </div>

          <a href="{{ route('mahasiswa.pilih_unit') }}" class="btn-action-booking">
            <span>Pesan Sekarang</span>
          </a>
        </article>

        <!-- KARTU 2: VIRTUAL REALITY GEDUNG F -->
        <article class="facility-card">
          <div class="card-thumbnail-wrapper">
            <img class="card-thumbnail-img" src="https://images.unsplash.com/photo-1593508512255-86ab42a8e620?auto=format&fit=crop&w=700&q=80" alt="Virtual Reality Gedung F FILKOM UB">
            <div class="overlay-status-badge amber">
              <span class="indicator-dot"></span>
              <span>1 Slot Tersisa</span>
            </div>
            <div class="overlay-location-footer">Lantai 2 Gedung F FILKOM UB</div>
          </div>

          <div class="card-body">
            <h3 class="card-item-title">Virtual Reality Gedung F</h3>
            <p class="card-item-desc">
              Eksplorasi simulasi interaktif 3D &amp; game metaverse mutakhir dengan sensor pelacak gerak presisi tinggi.
            </p>
            <div class="card-tags-row">
              <span class="feature-tag">Meta Quest 3</span>
              <span class="feature-tag">HTC Vive Focus</span>
              <span class="feature-tag">Ruang Tracking Luas</span>
            </div>
          </div>

          <a href="{{ route('mahasiswa.pilih_unit') }}" class="btn-action-booking">
            <span>Pesan Sekarang</span>
          </a>
        </article>

        <!-- KARTU 3: PUMP IT UP GKM -->
        <article class="facility-card">
          <div class="card-thumbnail-wrapper">
            <img class="card-thumbnail-img" src="https://www.gameroomguys.com/grg-site/item-images/68550_01.jpg" alt="Pump It Up GKM Universitas Brawijaya">
            <div class="overlay-status-badge">
              <span class="indicator-dot"></span>
              <span>Tersedia</span>
            </div>
            <div class="overlay-location-footer">Lantai 1 Gedung GKM UB</div>
          </div>

          <div class="card-body">
            <h3 class="card-item-title">Pump It Up GKM</h3>
            <p class="card-item-desc">
              Mesin arcade dance rhythm interaktif dengan playlist K-Pop, EDM, dan lagu.
            </p>
            <div class="card-tags-row">
              <span class="feature-tag">PIU Phoenix 2024</span>
              <span class="feature-tag">Dual Stage Pad</span>
              <span class="feature-tag">Sound System Pro</span>
            </div>
          </div>

          <a href="{{ route('mahasiswa.pilih_unit') }}" class="btn-action-booking">
            <span>Pesan Sekarang</span>
          </a>
        </article>

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