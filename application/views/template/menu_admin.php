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
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-clipboard-text"></i>
                <div data-i18n="Laporan">Laporan</div>
                <!-- <div class="badge bg-primary rounded-pill ms-auto">3</div> -->
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="#" class="menu-link">
                        <div data-i18n="Laporan Penjualan">Laporan Penjualan</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="#" class="menu-link">
                        <div data-i18n="Laporan Operasional">Laporan Operasional</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="#" class="menu-link">
                        <div data-i18n="Laporan Laba & Rugi">Laporan Laba & Rugi</div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Produk -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Produk</span>
        </li>

        <!-- Layouts -->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-salad"></i>
                <div data-i18n="Produk">Produk</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="<?= base_url('produk/kategori') ?>" class="menu-link">
                        <div data-i18n="Kategori">Kategori</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?= base_url('produk') ?>" class="menu-link">
                        <div data-i18n="Menu">Menu</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="#" class="menu-link">
                        <div data-i18n="Meja">Meja</div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Inventory -->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-box"></i>
                <div data-i18n="Inventory"></div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="#" class="menu-link" target="_blank">
                        <div data-i18n="Kartu Stok">Kartu Stok</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="#" class="menu-link" target="_blank">
                        <div data-i18n="Stok Masuk">Stok Masuk</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="#" class="menu-link" target="_blank">
                        <div data-i18n="Stok Keluar">Stok Keluar</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="#" class="menu-link" target="_blank">
                        <div data-i18n="Transfer Stok">Transfer Stok</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="#" class="menu-link" target="_blank">
                        <div data-i18n="Stok Opname">Stok Opname</div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Pembelian -->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-shopping-bag"></i>
                <div data-i18n="Belanja"></div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="#" class="menu-link" target="_blank">
                        <div data-i18n="Supplier">Supplier</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="#" class="menu-link" target="_blank">
                        <div data-i18n="Purchase Order">Purchase Order</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="#" class="menu-link" target="_blank">
                        <div data-i18n="Daftar Belanja">Daftar Belanja</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="#" class="menu-link" target="_blank">
                        <div data-i18n="Daftar Pengeluaran">Daftar Pengeluaran</div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Bisnis -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Bisnis</span>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-building-store"></i>
                <div data-i18n="Bisnis"></div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="<?= base_url('customer/bisnis') ?>" class="menu-link">
                        <div data-i18n="Outlet">Outlet</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?= base_url('customer/pajak') ?>" class="menu-link">
                        <div data-i18n="Pajak & Layanan">Pajak & Layanan</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?= base_url('customer/struk') ?>" class="menu-link">
                        <div data-i18n="Struk & QR">Struk & QR</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item">
            <a href="<?= base_url('customer/pelanggan') ?>" class="menu-link">
                <i class="menu-icon tf-icons ti ti-users"></i>
                <div data-i18n="Pelanggan">Pelanggan</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="<?= base_url('customer/promo') ?>" class="menu-link">
                <i class="menu-icon tf-icons ti ti-discount-2"></i>
                <div data-i18n="Promo">Promo</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="#" class="menu-link">
                <i class="menu-icon tf-icons ti ti-moneybag"></i>
                <div data-i18n="Komisi">Komisi</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="#" class="menu-link">
                <i class="menu-icon tf-icons ti ti-soup"></i>
                <div data-i18n="Status Meja">Status Meja</div>
            </a>
        </li>

        <!-- Karyawan -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Karyawan</span>
        </li>
        <li class="menu-item">
            <a href="#" class="menu-link">
                <i class="menu-icon tf-icons ti ti-user-pin"></i>
                <div data-i18n="Karyawan">Karyawan</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-map-2"></i>
                <div data-i18n="Absensi"></div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="#" class="menu-link" target="_blank">
                        <div data-i18n="Shift">Shift</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="#" class="menu-link" target="_blank">
                        <div data-i18n="Set Lokasi">Set Lokasi</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="#" class="menu-link" target="_blank">
                        <div data-i18n="Daftar Absensi">Daftar Absensi</div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Pengaturan -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Pengaturan</span>
        </li>
        <li class="menu-item">
            <a href="#" class="menu-link">
                <i class="menu-icon tf-icons ti ti-user-circle"></i>
                <div data-i18n="Akun">Akun</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="#" class="menu-link">
                <i class="menu-icon tf-icons ti ti-coins"></i>
                <div data-i18n="Billing">Billing</div>
            </a>
        </li>
    </ul>
</aside>