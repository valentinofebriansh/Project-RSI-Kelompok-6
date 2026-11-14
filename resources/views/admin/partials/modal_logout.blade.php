<!-- MODAL KONFIRMASI LOGOUT (UI-008) -->
<div class="modal-overlay-backdrop" id="adminLogoutModal" role="dialog" aria-modal="true" aria-labelledby="adminLogoutTitle" style="display: none;">
  <div class="modal-popup-card">

    <!-- Tombol Close (X) -->
    <button type="button" class="btn-modal-close" id="btnCloseAdminLogout" title="Tutup" aria-label="Tutup Modal">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
        <line x1="18" y1="6" x2="6" y2="18"></line>
        <line x1="6" y1="6" x2="18" y2="18"></line>
      </svg>
    </button>

    <!-- Icon Logout (Box Arrow) -->
    <div class="modal-icon-container">
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
        <polyline points="10 17 15 12 10 7"></polyline>
        <line x1="15" y1="12" x2="3" y2="12"></line>
      </svg>
    </div>

    <!-- Teks Informasi -->
    <h2 class="modal-title" id="adminLogoutTitle">Konfirmasi Logout</h2>
    <p class="modal-description">
      Apakah Anda yakin ingin keluar dari sesi Admin Game Corner? Perubahan yang belum disimpan akan tetap tercatat.
    </p>

    <!-- Tombol Aksi -->
    <div class="modal-action-buttons">
      <form action="{{ route('admin.logout') }}" method="POST" style="width: 100%;">
        @csrf
        <button type="submit" class="btn-logout-danger">
          Keluar Sesi
        </button>
      </form>
      <button type="button" class="btn-cancel-secondary" id="btnCancelAdminLogout">
        Batal
      </button>
    </div>

  </div>
</div>

@push('scripts')
  <script>
    (function () {
      const adminLogoutModal = document.getElementById('adminLogoutModal');
      const btnLogoutTrigger = document.getElementById('btnAdminLogoutTrigger');
      const btnCloseModal = document.getElementById('btnCloseAdminLogout');
      const btnCancelModal = document.getElementById('btnCancelAdminLogout');
      const adminMainContent = document.getElementById('adminMainContent');

      window.openAdminLogoutModal = function () {
        if (adminMainContent) {
          adminMainContent.classList.add('admin-content-blurred');
          adminMainContent.setAttribute('aria-hidden', 'true');
        }
        adminLogoutModal.style.display = 'flex';
      };

      window.closeAdminLogoutModal = function () {
        adminLogoutModal.style.display = 'none';
        if (adminMainContent) {
          adminMainContent.classList.remove('admin-content-blurred');
          adminMainContent.removeAttribute('aria-hidden');
        }
      };

      if (btnLogoutTrigger) {
        btnLogoutTrigger.addEventListener('click', window.openAdminLogoutModal);
      }
      if (btnCloseModal) {
        btnCloseModal.addEventListener('click', window.closeAdminLogoutModal);
      }
      if (btnCancelModal) {
        btnCancelModal.addEventListener('click', window.closeAdminLogoutModal);
      }
      if (adminLogoutModal) {
        adminLogoutModal.addEventListener('click', function (event) {
          if (event.target === adminLogoutModal) {
            window.closeAdminLogoutModal();
          }
        });
      }
    })();
  </script>
@endpush