@extends('layouts.app')

@section('title', 'UI-009 & UI-010: Halaman History Peminjaman & Unduh Rekapitulasi (Admin) - Game Corner FILKOM UB')

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
            <div class="calendar-month-title" style="margin-top: 3px;">Oktober 2026</div>
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

      <!-- 5. CARD UNDUH DOKUMEN REKAPITULASI HARIAN (UI-010 - Muncul saat tanggal dipilih) -->
      <div class="download-document-card" id="downloadDocumentCard" style="display: none;">
        <div class="download-info">
          <h3>Unduh dokumen</h3>
          <p id="downloadSubtitle">rekapitulasi harian</p>
        </div>
        <div class="download-format-icons">
          <button type="button" class="format-btn jpg" data-format="JPG" title="Unduh JPG">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
            <span>JPG</span>
          </button>
          <button type="button" class="format-btn xlsx" data-format="XLSX" title="Unduh XLSX">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="8" y1="13" x2="16" y2="13"/><line x1="8" y1="17" x2="16" y2="17"/></svg>
            <span>XLSX</span>
          </button>
          <button type="button" class="format-btn csv" data-format="CSV" title="Unduh CSV">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="12" y1="18" x2="12" y2="12"/><line x1="9" y1="15" x2="15" y2="15"/></svg>
            <span>CSV</span>
          </button>
          <button type="button" class="format-btn pdf" data-format="PDF" title="Unduh PDF">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="9" y1="15" x2="15" y2="15"/></svg>
            <span>PDF</span>
          </button>
        </div>
      </div>

    </div>

    <!-- 6. FLOATING BOTTOM NAVIGATION BAR -->
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

@push('scripts')
  <script>
    (function () {
      const dateBoxes = document.querySelectorAll('#calendarDatesGrid .date-box');
      const downloadCard = document.getElementById('downloadDocumentCard');
      const activityDateTitle = document.getElementById('activityDateTitle');
      const activityCountBadge = document.getElementById('activityCountBadge');
      const activityDescription = document.getElementById('activityDescription');
      const formatButtons = document.querySelectorAll('.format-btn');

      let selectedDate = null;

      function resetBoxAppearance(box) {
        box.classList.remove('selected');
        const label = box.querySelector('.selected-label');
        if (label) label.remove();

        if (box.classList.contains('green') && !box.querySelector('.dot-indicator')) {
          const dot = document.createElement('span');
          dot.className = 'dot-indicator';
          box.appendChild(dot);
        }
      }

      dateBoxes.forEach(function (box) {
        box.addEventListener('click', function () {
          const clickedDate = box.dataset.date;
          const isAlreadySelected = box.classList.contains('selected');

          dateBoxes.forEach(resetBoxAppearance);

          // Jika kotak yang sama diklik ulang, kembalikan ke tampilan UI-009
          if (isAlreadySelected) {
            selectedDate = null;
            downloadCard.style.display = 'none';
            return;
          }

          // Aktifkan state terpilih (UI-010)
          selectedDate = clickedDate;
          const dot = box.querySelector('.dot-indicator');
          if (dot) dot.remove();

          box.classList.add('selected');
          const label = document.createElement('span');
          label.className = 'selected-label';
          label.textContent = 'Dipilih';
          box.appendChild(label);

          // Perbarui ringkasan aktivitas sesuai tanggal yang dipilih
          activityDateTitle.textContent = clickedDate + ' Oktober 2026';
          if (box.classList.contains('green')) {
            activityCountBadge.textContent = clickedDate === '18' ? '4 Aktivitas' : '3 Aktivitas';
            activityDescription.textContent = 'Penyelesaian sewa PlayStation 01, PC Gaming 01, dan Ruang...';
          } else {
            activityCountBadge.textContent = '0 Aktivitas';
            activityDescription.textContent = 'Tidak ada sesi peminjaman tercatat pada tanggal ini.';
          }

          // Tampilkan panel Unduh Dokumen Rekapitulasi Harian
          downloadCard.style.display = 'flex';
        });
      });

      formatButtons.forEach(function (btn) {
        btn.addEventListener('click', function () {
          const format = btn.dataset.format;
          const tanggalLabel = selectedDate ? selectedDate + ' Oktober 2026' : '18 Oktober 2026';
          alert('Mengunduh rekapitulasi harian tanggal ' + tanggalLabel + ' dalam format ' + format + '...');
        });
      });
    })();
  </script>
@endpush