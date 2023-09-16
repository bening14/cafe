<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
            <span class="app-brand-logo demo">
                <!--<svg width="32" height="22" viewBox="0 0 32 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z" fill="#7367F0" />
                    <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd" d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z" fill="#161616" />
                    <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd" d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z" fill="#161616" />
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z" fill="#7367F0" />
                </svg> -->
                <img src="<?= base_url('assets/template-admin/') ?>assets/img/favicon/solusicafe.png" alt="logo" class="img-fluid" style="max-width: 24px;" />
            </span>
            <span class="app-brand-text demo menu-text fw-bold">Solusicafe</span>
        </a>
        <!-- <img src="<?= base_url('assets/template-admin/') ?>assets/img/logo/solusicafe.png" alt="logo" class="img-fluid" style="max-width: 100px;" /> -->

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
            <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1 mb-3">
        <!-- Dashboards -->
        <li class="menu-item">
            <a href="#" class="menu-link">
                <i class="menu-icon tf-icons ti ti-smart-home"></i>
                <div data-i18n="Dashboards">Dashboard</div>
            </a>
        </li>

        <!-- Resto -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Kasir</span>
        </li>
        <li class="menu-item">
            <a href="#" class="menu-link">
                <i class="menu-icon tf-icons ti ti-home-dollar"></i>
                <div data-i18n="Transaksi Baru">Transaksi Baru</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="#" class="menu-link">
                <i class="menu-icon tf-icons ti ti-history"></i>
                <div data-i18n="Riwayat Transaksi">Riwayat Transaksi</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="#" class="menu-link">
                <i class="menu-icon tf-icons ti ti-wallet"></i>
                <div data-i18n="Rekap Kas">Rekap Kas</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="#" class="menu-link">
                <i class="menu-icon tf-icons ti ti-timeline"></i>
                <div data-i18n="Laporan">Laporan</div>
            </a>
        </li>

        <!-- Karyawan -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Karyawan</span>
        </li>
        <li class="menu-item">
            <a href="#" class="menu-link">
                <i class="menu-icon tf-icons ti ti-map-2"></i>
                <div data-i18n="Absensi">Absensi</div>
            </a>
        </li>


    </ul>
</aside>