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
          <span>{{ now()->format('H:i') }} WIB</span>
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
          <select class="select-filter-box bg-subtle" id="filterUnit" onchange="applyFilters()" aria-label="Filter Unit">
            <option value="semua" {{ ($unit ?? 'semua') === 'semua' ? 'selected' : '' }}>Semua Unit</option>
            @foreach ($allUnits as $u)
              <option value="{{ $u }}" {{ ($unit ?? '') === $u ? 'selected' : '' }}>{{ $u }}</option>
            @endforeach
          </select>
          <svg class="select-chevron-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="6 9 12 15 18 9"></polyline>
          </svg>
        </div>

        <div class="select-wrapper">
          <select class="select-filter-box bg-subtle" id="filterBulan" onchange="changeMonthSelect()" aria-label="Filter Bulan">
            @for ($m = 1; $m <= 12; $m++)
              @php
                $optDate = \Carbon\Carbon::createFromDate($tahun, $m, 1);
              @endphp
              <option value="{{ $m }}-{{ $tahun }}" {{ $m == $bulan ? 'selected' : '' }}>
                {{ $optDate->locale('id')->isoFormat('MMMM') }} {{ $tahun }}
              </option>
            @endfor
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
            <div class="calendar-month-title" style="margin-top: 3px;">{{ $monthName }} {{ $tahun }}</div>
          </div>
          <div class="calendar-nav-arrows">
            <button type="button" class="btn-arrow-nav" title="Bulan Sebelumnya" onclick="navigateMonth('{{ $prevDate->month }}', '{{ $prevDate->year }}')">&lt;</button>
            <button type="button" class="btn-arrow-nav" title="Bulan Berikutnya" onclick="navigateMonth('{{ $nextDate->month }}', '{{ $nextDate->year }}')">&gt;</button>
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
          @for ($d = 1; $d <= $daysInMonth; $d++)
            @php
              $dateStr = sprintf('%04d-%02d-%02d', $tahun, $bulan, $d);
              $hasRes = !empty($reservasiByDate[$dateStr]);
            @endphp
            <div class="date-box {{ $hasRes ? 'green' : 'dark' }}" data-date="{{ $dateStr }}" data-day="{{ $d }}">
              {{ $d }}
              @if ($hasRes)
                <span class="dot-indicator"></span>
              @endif
            </div>
          @endfor
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
            <span id="activityDateTitle">Pilih tanggal pada kalender</span>
          </div>
          <span class="badge-count-orange" id="activityCountBadge">0 Tiket</span>
        </div>
        <div id="activityDetailsContainer" style="display: flex; flex-direction: column; gap: 8px; margin-top: 6px;">
          <p class="activity-description" id="activityDescription" style="white-space: normal; color: #64748B;">
            Klik salah satu tanggal pada kalender untuk melihat riwayat tiket reservasi.
          </p>
        </div>
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
          <button type="button" class="format-btn xlsx" id="btnDownloadXlsx" data-format="XLSX" title="Unduh XLSX">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="8" y1="13" x2="16" y2="13"/><line x1="8" y1="17" x2="16" y2="17"/></svg>
            <span>XLSX</span>
          </button>
          <button type="button" class="format-btn csv" data-format="CSV" title="Unduh CSV">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="12 18 12 12"/><line x1="9" y1="15" x2="15" y2="15"/></svg>
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
      const reservasiData = @json($reservasiByDate);
      const dateBoxes = document.querySelectorAll('#calendarDatesGrid .date-box');
      const downloadCard = document.getElementById('downloadDocumentCard');
      const downloadSubtitle = document.getElementById('downloadSubtitle');
      const activityDateTitle = document.getElementById('activityDateTitle');
      const activityCountBadge = document.getElementById('activityCountBadge');
      const activityDetailsContainer = document.getElementById('activityDetailsContainer');
      const btnDownloadXlsx = document.getElementById('btnDownloadXlsx');
      const otherFormatButtons = document.querySelectorAll('.format-btn:not(.xlsx)');

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

      function getStatusBadgeStyle(status) {
        switch (status) {
          case 'pending':
            return 'background: #FEF3C7; color: #92400E; border: 1px solid #FDE68A;';
          case 'disetujui':
            return 'background: #DCFCE7; color: #166534; border: 1px solid #BBF7D0;';
          case 'ditolak':
            return 'background: #FEE2E2; color: #991B1B; border: 1px solid #FECACA;';
          case 'selesai':
            return 'background: #DBEAFE; color: #1E40AF; border: 1px solid #BFDBFE;';
          default:
            return 'background: #F1F5F9; color: #475569; border: 1px solid #E2E8F0;';
        }
      }

      function formatDateIndo(dateStr) {
        const parts = dateStr.split('-');
        const dateObj = new Date(parts[0], parseInt(parts[1], 10) - 1, parts[2]);
        return dateObj.toLocaleDateString('id-ID', {
          day: 'numeric',
          month: 'long',
          year: 'numeric'
        });
      }

      dateBoxes.forEach(function (box) {
        box.addEventListener('click', function () {
          const clickedDate = box.dataset.date;
          const isAlreadySelected = box.classList.contains('selected');

          dateBoxes.forEach(resetBoxAppearance);

          if (isAlreadySelected) {
            selectedDate = null;
            downloadCard.style.display = 'none';
            activityDateTitle.textContent = 'Pilih tanggal pada kalender';
            activityCountBadge.textContent = '0 Tiket';
            activityDetailsContainer.innerHTML = '<p class="activity-description" style="white-space: normal; color: #64748B;">Klik salah satu tanggal pada kalender untuk melihat riwayat tiket reservasi.</p>';
            return;
          }

          selectedDate = clickedDate;
          const dot = box.querySelector('.dot-indicator');
          if (dot) dot.remove();

          box.classList.add('selected');
          const label = document.createElement('span');
          label.className = 'selected-label';
          label.textContent = 'Dipilih';
          box.appendChild(label);

          const formattedDate = formatDateIndo(clickedDate);
          activityDateTitle.textContent = formattedDate;

          const tickets = reservasiData[clickedDate] || [];
          activityCountBadge.textContent = tickets.length + ' Tiket';

          if (tickets.length > 0) {
            let html = '';
            tickets.forEach(function (t) {
              const badgeStyle = getStatusBadgeStyle(t.status);
              html += `
                <div style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 12px; padding: 10px 12px; font-size: 11px;">
                  <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 4px;">
                    <strong style="color: #0F172A; font-size: 12px;">${t.kode_booking}</strong>
                    <span style="padding: 2px 8px; border-radius: 999px; font-size: 10px; font-weight: 700; ${badgeStyle}">${t.status.toUpperCase()}</span>
                  </div>
                  <div style="color: #1E293B; margin-bottom: 3px; font-weight: 500;">
                    <span><strong>${t.unit_kode}</strong> (${t.unit_nama})</span> · <span>${t.jam}</span>
                  </div>
                  <div style="color: #64748B; font-size: 10.5px;">
                    ${t.nama} · NIM: ${t.nim} · WA: ${t.no_whatsapp}
                  </div>
                </div>
              `;
            });
            activityDetailsContainer.innerHTML = html;
          } else {
            activityDetailsContainer.innerHTML = '<p class="activity-description" style="white-space: normal; color: #64748B;">Tidak ada tiket reservasi pada tanggal ini.</p>';
          }

          downloadCard.style.display = 'flex';
          downloadSubtitle.textContent = 'rekapitulasi harian ' + clickedDate;
        });
      });

      // Fungsi pemicu unduh file Excel .xlsx
      function downloadExcelReport() {
        const targetDate = selectedDate || '{{ now()->toDateString() }}';
        const filterUnitEl = document.getElementById('filterUnit');
        const selectedUnit = filterUnitEl ? filterUnitEl.value : 'semua';
        const url = new URL("{{ route('admin.history.export') }}", window.location.origin);
        url.searchParams.set('tanggal', targetDate);
        if (selectedUnit && selectedUnit !== 'semua') {
          url.searchParams.set('unit', selectedUnit);
        }
        window.location.href = url.toString();
      }

      // Tombol XLSX: Unduh file Rekap_Reservasi_YYYY-MM-DD.xlsx
      if (btnDownloadXlsx) {
        btnDownloadXlsx.addEventListener('click', function (e) {
          e.stopPropagation();
          downloadExcelReport();
        });
      }

      // Format button lainnya & download card juga mengunduh file rekapitulasi harian tanpa alert
      otherFormatButtons.forEach(function (btn) {
        btn.addEventListener('click', function (e) {
          e.stopPropagation();
          downloadExcelReport();
        });
      });

      if (downloadCard) {
        downloadCard.style.cursor = 'pointer';
        downloadCard.addEventListener('click', function () {
          downloadExcelReport();
        });
      }

      window.applyFilters = function () {
        const unit = document.getElementById('filterUnit').value;
        const bulanTahun = document.getElementById('filterBulan').value.split('-');
        const url = new URL(window.location.href);
        url.searchParams.set('unit', unit);
        url.searchParams.set('bulan', bulanTahun[0]);
        url.searchParams.set('tahun', bulanTahun[1]);
        window.location.href = url.toString();
      };

      window.changeMonthSelect = function () {
        window.applyFilters();
      };

      window.navigateMonth = function (m, y) {
        const url = new URL(window.location.href);
        url.searchParams.set('bulan', m);
        url.searchParams.set('tahun', y);
        window.location.href = url.toString();
      };
    })();
  </script>
@endpush
