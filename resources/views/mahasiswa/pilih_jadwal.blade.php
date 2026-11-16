@extends('layouts.app')

@section('title', 'UI-005: Pilih Tanggal & Sesi Reservasi - Game Corner FILKOM UB')

@section('content')
    <div class="scrollable-content">

      <!-- 1. HEADER & TOMBOL BACK KE UI-004 -->
      <header class="topbar-nav-header">
        <button type="button" class="btn-back-nav" onclick="window.location.href='{{ route('mahasiswa.pilih_unit', ['fasilitas_id' => $fasilitas->id]) }}'" title="Kembali ke Pemilihan Unit" aria-label="Kembali">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <line x1="19" y1="12" x2="5" y2="12"></line>
            <polyline points="12 19 5 12 12 5"></polyline>
          </svg>
        </button>
        <div class="location-header-title">
          <h1>{{ $fasilitas->nama_fasilitas }}</h1>
          <p>Fakultas Ilmu Komputer, Universitas Brawijaya</p>
        </div>
      </header>

      <!-- 2. INFORMASI UNIT TERPILIH & STATUS -->
      <div class="unit-meta-bar">
        <span class="unit-type-pill">{{ $unitNama }}</span>
        <div class="unit-status-ready">
          <span class="dot"></span>
          <span>Siap Digunakan</span>
        </div>
      </div>

      <h2 class="unit-main-id">{{ $unitKode }}</h2>

      <!-- Banner Foto Ruang & Spesifikasi Sesi -->
      <div class="unit-banner-wrapper">
        <img class="unit-banner-img" src="{{ $fasilitas->gambar }}" alt="{{ $fasilitas->nama_fasilitas }}">
        <span class="banner-lounge-tag">{{ $fasilitas->lokasi }}</span>
        <div class="banner-specs-overlay">
          <span class="spec-inline">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
              <circle cx="12" cy="10" r="3"></circle>
            </svg>
            <span>{{ $fasilitas->lokasi }}</span>
          </span>
          <span class="spec-inline">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
              <circle cx="9" cy="7" r="4"></circle>
              <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
              <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
            </svg>
            <span>Maks. {{ $fasilitas->kapasitas }} Pemain</span>
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
      @php
        $todayStr = \Carbon\Carbon::today()->toDateString();
        $tomorrowStr = \Carbon\Carbon::tomorrow()->toDateString();
        $isToday = ($tanggal === $todayStr);
      @endphp
      <section class="date-selection-container">
        <span class="date-section-label">Pilih Tanggal Reservasi</span>
        <div class="date-tabs-grid">
          <button type="button" class="date-tab-card {{ $isToday ? 'active' : '' }}" id="tabToday" onclick="switchDate('{{ $todayStr }}')">
            <span class="day-title">Hari Ini</span>
            <span class="date-number">{{ \Carbon\Carbon::today()->format('d M') }}</span>
          </button>
          <button type="button" class="date-tab-card {{ !$isToday ? 'active' : '' }}" id="tabTomorrow" onclick="switchDate('{{ $tomorrowStr }}')">
            <span class="day-title">Besok</span>
            <span class="date-number">{{ \Carbon\Carbon::tomorrow()->format('d M') }}</span>
          </button>
        </div>
      </section>

      <!-- 4. DAFTAR JADWAL SESI TERSEDIA (SINGLE SELECTION) -->
      <section class="schedule-section-header">
        <h2 class="schedule-title">Jadwal Sesi Tersedia</h2>
        <span class="schedule-total-badge">Total {{ $jadwalSlots->count() }} Sesi</span>
      </section>

      <div class="session-card-list" id="sessionList">

        @foreach ($jadwalSlots as $slot)
          @php
            $isBooked = in_array($slot->id, $bookedSlotIds);
            $isPast = in_array($slot->id, $pastSlotIds ?? []);
            $isUnavailable = $isBooked || $isPast;
            $jamRange = substr($slot->jam_mulai, 0, 5) . ' - ' . substr($slot->jam_selesai, 0, 5);
          @endphp

          @if ($isUnavailable)
            <!-- Sesi Penuh / Tidak Tersedia -->
            <article class="session-card is-full" id="session-{{ $slot->id }}">
              <div class="session-left-meta">
                <div class="session-icon-circle">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="15" y1="9" x2="9" y2="15"></line>
                    <line x1="9" y1="9" x2="15" y2="15"></line>
                  </svg>
                </div>
                <div class="session-time-info">
                  <span class="time-range">{{ $jamRange }}</span>
                  <span class="status-text">Sesi {{ $slot->sesi_ke }} · {{ $isPast ? 'Waktu Terlewat' : 'Sudah Terisi' }}</span>
                </div>
              </div>
              <button type="button" class="btn-session-action btn-penuh" disabled>{{ $isPast ? 'Selesai' : 'Penuh' }}</button>
            </article>
          @else
            <!-- Sesi Tersedia -->
            <article class="session-card {{ $slot->is_favorit ? 'is-selected' : '' }}" id="session-{{ $slot->id }}" onclick="handleCardClick('session-{{ $slot->id }}', false)">
              @if ($slot->is_favorit)
                <span class="badge-favorit-tag">FAVORIT</span>
              @endif
              <div class="session-left-meta">
                <div class="session-icon-circle">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <polyline points="12 6 12 12 16 14"></polyline>
                  </svg>
                </div>
                <div class="session-time-info">
                  <span class="time-range">{{ $jamRange }}</span>
                  <span class="status-text">Sesi {{ $slot->sesi_ke }} · {{ $slot->label_status ?? 'Tersedia' }}</span>
                </div>
              </div>
              <button type="button" class="btn-session-action btn-pesan" onclick="bookSession(event, '{{ $slot->id }}')">Pesan</button>
            </article>
          @endif
        @endforeach

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
    const fasilitasId = "{{ $fasilitas->id }}";
    const unitKode = "{{ $unitKode }}";
    const unitNama = "{{ $unitNama }}";
    const selectedTanggal = "{{ $tanggal }}";

    // Fungsi Klik Kartu: Memilih kartu secara visual
    function handleCardClick(sessionId, isFull) {
      if (isFull) return;

      const allCards = document.querySelectorAll('.session-card');
      allCards.forEach(card => card.classList.remove('is-selected'));

      const targetCard = document.getElementById(sessionId);
      if (targetCard) {
        targetCard.classList.add('is-selected');
      }
    }

    // Fungsi Tombol Pesan: Arahkan langsung ke konfirmasi dengan query parameters
    function bookSession(event, slotId) {
      event.stopPropagation();
      const url = new URL("{{ route('mahasiswa.konfirmasi') }}", window.location.origin);
      url.searchParams.set('fasilitas_id', fasilitasId);
      url.searchParams.set('unit_kode', unitKode);
      url.searchParams.set('unit_nama', unitNama);
      url.searchParams.set('tanggal', selectedTanggal);
      url.searchParams.set('jadwal_slot_id', slotId);
      window.location.href = url.toString();
    }

    // Fungsi Pergantian Tab Tanggal (Hari Ini vs Besok) via reload query parameter
    function switchDate(newDate) {
      const url = new URL(window.location.href);
      url.searchParams.set('tanggal', newDate);
      url.searchParams.set('fasilitas_id', fasilitasId);
      url.searchParams.set('unit_kode', unitKode);
      url.searchParams.set('unit_nama', unitNama);
      window.location.href = url.toString();
    }
  </script>
@endpush
