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
            <span>{{ now()->format('H:i') }} WIB</span>
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

    @if (session('success'))
    <div style="padding: 12px 16px; margin: 12px 0; background-color: #ecfdf5; border: 1px solid #a7f3d0; border-radius: 8px; color: #065f46; font-size: 13px; font-weight: 500;">
        {{ session('success') }}
    </div>
    @endif

    <!-- 2. FILTER DROPDOWNS -->
    <div class="filter-dropdowns-row">
        <div class="select-wrapper">
            <select class="select-filter-box" aria-label="Filter Fasilitas" onchange="applyFilters()" id="filterKategori">
                <option value="semua" {{ ($kategori ?? 'semua') === 'semua' ? 'selected' : '' }}>Fasilitas (Semua)</option>
                <option value="ps" {{ ($kategori ?? '') === 'ps' ? 'selected' : '' }}>PlayStation</option>
                <option value="xbox" {{ ($kategori ?? '') === 'xbox' ? 'selected' : '' }}>Xbox</option>
                <option value="vr" {{ ($kategori ?? '') === 'vr' ? 'selected' : '' }}>Virtual Reality</option>
                <option value="piu" {{ ($kategori ?? '') === 'piu' ? 'selected' : '' }}>Pump It Up</option>
            </select>
            <svg class="select-chevron-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="6 9 12 15 18 9"></polyline>
            </svg>
        </div>

        <div class="select-wrapper">
            <select class="select-filter-box" aria-label="Urutkan Peminjaman" onchange="applyFilters()" id="filterUrutan">
                <option value="waktu" {{ ($urutan ?? 'waktu') === 'waktu' ? 'selected' : '' }}>Urutkan: Waktu</option>
                <option value="terbaru" {{ ($urutan ?? '') === 'terbaru' ? 'selected' : '' }}>Urutkan: Terbaru</option>
                <option value="nama" {{ ($urutan ?? '') === 'nama' ? 'selected' : '' }}>Urutkan: Nama</option>
            </select>
            <svg class="select-chevron-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="6 9 12 15 18 9"></polyline>
            </svg>
        </div>
    </div>

    <!-- 3. SECTION TITLE & COUNTER -->
    <section class="section-header-meta">
        <span class="section-title-sm">MENUNGGU TINJAUAN</span>
        <span class="badge-count-orange" id="pendingCountBadge">{{ $reservasis->count() }} Pengajuan</span>
    </section>

    <!-- 4. DAFTAR KARTU APPROVAL -->
    <div class="approval-card-list" id="approvalCardList">

        @forelse ($reservasis as $item)
        <article class="approval-card">
            <div class="approval-info-left">
                <div class="unit-time-row">
                    <span class="unit-code">{{ $item->unit_kode }}</span>
                    <span class="time-pill-blue">
                        {{ substr($item->jadwalSlot->jam_mulai ?? '', 0, 5) }} - {{ substr($item->jadwalSlot->jam_selesai ?? '', 0, 5) }}
                    </span>
                </div>
                <span class="user-name">{{ $item->user->name ?? 'Mahasiswa' }}</span>
                <span class="user-nim">NIM: {{ $item->user->nim ?? '-' }} · {{ \Carbon\Carbon::parse($item->tanggal_reservasi)->format('d M Y') }}</span>
            </div>
            <div class="action-buttons-right">
                <form action="{{ route('admin.approval.reject', $item->id) }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn-action-reject" title="Tolak" aria-label="Tolak Pengajuan">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </form>
                <form action="{{ route('admin.approval.approve', $item->id) }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn-action-approve" title="Setujui" aria-label="Setujui Pengajuan">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                    </button>
                </form>
            </div>
        </article>
        @empty
        <div style="text-align: center; padding: 40px 20px; color: #64748b;">
            <p style="font-size: 14px; font-weight: 500;">Tidak ada pengajuan reservasi yang menunggu tinjauan saat ini.</p>
        </div>
        @endforelse

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

@push('scripts')
<script>
    function applyFilters() {
        const kategori = document.getElementById('filterKategori').value;
        const urutan = document.getElementById('filterUrutan').value;
        const url = new URL("{{ route('admin.approval') }}", window.location.origin);
        url.searchParams.set('kategori', kategori);
        url.searchParams.set('urutan', urutan);
        window.location.href = url.toString();
    }
</script>
@endpush
