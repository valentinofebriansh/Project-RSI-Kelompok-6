@extends('layouts.app')

@section('title', 'UI-007: Halaman Approval Pengajuan Peminjaman (Admin) - Game Corner FILKOM UB')

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

        <h1 class="page-title-display">Approval</h1>

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
            <select class="select-filter-box" aria-label="Filter Fasilitas">
                <option value="semua">Fasilitas (Semua)</option>
                <option value="ps">PlayStation</option>
                <option value="xbox">Xbox</option>
                <option value="vr">Virtual Reality</option>
                <option value="piu">Pump It Up</option>
            </select>
            <svg class="select-chevron-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="6 9 12 15 18 9"></polyline>
            </svg>
        </div>

        <div class="select-wrapper">
            <select class="select-filter-box" aria-label="Urutkan Peminjaman">
                <option value="waktu">Urutkan: Waktu</option>
                <option value="terbaru">Urutkan: Terbaru</option>
                <option value="nama">Urutkan: Nama</option>
            </select>
            <svg class="select-chevron-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="6 9 12 15 18 9"></polyline>
            </svg>
        </div>
    </div>

    <!-- 3. SECTION TITLE & COUNTER -->
    <section class="section-header-meta">
        <span class="section-title-sm">MENUNGGU TINJAUAN</span>
        <span class="badge-count-orange" id="pendingCountBadge">6 Pengajuan</span>
    </section>

    <!-- 4. DAFTAR KARTU APPROVAL -->
    <div class="approval-card-list" id="approvalCardList">

        <!-- Item 1: PS-01 M. Rizky Pratama -->
        <article class="approval-card">
            <div class="approval-info-left">
                <div class="unit-time-row">
                    <span class="unit-code">PS–01</span>
                    <span class="time-pill-blue">13:00 - 14:00</span>
                </div>
                <span class="user-name">M. Rizky Pratama</span>
                <span class="user-nim">NIM: 215150201111045</span>
            </div>
            <div class="action-buttons-right">
                <button type="button" class="btn-action-reject" title="Tolak" aria-label="Tolak Pengajuan">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
                <button type="button" class="btn-action-approve" title="Setujui" aria-label="Setujui Pengajuan">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                </button>
            </div>
        </article>

        <!-- Item 2: PS-02 Daffa Ardiansyah -->
        <article class="approval-card">
            <div class="approval-info-left">
                <div class="unit-time-row">
                    <span class="unit-code">PS–02</span>
                    <span class="time-pill-blue">13:00 - 14:00</span>
                </div>
                <span class="user-name">Daffa Ardiansyah</span>
                <span class="user-nim">NIM: 225150400111012</span>
            </div>
            <div class="action-buttons-right">
                <button type="button" class="btn-action-reject" title="Tolak" aria-label="Tolak Pengajuan">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
                <button type="button" class="btn-action-approve" title="Setujui" aria-label="Setujui Pengajuan">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                </button>
            </div>
        </article>

        <!-- Item 3: PC-01 Siti Nurhaliza -->
        <article class="approval-card">
            <div class="approval-info-left">
                <div class="unit-time-row">
                    <span class="unit-code">PC–01</span>
                    <span class="time-pill-blue">14:15 - 15:15</span>
                </div>
                <span class="user-name">Siti Nurhaliza</span>
                <span class="user-nim">NIM: 235150701111089</span>
            </div>
            <div class="action-buttons-right">
                <button type="button" class="btn-action-reject" title="Tolak" aria-label="Tolak Pengajuan">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
                <button type="button" class="btn-action-approve" title="Setujui" aria-label="Setujui Pengajuan">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                </button>
            </div>
        </article>

        <!-- Item 4: PS-02 Kevin Sanjaya -->
        <article class="approval-card">
            <div class="approval-info-left">
                <div class="unit-time-row">
                    <span class="unit-code">PS–02</span>
                    <span class="time-pill-blue">15:30 - 16:30</span>
                </div>
                <span class="user-name">Kevin Sanjaya</span>
                <span class="user-nim">NIM: 215150307111004</span>
            </div>
            <div class="action-buttons-right">
                <button type="button" class="btn-action-reject" title="Tolak" aria-label="Tolak Pengajuan">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
                <button type="button" class="btn-action-approve" title="Setujui" aria-label="Setujui Pengajuan">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                </button>
            </div>
        </article>

        <!-- Item 5: XBOX-01 Ahmad Fauzi -->
        <article class="approval-card">
            <div class="approval-info-left">
                <div class="unit-time-row">
                    <span class="unit-code">XBOX–01</span>
                    <span class="time-pill-blue">13:00 - 14:00</span>
                </div>
                <span class="user-name">Ahmad Fauzi</span>
                <span class="user-nim">NIM: 225150600111033</span>
            </div>
            <div class="action-buttons-right">
                <button type="button" class="btn-action-reject" title="Tolak" aria-label="Tolak Pengajuan">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
                <button type="button" class="btn-action-approve" title="Setujui" aria-label="Setujui Pengajuan">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                </button>
            </div>
        </article>

        <!-- Item 6: PS-01 Amanda Putri -->
        <article class="approval-card">
            <div class="approval-info-left">
                <div class="unit-time-row">
                    <span class="unit-code">PS–01</span>
                    <span class="time-pill-blue">16:45 - 17:45</span>
                </div>
                <span class="user-name">Amanda Putri</span>
                <span class="user-nim">NIM: 235150200111078</span>
            </div>
            <div class="action-buttons-right">
                <button type="button" class="btn-action-reject" title="Tolak" aria-label="Tolak Pengajuan">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
                <button type="button" class="btn-action-approve" title="Setujui" aria-label="Setujui Pengajuan">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                </button>
            </div>
        </article>

    </div>

</div>

<!-- 5. FLOATING BOTTOM NAVIGATION BAR -->
<div class="bottom-floating-nav-wrapper">
    <nav class="bottom-floating-nav" aria-label="Navigasi Utama Admin">
        <button type="button" class="nav-pill-btn" data-href="{{ route('admin.history') }}" onclick="window.location.href=this.dataset.href">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <polyline points="12 6 12 12 16 14"></polyline>
            </svg>
            <span>History</span>
        </button>
        <button type="button" class="nav-pill-btn active">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                <polyline points="22 4 12 14.01 9 11.01"></polyline>
            </svg>
            <span>Approval</span>
        </button>
    </nav>
</div>

@include('admin.partials.modal_logout')
@endsection