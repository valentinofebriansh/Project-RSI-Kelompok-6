@extends('layouts.app')

@section('title', 'UI-004: Halaman Detail & Pilih Unit Konsol - Game Corner FILKOM UB')

@section('content')
    <div class="scrollable-content">

      <!-- 1. HEADER & TOMBOL BACK KE UI-003.1 -->
      <header class="topbar-nav-header">
        <button type="button" class="btn-back-nav" onclick="window.location.href='{{ route('mahasiswa.dashboard') }}'" title="Kembali ke Dashboard" aria-label="Kembali">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <line x1="19" y1="12" x2="5" y2="12"></line>
            <polyline points="12 19 5 12 12 5"></polyline>
          </svg>
        </button>
        <div class="location-header-title">
          <h1>Playstation &amp; Xbox Gedung F</h1>
          <p>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
              <circle cx="12" cy="10" r="3"></circle>
            </svg>
            <span>Lantai 2 Gedung F, FILKOM UB</span>
          </p>
        </div>
      </header>

      <!-- 2. HERO BANNER LOKASI DENGAN BADGE SIAP PAKAI -->
      <div class="facility-hero-wrapper">
        <img class="facility-hero-img" src="https://images.unsplash.com/photo-1606813907291-d86efa9b94db?auto=format&fit=crop&w=700&q=80" alt="Game Corner Gedung F FILKOM UB">
        <div class="hero-ready-badge">
          <span class="dot"></span>
          <span>3 Unit Siap Pakai</span>
        </div>
        <div class="hero-bottom-overlay">
          <span class="hub-tag-pill">FILKOM Gaming Hub</span>
          <span class="capacity-label">Kapasitas Maksimal 4 Mahasiswa / Slot</span>
        </div>
      </div>

      <!-- 3. DESKRIPSI & SPESIFIKASI FASILITAS -->
      <section class="card-detail-section">
        <div class="detail-section-header">
          <h2>Deskripsi &amp; Fasilitas</h2>
          <span class="tag-student-only">Khusus Mahasiswa UB</span>
        </div>
        <p class="desc-paragraph">
          Fasilitas rekreasi digital interaktif Fakultas Ilmu Komputer. Dilengkapi TV 4K HDR 55 inci, audio jernih, sofa ergonomis, koneksi internet kampus ultra-cepat, dan ruangan full AC untuk kenyamanan bermain.
        </p>
        <div class="feature-specs-grid">
          <div class="spec-item">
            <span class="accent-blue">4K</span>
            <span>TV Smart 55" HDR</span>
          </div>
          <div class="spec-item">
            <span class="accent-orange">AC</span>
            <span>Ruang Sejuk &amp; Nyaman</span>
          </div>
          <div class="spec-item">
            <span class="accent-blue">WiFi</span>
            <span>Free UB High-Speed</span>
          </div>
          <div class="spec-item">
            <span class="accent-orange">2P</span>
            <span>Dual Controllers</span>
          </div>
        </div>
      </section>

      <!-- 4. PEMILIHAN UNIT KONSOL (INTERAKTIF SINGLE SELECTION) -->
      <section class="unit-selection-section">
        <div class="unit-header-meta">
          <div>
            <h2>Pilih Unit Konsol</h2>
            <p>Pilih unit gaming yang ingin kamu reservasi</p>
          </div>
          <span class="badge-gedung">Gedung F</span>
        </div>

        <div class="unit-card-grid">

          <!-- UNIT 1: PS-01 (DEFAULT TERPILIH) -->
          <article class="unit-card is-selected" id="card-ps01" onclick="selectUnit('card-ps01', 'PS-01 (PlayStation 5)')">
            <span class="populer-ribbon-tag">POPULER</span>
            <h3 class="unit-card-id">PS-01</h3>
            <span class="unit-card-sub">PlayStation 5</span>
            <div class="unit-thumb-box">
              <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="16" y="6" width="16" height="34" rx="4" fill="#0F172A"/>
                <path d="M14 8C14 8 18 10 18 40" stroke="#382AFF" stroke-width="2.5" stroke-linecap="round"/>
                <path d="M34 8C34 8 30 10 30 40" stroke="#382AFF" stroke-width="2.5" stroke-linecap="round"/>
                <ellipse cx="24" cy="42" rx="14" ry="3" fill="#64748B"/>
              </svg>
            </div>
            <div class="unit-status-indicator">
              <span class="status-dot"></span>
              <span>Tersedia</span>
            </div>
            <button type="button" class="btn-select-unit">Pilih</button>
          </article>

          <!-- UNIT 2: PS-02 -->
          <article class="unit-card is-dimmed" id="card-pc01" onclick="selectUnit('card-pc01', 'PS-02 (PlayStation 5)')">
            <h3 class="unit-card-id">PS-02</h3>
            <span class="unit-card-sub">PlayStation 5</span>
            <div class="unit-thumb-box">
              <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="15" y="8" width="18" height="32" rx="3" fill="#1E293B"/>
                <rect x="18" y="12" width="12" height="14" rx="2" fill="#0EA5E9" fill-opacity="0.3" stroke="#0EA5E9" stroke-width="1.5"/>
                <line x1="18" y1="30" x2="30" y2="30" stroke="#64748B" stroke-width="2"/>
                <line x1="18" y1="34" x2="26" y2="34" stroke="#64748B" stroke-width="2"/>
                <circle cx="24" cy="19" r="3" fill="#382AFF"/>
              </svg>
            </div>
            <div class="unit-status-indicator">
              <span class="status-dot"></span>
              <span>Tersedia</span>
            </div>
            <button type="button" class="btn-select-unit">Pilih</button>
          </article>

          <!-- UNIT 3: XBOX-01 -->
          <article class="unit-card is-dimmed" id="card-xbox01" onclick="selectUnit('card-xbox01', 'XBOX-01 (Series X)')">
            <h3 class="unit-card-id">XBOX-01</h3>
            <span class="unit-card-sub">Series X</span>
            <div class="unit-thumb-box">
              <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="17" y="10" width="14" height="28" rx="2" fill="#09090B"/>
                <circle cx="24" cy="15" r="2.5" fill="#10B981"/>
                <line x1="20" y1="22" x2="20.01" y2="22" stroke="#22C55E" stroke-width="2" stroke-linecap="round"/>
                <line x1="20" y1="26" x2="20.01" y2="26" stroke="#22C55E" stroke-width="2" stroke-linecap="round"/>
                <rect x="19" y="32" width="10" height="1.5" rx="0.5" fill="#52525B"/>
              </svg>
            </div>
            <div class="unit-status-indicator">
              <span class="status-dot"></span>
              <span>Tersedia</span>
            </div>
            <button type="button" class="btn-select-unit">Pilih</button>
          </article>

        </div>
      </section>

      <!-- 5. KETENTUAN PENGGUNAAN CALLOUT -->
      <div class="usage-policy-box">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="12" cy="12" r="10"></circle>
          <polyline points="12 6 12 12 16 14"></polyline>
        </svg>
        <p>
          <strong>Ketentuan Penggunaan:</strong> Maksimal peminjaman 90 menit/sesi. Wajib membawa KTM aktif saat konfirmasi di meja satpam Game Corner FILKOM.
        </p>
      </div>

      <!-- 6. BOTTOM BAR: RINGKASAN & TOMBOL LANJUT KE UI-005 -->
      <footer class="bottom-booking-bar">
        <div class="summary-info-row">
          <div class="summary-block-left">
            <span class="summary-title-sm">Unit Terpilih Saat Ini</span>
            <span class="summary-value-bold" id="lblSelectedUnit">PS-01 (PlayStation 5)</span>
          </div>
          <div class="summary-block-right">
            <span class="summary-title-sm">Tarif Mahasiswa</span>
            <span class="summary-price-bold">GRATIS / Bebas Biaya</span>
          </div>
        </div>

        <button type="button" class="btn-proceed-schedule" onclick="window.location.href='{{ route('mahasiswa.pilih_jadwal') }}'">
          <span>Lanjutkan Pengisian Jadwal</span>
        </button>
      </footer>

    </div>
@endsection

@push('scripts')
  <!-- Script Interaktivitas Pemilihan Unit Konsol Tunggal -->
  <script>
    function selectUnit(selectedCardId, unitName) {
      const allCards = document.querySelectorAll('.unit-card');
      
      allCards.forEach(card => {
        if (card.id === selectedCardId) {
          card.classList.remove('is-dimmed');
          card.classList.add('is-selected');
        } else {
          card.classList.remove('is-selected');
          card.classList.add('is-dimmed');
        }
      });

      // Perbarui label ringkasan unit terpilih pada bar bawah
      document.getElementById('lblSelectedUnit').innerText = unitName;
    }
  </script>
@endpush