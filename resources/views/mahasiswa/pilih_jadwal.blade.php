@extends('layouts.app')

@section('title', 'UI-005: Pilih Tanggal & Sesi Reservasi - Game Corner FILKOM UB')

@section('content')
    <div class="scrollable-content">

      <!-- 1. HEADER & TOMBOL BACK KE UI-004 -->
      <header class="topbar-nav-header">
        <button type="button" class="btn-back-nav" onclick="window.location.href='{{ route('mahasiswa.pilih_unit') }}'" title="Kembali ke Pemilihan Unit" aria-label="Kembali">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <line x1="19" y1="12" x2="5" y2="12"></line>
            <polyline points="12 19 5 12 12 5"></polyline>
          </svg>
        </button>
        <div class="location-header-title">
          <h1>Playstation &amp; Xbox Gedung F</h1>
          <p>Fakultas Ilmu Komputer, Universitas Brawijaya</p>
        </div>
      </header>

      <!-- 2. INFORMASI UNIT TERPILIH & STATUS -->
      <div class="unit-meta-bar">
        <span class="unit-type-pill">PlayStation 5 Console</span>
        <div class="unit-status-ready">
          <span class="dot"></span>
          <span>Siap Digunakan</span>
        </div>
      </div>

      <h2 class="unit-main-id">PS-01</h2>

      <!-- Banner Foto Ruang & Spesifikasi Sesi -->
      <div class="unit-banner-wrapper">
        <img class="unit-banner-img" src="https://images.unsplash.com/photo-1606813907291-d86efa9b94db?auto=format&fit=crop&w=700&q=80" alt="PlayStation Lounge Gedung F">
        <span class="banner-lounge-tag">Gedung F Gaming Lounge</span>
        <div class="banner-specs-overlay">
          <span class="spec-inline">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
              <circle cx="12" cy="10" r="3"></circle>
            </svg>
            <span>Lantai 2 Gedung F</span>
          </span>
          <span class="spec-inline">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
              <circle cx="9" cy="7" r="4"></circle>
              <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
              <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
            </svg>
            <span>Maks. 2 Pemain</span>
          </span>
          <span class="spec-inline">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="12" cy="12" r="10"></circle>
              <polyline points="12 6 12 12 16 14"></polyline>
            </svg>
            <span>60 Menit</span>
          </span>
        </div>
      </div>

      <!-- 3. PILIH TANGGAL RESERVASI (TABS) -->
      <section class="date-selection-container">
        <span class="date-section-label">Pilih Tanggal Reservasi</span>
        <div class="date-tabs-grid">
          <button type="button" class="date-tab-card active" id="tabToday" onclick="switchDate('today')">
            <span class="day-title">Hari Ini</span>
            <span class="date-number">14 Okt</span>
          </button>
          <button type="button" class="date-tab-card" id="tabTomorrow" onclick="switchDate('tomorrow')">
            <span class="day-title">Besok</span>
            <span class="date-number">15 Okt</span>
          </button>
        </div>
      </section>

      <!-- 4. DAFTAR JADWAL SESI TERSEDIA (SINGLE SELECTION) -->
      <section class="schedule-section-header">
        <h2 class="schedule-title">Jadwal Sesi Tersedia</h2>
        <span class="schedule-total-badge">Total 8 Sesi</span>
      </section>

      <div class="session-card-list" id="sessionList">

        <!-- Sesi 1 -->
        <article class="session-card" id="session-1" onclick="handleCardClick('session-1', '08:00 - 09:00', false)">
          <div class="session-left-meta">
            <div class="session-icon-circle">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <polyline points="12 6 12 12 16 14"></polyline>
              </svg>
            </div>
            <div class="session-time-info">
              <span class="time-range">08:00 - 09:00</span>
              <span class="status-text">Sesi 1 · Tersedia</span>
            </div>
          </div>
          <button type="button" class="btn-session-action btn-pesan" onclick="bookSession(event, 'session-1', '08:00 - 09:00')">Pesan</button>
        </article>

        <!-- Sesi 2 (Penuh) -->
        <article class="session-card is-full" id="session-2">
          <div class="session-left-meta">
            <div class="session-icon-circle">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="15" y1="9" x2="9" y2="15"></line>
                <line x1="9" y1="9" x2="15" y2="15"></line>
              </svg>
            </div>
            <div class="session-time-info">
              <span class="time-range">09:15 - 10:15</span>
              <span class="status-text">Sesi 2 · Sudah Terisi</span>
            </div>
          </div>
          <button type="button" class="btn-session-action btn-penuh" disabled>Penuh</button>
        </article>

        <!-- Sesi 3 -->
        <article class="session-card" id="session-3" onclick="handleCardClick('session-3', '10:30 - 11:30', false)">
          <div class="session-left-meta">
            <div class="session-icon-circle">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <polyline points="12 6 12 12 16 14"></polyline>
              </svg>
            </div>
            <div class="session-time-info">
              <span class="time-range">10:30 - 11:30</span>
              <span class="status-text">Sesi 3 · Tersedia</span>
            </div>
          </div>
          <button type="button" class="btn-session-action btn-pesan" onclick="bookSession(event, 'session-3', '10:30 - 11:30')">Pesan</button>
        </article>

        <!-- Sesi 4 -->
        <article class="session-card" id="session-4" onclick="handleCardClick('session-4', '11:45 - 12:45', false)">
          <div class="session-left-meta">
            <div class="session-icon-circle">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <polyline points="12 6 12 12 16 14"></polyline>
              </svg>
            </div>
            <div class="session-time-info">
              <span class="time-range">11:45 - 12:45</span>
              <span class="status-text">Sesi 4 · Tersedia</span>
            </div>
          </div>
          <button type="button" class="btn-session-action btn-pesan" onclick="bookSession(event, 'session-4', '11:45 - 12:45')">Pesan</button>
        </article>

        <!-- Sesi 5 (Default Terpilih / Populer) -->
        <article class="session-card is-selected" id="session-5" onclick="handleCardClick('session-5', '13:00 - 14:00', false)">
          <span class="badge-favorit-tag">FAVORIT</span>
          <div class="session-left-meta">
            <div class="session-icon-circle">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <polyline points="12 6 12 12 16 14"></polyline>
              </svg>
            </div>
            <div class="session-time-info">
              <span class="time-range">13:00 - 14:00</span>
              <span class="status-text">Sesi 5 · Slot Populer</span>
            </div>
          </div>
          <button type="button" class="btn-session-action btn-pesan" onclick="bookSession(event, 'session-5', '13:00 - 14:00')">Pesan</button>
        </article>

        <!-- Sesi 6 -->
        <article class="session-card" id="session-6" onclick="handleCardClick('session-6', '14:15 - 15:15', false)">
          <div class="session-left-meta">
            <div class="session-icon-circle">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <polyline points="12 6 12 12 16 14"></polyline>
              </svg>
            </div>
            <div class="session-time-info">
              <span class="time-range">14:15 - 15:15</span>
              <span class="status-text">Sesi 6 · Tersedia</span>
            </div>
          </div>
          <button type="button" class="btn-session-action btn-pesan" onclick="bookSession(event, 'session-6', '14:15 - 15:15')">Pesan</button>
        </article>

        <!-- Sesi 7 -->
        <article class="session-card" id="session-7" onclick="handleCardClick('session-7', '15:30 - 16:30', false)">
          <div class="session-left-meta">
            <div class="session-icon-circle">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <polyline points="12 6 12 12 16 14"></polyline>
              </svg>
            </div>
            <div class="session-time-info">
              <span class="time-range">15:30 - 16:30</span>
              <span class="status-text">Sesi 7 · Tersedia</span>
            </div>
          </div>
          <button type="button" class="btn-session-action btn-pesan" onclick="bookSession(event, 'session-7', '15:30 - 16:30')">Pesan</button>
        </article>

        <!-- Sesi 8 -->
        <article class="session-card" id="session-8" onclick="handleCardClick('session-8', '16:45 - 17:45', false)">
          <div class="session-left-meta">
            <div class="session-icon-circle">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <polyline points="12 6 12 12 16 14"></polyline>
              </svg>
            </div>
            <div class="session-time-info">
              <span class="time-range">16:45 - 17:45</span>
              <span class="status-text">Sesi 8 · Sesi Terakhir</span>
            </div>
          </div>
          <button type="button" class="btn-session-action btn-pesan" onclick="bookSession(event, 'session-8', '16:45 - 17:45')">Pesan</button>
        </article>

      </div>

      <!-- 5. CATATAN RESERVASI CALLOUT -->
      <footer class="reservation-note-box">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="12" cy="12" r="10"></circle>
          <polyline points="12 6 12 12 16 14"></polyline>
        </svg>
        <p>
          <strong>Catatan Reservasi:</strong> Setiap mahasiswa maksimal booking 1 sesi per hari menggunakan NIM aktif. Harap hadir di Ruang Game Corner 10 menit sebelum sesi dimulai.
        </p>
      </footer>

    </div>
@endsection

@push('scripts')
  <!-- Script Interaktivitas: Single Selection Sesi & Ganti Tanggal -->
  <script>
    let selectedSessionId = 'session-5';

    // Fungsi Klik Kartu: Hanya memilih 1 sesi dalam satu waktu
    function handleCardClick(sessionId, timeSlot, isFull) {
      if (isFull) return;

      const allCards = document.querySelectorAll('.session-card');
      allCards.forEach(card => card.classList.remove('is-selected'));

      const targetCard = document.getElementById(sessionId);
      if (targetCard) {
        targetCard.classList.add('is-selected');
        selectedSessionId = sessionId;
      }
    }

    // Fungsi Tombol Pesan: Memilih sesi dan redirect ke UI-006.html
    function bookSession(event, sessionId, timeSlot) {
      event.stopPropagation(); // Mencegah duplikasi event klik kartu
      handleCardClick(sessionId, timeSlot, false);

      // Simpan sesi terpilih ke localStorage untuk halaman konfirmasi UI-006
      localStorage.setItem('selectedSession', timeSlot);
      localStorage.setItem('selectedUnit', 'PS-01 (PlayStation 5)');

      // Arahkan ke UI-006
      window.location.href = '{{ route('mahasiswa.konfirmasi') }}';
    }

    // Fungsi Pergantian Tab Tanggal (Hari Ini vs Besok)
    function switchDate(type) {
      const tabToday = document.getElementById('tabToday');
      const tabTomorrow = document.getElementById('tabTomorrow');

      if (type === 'today') {
        tabToday.classList.add('active');
        tabTomorrow.classList.remove('active');
        localStorage.setItem('selectedDate', '14 Oktober 2026');
      } else {
        tabTomorrow.classList.add('active');
        tabToday.classList.remove('active');
        localStorage.setItem('selectedDate', '15 Oktober 2026');
      }
    }
  </script>
@endpush