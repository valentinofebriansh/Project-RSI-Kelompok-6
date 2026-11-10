@extends('layouts.app')

@section('title', 'UI-006: Konfirmasi Data Peminjaman - Game Corner FILKOM UB')

@section('content')
    <div class="scrollable-content">

      <!-- 1. HEADER & TOMBOL BACK KE UI-005 -->
      <header class="topbar-nav-header">
        <button type="button" class="btn-back-nav" onclick="window.location.href='{{ route('mahasiswa.pilih_jadwal') }}'" title="Kembali ke Pemilihan Jadwal" aria-label="Kembali">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <line x1="19" y1="12" x2="5" y2="12"></line>
            <polyline points="12 19 5 12 12 5"></polyline>
          </svg>
        </button>
        <div class="location-header-title">
          <h1>Playstation &amp; Xbox Gedung F</h1>
          <p>
            <span class="status-bullet-green"></span>
            <span>Konfirmasi Data Peminjaman</span>
          </p>
        </div>
      </header>

      <!-- 2. BANNER PENGUNCIAN SLOT DENGAN COUNTDOWN -->
      <section class="slot-locked-alert">
        <div class="alert-left-info">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"></circle>
            <polyline points="12 6 12 12 16 14"></polyline>
          </svg>
          <span>Slot terkunci sementara</span>
        </div>
        <span class="countdown-timer-badge" id="countdownTimer">09:48</span>
      </section>

      <!-- 3. DUA KARTU RINGKASAN PEMILIHAN -->
      <section class="summary-cards-grid">
        <!-- Kartu 1: Unit Konsol -->
        <article class="selection-summary-card">
          <div class="summary-card-header">
            <span class="card-meta-label">Unit Konsol</span>
            <span class="card-meta-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="2" y="6" width="20" height="12" rx="2"></rect>
                <line x1="6" y1="12" x2="10" y2="12"></line>
                <line x1="8" y1="10" x2="8" y2="14"></line>
                <circle cx="16" cy="11" r="1"></circle>
                <circle cx="18" cy="13" r="1"></circle>
              </svg>
            </span>
          </div>
          <h2 class="card-main-title">PS-01</h2>
          <span class="card-sub-title">PlayStation 5 Slim</span>
        </article>

        <!-- Kartu 2: Sesi Waktu -->
        <article class="selection-summary-card">
          <div class="summary-card-header">
            <span class="card-meta-label">Sesi Waktu</span>
            <span class="card-meta-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <polyline points="12 6 12 12 16 14"></polyline>
              </svg>
            </span>
          </div>
          <h2 class="card-main-title">13:00 - 14:00</h2>
          <span class="card-sub-title">Hari Ini (60 Menit)</span>
        </article>
      </section>

      <!-- 4. FORMULIR KONFIRMASI DATA PEMINJAM -->
      <form class="booking-form" id="bookingForm" onsubmit="handleBookingSubmit(event)">
        @csrf

        <!-- Field 1: Nama Lengkap (READONLY DARI SSO) -->
        <div class="form-field-group">
          <label class="field-label" for="txtNamaLengkap">
            Nama Lengkap <span class="required-star">*</span>
          </label>
          <div class="input-box-wrapper">
            <input type="text" id="txtNamaLengkap" name="namaLengkap" class="form-input-readonly has-trailing-badge" value="Kaysan Nawfal Niscal Nasution" readonly>
          </div>
        </div>

        <!-- Field 2: NIM (READONLY DARI SSO) -->
        <div class="form-field-group">
          <label class="field-label" for="txtNim">
            Nomor Induk Mahasiswa (NIM) <span class="required-star">*</span>
          </label>
          <div class="input-box-wrapper">
            <input type="text" id="txtNim" name="nim" class="form-input-readonly" value="255150407111081" readonly>
          </div>
        </div>

        <!-- Field 3: Email Mahasiswa (READONLY DARI SSO) -->
        <div class="form-field-group">
          <label class="field-label" for="txtEmail">
            Email Mahasiswa UB <span class="required-star">*</span>
          </label>
          <div class="input-box-wrapper">
            <input type="email" id="txtEmail" name="email" class="form-input-readonly has-trailing-icon" value="kaysannasution@student.ub.ac.id" readonly>
            <svg class="trailing-icon-static" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <rect x="2" y="4" width="20" height="16" rx="2"></rect>
              <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
            </svg>
          </div>
        </div>

        <!-- Field 4: No. WhatsApp Aktif (EDITABLE - SATU-SATUNYA YANG BISA DIUBAH) -->
        <div class="form-field-group">
          <div class="field-label-row">
            <label class="field-label" for="txtWhatsapp">
              No. WhatsApp Aktif <span class="required-star">*</span>
            </label>
          </div>
          <div class="whatsapp-input-container">
            <span class="country-code-pill">+62</span>
            <input type="tel" id="txtWhatsapp" name="whatsapp" class="input-whatsapp-editable" value="822-7983-5502" placeholder="8xxxxxxxxxx" required autocomplete="tel">
          </div>
        </div>

        <!-- 5. CALLOUT WAJIB CHECK-IN & CHECKBOX PERSETUJUAN -->
        <div class="checkin-notice-callout">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"></circle>
            <line x1="12" y1="16" x2="12" y2="12"></line>
            <line x1="12" y1="8" x2="12.01" y2="8"></line>
          </svg>
          <p>
            <strong>Wajib Check-in:</strong> Harap tunjukkan <strong>KTM (Kartu Tanda Mahasiswa) aktif</strong> fisik / digital ke meja satpam maksimal 10 menit sebelum waktu sesi.
          </p>
        </div>

        <label class="agreement-checkbox-wrapper" for="chkAgreement">
          <input type="checkbox" id="chkAgreement" name="agreement" required>
          <span>
            Saya menyetujui <a href="#syarat-ketentuan" target="_blank" rel="noopener">syarat &amp; tata tertib</a> penggunaan Game Corner Gedung F FILKOM UB.
          </span>
        </label>

        <!-- 6. TOTAL BIAYA & TOMBOL PESAN SEKARANG -->
        <footer class="form-summary-footer">
          <div class="price-verified-row">
            <div class="price-block">
              <span class="price-block-label">Total Biaya Fasilitas</span>
              <strong class="price-block-val">Gratis (Fasilitas UB)</strong>
            </div>
          </div>

          <button type="submit" class="btn-submit-booking" id="btnSubmitBooking">
            <span>Pesan Sekarang</span>
          </button>
        </footer>

      </form>

    </div>
@endsection

@push('scripts')
  <!-- Script Interaktivitas: Timer Countdown & Submit Booking -->
  <script>
    // 1. Script Countdown Timer Sederhana (9 Menit 48 Detik)
    let totalSeconds = 9 * 60 + 48;
    const timerElement = document.getElementById('countdownTimer');

    const countdownInterval = setInterval(() => {
      if (totalSeconds <= 0) {
        clearInterval(countdownInterval);
        timerElement.innerText = "00:00";
        alert("Waktu penahanan slot Anda telah habis. Silakan pilih jadwal kembali.");
        window.location.href = '{{ route('mahasiswa.pilih_jadwal') }}';
        return;
      }

      totalSeconds--;
      const minutes = Math.floor(totalSeconds / 60);
      const seconds = totalSeconds % 60;
      timerElement.innerText = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
    }, 1000);

    // 2. Event Handler Submit Form Booking
    function handleBookingSubmit(event) {
      event.preventDefault();

      const chkAgreement = document.getElementById('chkAgreement');
      if (!chkAgreement.checked) {
        alert("Harap setujui syarat & tata tertib terlebih dahulu.");
        return;
      }

      const whatsappNumber = document.getElementById('txtWhatsapp').value.trim();
      if (!whatsappNumber) {
        alert("Nomor WhatsApp wajib diisi.");
        return;
      }

      // Simpan data kontak WhatsApp ke localStorage
      localStorage.setItem('bookingWhatsapp', '+62' + whatsappNumber);

      // Berikan notifikasi singkat keberhasilan pengajuan booking
      alert("Pengajuan reservasi berhasil dikirim! Menunggu persetujuan admin satpam.");
      window.location.href = '{{ route('mahasiswa.dashboard') }}';
    }
  </script>
@endpush