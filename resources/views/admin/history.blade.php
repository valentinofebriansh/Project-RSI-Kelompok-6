@extends('layouts.app')

@section('title', 'UI-009: Halaman History Peminjaman (Admin) - Game Corner FILKOM UB')

@section('content')
    <div class="scrollable-content admin-scrollable" id="adminMainContent">

      <!-- 1. TOPBAR HEADER -->
      <header class="topbar-header">
        <div class="pill-clock">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"></circle>
            <polyline points="12 6 12 12 16 14"></polyline>
          </svg>
          <span>13:03 WIB</span>
        </div>

        <h1 class="page-title-display">History</h1>

        <!-- Tombol Logout: Membuka Popup Konfirmasi Logout (UI-008) -->
        <button type="button" class="btn-logout-trigger" id="btnAdminLogoutTrigger" title="Logout Sesi" aria-label="Logout">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
            <polyline points="16 17 21 12 16 7"></polyline>
            <line x1="21" y1="12" x2="9" y2="12"></line>
          </svg>
        </button>
      </header>

      <!-- 2. FILTER DROPDOWNS -->
      <div class="filter-dropdowns-row">
        <div class="select-wrapper">
          <select class="select-filter-box bg-subtle" aria-label="Filter Unit">
            <option value="semua">Semua Unit</option>
            <option value="ps01">PS-01</option>
            <option value="ps02">PS-02</option>
            <option value="pc01">PC Gaming 01</option>
          </select>
          <svg class="select-chevron-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="6 9 12 15 18 9"></polyline>
          </svg>
        </div>

        <div class="select-wrapper">
          <select class="select-filter-box bg-subtle" aria-label="Filter Bulan">
            <option value="okt2026">Oktober 2026</option>
            <option value="nov2026">November 2026</option>
          </select>
          <svg class="select-chevron-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="6 9 12 15 18 9"></polyline>
          </svg>
        </div>
      </div>

      <!-- 3. KALENDER HISTORY CARD -->
      <div class="calendar-card">
        <div class="calendar-card-header">
          <div>
            <span class="badge-jadwal-selesai">JADWAL SELESAI</span>
            <div class="calendar-month-title" style="margin-top: 4px;">Oktober 2026</div>
          </div>
          <div class="calendar-nav-arrows">
            <button type="button" class="btn-arrow-nav" title="Bulan Sebelumnya">&lt;</button>
            <button type="button" class="btn-arrow-nav" title="Bulan Berikutnya">&gt;</button>
          </div>
        </div>

        <!-- Nama Hari (Senin - Jum'at) -->
        <div class="calendar-days-header">
          <span>SENIN</span>
          <span>SELASA</span>
          <span>RABU</span>
          <span>KAMIS</span>
          <span>JUM'AT</span>
        </div>

        <!-- Grid Tanggal -->
        <div class="calendar-dates-grid" id="calendarDatesGrid">
          <div class="date-box green" data-date="1">1 <span class="dot-indicator"></span></div>
          <div class="date-box green" data-date="2">2 <span class="dot-indicator"></span></div>
          <div class="date-box green" data-date="3">3 <span class="dot-indicator"></span></div>
          <div class="date-box green" data-date="4">4 <span class="dot-indicator"></span></div>
          <div class="date-box green" data-date="5">5 <span class="dot-indicator"></span></div>

          <div class="date-box green" data-date="6">6 <span class="dot-indicator"></span></div>
          <div class="date-box green" data-date="7">7 <span class="dot-indicator"></span></div>
          <div class="date-box green" data-date="8">8 <span class="dot-indicator"></span></div>
          <div class="date-box green" data-date="9">9 <span class="dot-indicator"></span></div>
          <div class="date-box green" data-date="10">10 <span class="dot-indicator"></span></div>

          <div class="date-box green" data-date="11">11 <span class="dot-indicator"></span></div>
          <div class="date-box green" data-date="12">12 <span class="dot-indicator"></span></div>
          <div class="date-box green" data-date="13">13 <span class="dot-indicator"></span></div>
          <div class="date-box green" data-date="14">14 <span class="dot-indicator"></span></div>
          <div class="date-box green" data-date="15">15 <span class="dot-indicator"></span></div>

          <div class="date-box green" data-date="16">16 <span class="dot-indicator"></span></div>
          <div class="date-box green" data-date="17">17 <span class="dot-indicator"></span></div>
          <div class="date-box green" data-date="18">18 <span class="dot-indicator"></span></div>
          <div class="date-box dark" data-date="19">19</div>
          <div class="date-box dark" data-date="20">20</div>

          <div class="date-box dark" data-date="21">21</div>
          <div class="date-box dark" data-date="22">22</div>
          <div class="date-box dark" data-date="23">23</div>
          <div class="date-box dark" data-date="24">24</div>
          <div class="date-box dark" data-date="25">25</div>

          <div class="date-box dark" data-date="26">26</div>
          <div class="date-box dark" data-date="27">27</div>
          <div class="date-box dark" data-date="28">28</div>
          <div class="date-box dark" data-date="29">29</div>
          <div class="date-box dark" data-date="30">30</div>

          <div class="date-box dark" data-date="31">31</div>
        </div>

        <!-- Legend -->
        <div class="calendar-legend-row">
          <div class="legend-item">
            <span class="legend-box green"></span>
            <span>Riwayat Selesai</span>
          </div>
          <div class="legend-item">
            <span class="legend-box dark"></span>
            <span>Tidak Ada Sesi</span>
          </div>
          <div class="legend-item">
            <span class="legend-box blue"></span>
            <span>Terpilih</span>
          </div>
        </div>
      </div>

      <!-- 4. CARD RINGKASAN AKTIVITAS -->
      <div class="activity-summary-card" id="activitySummaryCard">
        <div class="activity-card-header">
          <div class="activity-date-title">
            <span class="dot-orange"></span>
            <span id="activityDateTitle">18 Oktober 2026</span>
          </div>
          <span class="badge-count-orange" id="activityCountBadge">4 Aktivitas</span>
        </div>
        <p class="activity-description" id="activityDescription">
          Penyelesaian sewa PlayStation 01, PC Gaming 01, dan Ruang...
        </p>
      </div>

    </div>

    <!-- 5. FLOATING BOTTOM NAVIGATION BAR -->
    <div class="bottom-floating-nav-wrapper">
      <nav class="bottom-floating-nav" aria-label="Navigasi Utama Admin">
        <button type="button" class="nav-pill-btn active-history">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"></circle>
            <polyline points="12 6 12 12 16 14"></polyline>
          </svg>
          <span>History</span>
        </button>
        <button type="button" class="nav-pill-btn" data-href="{{ route('admin.approval') }}" onclick="window.location.href=this.dataset.href">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
            <polyline points="22 4 12 14.01 9 11.01"></polyline>
          </svg>
          <span>Approval</span>
        </button>
      </nav>
    </div>

    @include('admin.partials.modal_logout')
@endsection