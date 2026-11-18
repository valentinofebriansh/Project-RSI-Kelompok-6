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
          <h1>{{ $fasilitas->nama_fasilitas }}</h1>
          <p>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
              <circle cx="12" cy="10" r="3"></circle>
            </svg>
            <span>{{ $fasilitas->lokasi }}</span>
          </p>
        </div>
      </header>

      <!-- 2. HERO BANNER LOKASI DENGAN BADGE SIAP PAKAI -->
      <div class="facility-hero-wrapper">
        <img class="facility-hero-img" src="{{ $fasilitas->gambar }}" alt="{{ $fasilitas->nama_fasilitas }}">
        <div class="hero-ready-badge">
          <span class="dot"></span>
          <span>{{ count($fasilitas->units ?? []) }} Unit Siap Pakai</span>
        </div>
        <div class="hero-bottom-overlay">
          <span class="hub-tag-pill">FILKOM Gaming Hub</span>
          <span class="capacity-label">Kapasitas Maksimal {{ $fasilitas->kapasitas }} Mahasiswa / Slot</span>
        </div>
      </div>

      <!-- 3. DESKRIPSI & SPESIFIKASI FASILITAS -->
      <section class="card-detail-section">
        <div class="detail-section-header">
          <h2>Deskripsi &amp; Fasilitas</h2>
          <span class="tag-student-only">Khusus Mahasiswa UB</span>
        </div>
        <p class="desc-paragraph">
          {{ $fasilitas->deskripsi }}
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
          <span class="badge-gedung">{{ str_contains($fasilitas->lokasi, 'Gedung F') ? 'Gedung F' : 'GKM' }}</span>
        </div>

        <div class="unit-card-grid">

          @foreach ($fasilitas->units ?? [] as $index => $u)
          @php
            $statusUnit = $unitsStatus[$u['kode']] ?? ['sisa_slot' => 0, 'is_penuh' => false];
            $isPenuh = $statusUnit['is_penuh'];
          @endphp
          <article class="unit-card {{ $index === 0 ? 'is-selected' : 'is-dimmed' }}"
                   id="card-{{ strtolower(str_replace('-', '', $u['kode'])) }}"
                   onclick="selectUnit('card-{{ strtolower(str_replace('-', '', $u['kode'])) }}', '{{ $u['kode'] }} ({{ $u['nama'] }})', '{{ $u['kode'] }}', '{{ $u['nama'] }}')">
            @if (!empty($u['populer']))
            <span class="populer-ribbon-tag">POPULER</span>
            @endif
            <h3 class="unit-card-id">{{ $u['kode'] }}</h3>
            <span class="unit-card-sub">{{ $u['nama'] }}</span>
            <div class="unit-thumb-box">
              @if (str_starts_with($u['kode'], 'PS'))
              <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="16" y="6" width="16" height="34" rx="4" fill="#0F172A"/>
                <path d="M14 8C14 8 18 10 18 40" stroke="#382AFF" stroke-width="2.5" stroke-linecap="round"/>
                <path d="M34 8C34 8 30 10 30 40" stroke="#382AFF" stroke-width="2.5" stroke-linecap="round"/>
                <ellipse cx="24" cy="42" rx="14" ry="3" fill="#64748B"/>
              </svg>
              @elseif (str_starts_with($u['kode'], 'XBOX'))
              <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="17" y="10" width="14" height="28" rx="2" fill="#09090B"/>
                <circle cx="24" cy="15" r="2.5" fill="#10B981"/>
                <line x1="20" y1="22" x2="20.01" y2="22" stroke="#22C55E" stroke-width="2" stroke-linecap="round"/>
                <line x1="20" y1="26" x2="20.01" y2="26" stroke="#22C55E" stroke-width="2" stroke-linecap="round"/>
                <rect x="19" y="32" width="10" height="1.5" rx="0.5" fill="#52525B"/>
              </svg>
              @else
              <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="15" y="8" width="18" height="32" rx="3" fill="#1E293B"/>
                <rect x="18" y="12" width="12" height="14" rx="2" fill="#0EA5E9" fill-opacity="0.3" stroke="#0EA5E9" stroke-width="1.5"/>
                <line x1="18" y1="30" x2="30" y2="30" stroke="#64748B" stroke-width="2"/>
                <line x1="18" y1="34" x2="26" y2="34" stroke="#64748B" stroke-width="2"/>
                <circle cx="24" cy="19" r="3" fill="#382AFF"/>
              </svg>
              @endif
            </div>
            <div class="unit-status-indicator">
              <span class="status-dot" style="background-color: {{ $isPenuh ? '#EF4444' : '#10B981' }};"></span>
              <span>{{ $isPenuh ? 'Penuh Hari Ini' : 'Tersedia (' . $statusUnit['sisa_slot'] . ' Sesi)' }}</span>
            </div>
            <button type="button" class="btn-select-unit">Pilih</button>
          </article>
          @endforeach

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
            <span class="summary-value-bold" id="lblSelectedUnit">{{ ($fasilitas->units[0]['kode'] ?? 'PS-01') . ' (' . ($fasilitas->units[0]['nama'] ?? 'PlayStation 5') . ')' }}</span>
          </div>
          <div class="summary-block-right">
            <span class="summary-title-sm">Tarif Mahasiswa</span>
            <span class="summary-price-bold">GRATIS / Bebas Biaya</span>
          </div>
        </div>

        <button type="button" class="btn-proceed-schedule" id="btnProceedSchedule" onclick="proceedToSchedule()">
          <span>Lanjutkan Pengisian Jadwal</span>
        </button>
      </footer>

    </div>
@endsection

@push('scripts')
  <script>
    let selectedUnitKode = "{{ $fasilitas->units[0]['kode'] ?? 'PS-01' }}";
    let selectedUnitNama = "{{ $fasilitas->units[0]['nama'] ?? 'PlayStation 5' }}";
    const fasilitasId = "{{ $fasilitas->id }}";

    function selectUnit(selectedCardId, unitDisplayName, unitKode, unitNama) {
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

      document.getElementById('lblSelectedUnit').innerText = unitDisplayName;
      selectedUnitKode = unitKode;
      selectedUnitNama = unitNama;
    }

    function proceedToSchedule() {
      const url = new URL("{{ route('mahasiswa.pilih_jadwal') }}", window.location.origin);
      url.searchParams.set('fasilitas_id', fasilitasId);
      url.searchParams.set('unit_kode', selectedUnitKode);
      url.searchParams.set('unit_nama', selectedUnitNama);
      window.location.href = url.toString();
    }
  </script>
@endpush