<!DOCTYPE html>

<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="<?= base_url('assets/template-admin/') ?>assets/" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Solusicafe - Gratis untuk UMKM Indonesia</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?= base_url('assets/template-admin/') ?>assets/img/favicon/solusicafe.png" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap" rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="<?= base_url('assets/template-admin/') ?>assets/vendor/fonts/fontawesome.css" />
    <link rel="stylesheet" href="<?= base_url('assets/template-admin/') ?>assets/vendor/fonts/tabler-icons.css" />
    <link rel="stylesheet" href="<?= base_url('assets/template-admin/') ?>assets/vendor/fonts/flag-icons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/template-admin/') ?>assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?= base_url('assets/template-admin/') ?>assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="<?= base_url('assets/template-admin/') ?>assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/template-admin/') ?>assets/vendor/libs/node-waves/node-waves.css" />
    <link rel="stylesheet" href="<?= base_url('assets/template-admin/') ?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="<?= base_url('assets/template-admin/') ?>assets/vendor/libs/typeahead-js/typeahead.css" />
    <link rel="stylesheet" href="<?= base_url('assets/template-admin/') ?>assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css" />
    <link rel="stylesheet" href="<?= base_url('assets/template-admin/') ?>assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css" />
    <link rel="stylesheet" href="<?= base_url('assets/template-admin/') ?>assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css" />
    <link rel="stylesheet" href="<?= base_url('assets/template-admin/') ?>assets/vendor/libs/select2/select2.css" />
    <link rel="stylesheet" href="<?= base_url('assets/template-admin/') ?>assets/vendor/libs/@form-validation/umd/styles/index.min.css" />
    <link rel="stylesheet" href="<?= base_url('assets/template-admin/') ?>assets/vendor/libs/sweetalert2/sweetalert2.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="<?= base_url('assets/template-admin/') ?>assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="<?= base_url('assets/template-admin/') ?>assets/vendor/js/template-customizer.js"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="<?= base_url('assets/template-admin/') ?>assets/js/config.js"></script>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            <?php
            if ($this->session->userdata('level') == 'superuser') {
                include('./application/views/template/menu.php');
            } else if ($this->session->userdata('level') == 'admin') {
                include('./application/views/template/menu_admin.php');
            } else if ($this->session->userdata('level') == 'manajer') {
                include('./application/views/template/menu_manajer.php');
            } else if ($this->session->userdata('level') == 'kasir') {
                include('./application/views/template/menu_kasir.php');
            } else if ($this->session->userdata('level') == 'waitress') {
                include('./application/views/template/menu_waitress.php');
            } else if ($this->session->userdata('level') == 'kitchen') {
                include('./application/views/template/menu_kitchen.php');
            }
            ?>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->


                <?php include('./application/views/template/navbar.php') ?>

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">



                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="card h-100">
                            <div class="card-header d-flex justify-content-between pb-2 mb-1">
                                <div class="card-title mb-1">
                                    <h5 class="m-0 me-2"><?= $outlet['nama_outlet'] ?></h5>
                                    <small class="text-muted"><?= $outlet['lokasi'] ?></small><br>
                                    <small class="text-muted">Phone - <?= $outlet['phone'] ?></small>
                                </div>
                                <div>
                                    <a href="<?= base_url('customer/outlet') ?>" class="btn btn-sm btn-danger"><i class="ti ti-arrow-narrow-left"></i> Kembali</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="nav-align-top">
                                    <ul class="nav nav-tabs nav-fill" role="tablist">
                                        <li class="nav-item">
                                            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-kategori" aria-controls="navs-justified-kategori" aria-selected="true">
                                                Kategori
                                            </button>
                                        </li>
                                        <li class="nav-item">
                                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-link-produk" aria-controls="navs-justified-link-produk" aria-selected="false">
                                                Produk
                                            </button>
                                        </li>
                                        <li class="nav-item">
                                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-link-pajak" aria-controls="navs-justified-link-pajak" aria-selected="false">
                                                Pajak & Layanan
                                            </button>
                                        </li>
                                        <li class="nav-item">
                                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-link-meja" aria-controls="navs-justified-link-meja" aria-selected="false">
                                                Meja
                                            </button>
                                        </li>
                                    </ul>
                                    <div class="tab-content pb-0">
                                        <div class="tab-pane fade show active" id="navs-justified-kategori" role="tabpanel">
                                            <div class="alert alert-dark alert-dismissible d-flex align-items-baseline" role="alert">
                                                <span class="alert-icon alert-icon-lg text-dark me-2">
                                                    <i class="ti ti-bookmark ti-sm"></i>
                                                </span>
                                                <div class="d-flex flex-column ps-1">
                                                    <h5 class="alert-heading mb-2">Catatan</h5>
                                                    <p class="mb-0">Sebelum memulai berjualan, kamu harus menambahkan kategori produk kamu terlebih dahulu.</p>
                                                    <!-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> -->
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="card-datatable table-responsive">
                                                <div class="card-header border-bottom" style="text-align: right;">
                                                    <div>
                                                        <button class="btn btn-sm btn-info" onclick="tambahk()"><i class="ti ti-category-2"></i> Tambah</button>
                                                    </div>
                                                </div>
                                                <table id="table-kategori" class="table">
                                                    <thead class="border-top">
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Nama Kategori</th>
                                                            <th>Jumlah Produk</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="navs-justified-link-produk" role="tabpanel">
                                            <div class="alert alert-dark alert-dismissible d-flex align-items-baseline" role="alert">
                                                <span class="alert-icon alert-icon-lg text-dark me-2">
                                                    <i class="ti ti-bookmark ti-sm"></i>
                                                </span>
                                                <div class="d-flex flex-column ps-1">
                                                    <h5 class="alert-heading mb-2">Catatan</h5>
                                                    <p class="mb-0">Tambahkan produk untuk outlet Anda<br>Produk yang Anda atur kelola stok (YA), akan muncul pada pengaturan Inventory Produk</p>
                                                    <!-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> -->
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="card-datatable table-responsive">
                                                <div class="card-header border-bottom" style="text-align: right;">
                                                    <div>
                                                        <button class="btn btn-sm btn-info" onclick="tambahp()"><i class="ti ti-category-2"></i> Tambah</button>
                                                    </div>
                                                </div>
                                                <table id="table-produk" class="table">
                                                    <thead class="border-top">
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Produk</th>
                                                            <th>Kategori</th>
                                                            <th>Harga</th>
                                                            <th>Kelola Stok</th>
                                                            <th>Jumlah Stok</th>
                                                            <th>Minimum Stok</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="navs-justified-link-pajak" role="tabpanel">
                                            <div class="alert alert-dark alert-dismissible d-flex align-items-baseline" role="alert">
                                                <span class="alert-icon alert-icon-lg text-dark me-2">
                                                    <i class="ti ti-bookmark ti-sm"></i>
                                                </span>
                                                <div class="d-flex flex-column ps-1">
                                                    <h5 class="alert-heading mb-2">Catatan</h5>
                                                    <p class="mb-0">Pajak & Layanan yang Anda tambahkan akan muncul pada struk sebagai beban biaya yang harus dibayarkan oleh Customer Anda</p>
                                                    <!-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> -->
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="card-datatable table-responsive">
                                                <div class="card-header border-bottom" style="text-align: right;">
                                                    <div>
                                                        <button class="btn btn-sm btn-info" onclick="tambahpj()"><i class="ti ti-category-2"></i> Tambah</button>
                                                    </div>
                                                </div>
                                                <table id="table-pajak" class="table">
                                                    <thead class="border-top">
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Nama Biaya</th>
                                                            <th>Jenis</th>
                                                            <th>Satuan</th>
                                                            <th>Jumlah</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="navs-justified-link-meja" role="tabpanel">
                                            <div class="alert alert-dark alert-dismissible d-flex align-items-baseline" role="alert">
                                                <span class="alert-icon alert-icon-lg text-dark me-2">
                                                    <i class="ti ti-bookmark ti-sm"></i>
                                                </span>
                                                <div class="d-flex flex-column ps-1">
                                                    <h5 class="alert-heading mb-2">Catatan</h5>
                                                    <p class="mb-0">Tambahkan meja untuk Outlet Anda, Informasi pesanan juga akan dibuat berdasarkan nama meja</p>
                                                    <!-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> -->
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="card-datatable table-responsive">
                                                <div class="card-header border-bottom" style="text-align: right;">
                                                    <div>
                                                        <button class="btn btn-sm btn-info" onclick="tambahm()"><i class="ti ti-category-2"></i> Tambah</button>
                                                    </div>
                                                </div>
                                                <table id="table-meja" class="table">
                                                    <thead class="border-top">
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Nama Meja</th>
                                                            <th>Kapasitas</th>
                                                            <th>Status</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- / Content -->




                    <!-- Footer -->
                    <?php include('./application/views/template/footer.php') ?>
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>

        <!-- Drag Target Area To SlideIn Menu On Small Screens -->
        <div class="drag-target"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Tambah kategori Modal -->
    <div class="modal fade" id="tambahkategori" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-simple modal-edit-user modal-dialog-centered">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-4">
                        <h3 class="mb-2">Tambah Kategori</h3>
                    </div>
                    <form id="form-data-kategori" method="post" class="row g-3">
                        <div class="col-12 col-md-12">
                            <label class="form-label" for="kategori">Kategori</label>
                            <select name="kategori" id="kategori" class="form-control">
                                <?php
                                foreach ($kategori as $key => $value) {
                                ?>
                                    <option value="<?= $value['id'] . '-' . $value['nama_kategori'] ?>"><?= $value['nama_kategori'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-12 col-md-12" style="text-align: right">
                            <a href="<?= base_url('produk/kategori') ?>">Pilihan tidak ada ? Daftarkan Kategori <i class="ti ti-arrow-narrow-right"></i></a>
                        </div>

                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary me-sm-3 me-1">Tambah</button>
                            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--/ Tambah kategori Modal -->

    <!-- Tambah produk Modal -->
    <div class="modal fade" id="tambahproduk" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-simple modal-edit-user modal-dialog-centered">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-4">
                        <h3 class="mb-2">Tambah Produk</h3>
                    </div>
                    <form id="form-data-produk" method="post" class="row g-3">
                        <div class="col-12 col-md-12">
                            <label class="form-label" for="produk">Nama Produk</label>
                            <select name="produk" id="produk" class="form-control">
                                <?php
                                foreach ($produk as $key => $value) {
                                ?>
                                    <option value="<?= $value['id'] ?>"><?= $value['nama_produk'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-12 col-md-12" style="text-align: right">
                            <a href="<?= base_url('produk') ?>">Pilihan tidak ada ? Daftarkan Produk <i class="ti ti-arrow-narrow-right"></i></a>
                        </div>

                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary me-sm-3 me-1">Tambah</button>
                            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--/ Tambah produk Modal -->

    <!-- Tambah Pajak Modal -->
    <div class="modal fade" id="tambahpajak" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-simple modal-edit-user modal-dialog-centered">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-4">
                        <h3 class="mb-2">Tambah Pajak & Layanan</h3>
                    </div>
                    <form id="form-data-pajak" class="row g-3">
                        <div class="col-12 col-md-12">
                            <label class="form-label" for="pajak">Pilih Pajak atau Layanan</label>
                            <select name="pajak" id="pajak" class="form-control" onchange="showdata()">
                                <?php
                                foreach ($pajak as $key => $value) {
                                ?>
                                    <option value="<?= $value['id'] ?>"><?= $value['nama_biaya'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-12 col-md-12">
                            <label class="form-label" for="jenis">Jenis</label>
                            <input type="text" id="jenis" name="jenis" class="form-control" readonly />
                        </div>
                        <div class="col-12 col-md-12">
                            <label class="form-label" for="satuan">Satuan</label>
                            <input type="text" id="satuan" name="satuan" class="form-control" readonly />
                        </div>
                        <div class="col-12 col-md-12">
                            <label class="form-label" for="jumlah">Jumlah</label>
                            <input type="text" id="jumlah" name="jumlah" class="form-control" readonly />
                        </div>



                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary me-sm-3 me-1">Tambah</button>
                            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--/ Tambah Pajak Modal -->

    <!-- Tambah Meja Modal -->
    <div class="modal fade" id="tambahmeja" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-simple modal-edit-user modal-dialog-centered">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-4">
                        <h3 class="mb-2">Tambah Meja</h3>
                    </div>
                    <form id="form-data-meja" class="row g-3">
                        <div class="col-12 col-md-12">
                            <label class="form-label" for="nama_meja">Nama Meja</label>
                            <input type="text" id="nama_meja" name="nama_meja" class="form-control" />
                        </div>
                        <div class="col-12 col-md-12">
                            <label class="form-label" for="kapasitas">Kapasitas</label>
                            <input type="text" id="kapasitas" name="kapasitas" class="form-control" />
                        </div>
                        <div class="col-12 col-md-12">
                            <label class="form-label" for="status_meja">Status Meja</label>
                            <select name="status_meja" id="status_meja" class="form-control">
                                <option value="Aktif">Aktif</option>
                                <option value="Tidak Aktif">Tidak Aktif</option>
                            </select>
                        </div>



                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary me-sm-3 me-1">Tambah</button>
                            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--/ Tambah Meja Modal -->

    <!-- Edit meja Modal -->
    <div class="modal fade" id="editmeja" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-simple modal-edit-user modal-dialog-centered">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-4">
                        <h3 class="mb-2">Edit Meja</h3>
                    </div>
                    <form id="form-data-edit-meja" class="row g-3">
                        <div class="col-12 col-md-12">
                            <label class="form-label" for="nama_meja_e">Nama Meja</label>
                            <input type="text" id="nama_meja_e" name="nama_meja_e" class="form-control" placeholder="Misal : Meja 1" />
                            <input type="hidden" id="id_e" name="id_e" class="form-control" />
                        </div>
                        <div class="col-12 col-md-12">
                            <label class="form-label" for="kapasitas_e">Kapasitas</label>
                            <input type="text" id="kapasitas_e" name="kapasitas_e" class="form-control" placeholder="Misal : 4" />
                        </div>
                        <div class="col-12 col-md-12">
                            <label class="form-label" for="status_meja_e">Status Meja</label>
                            <select name="status_meja_e" id="status_meja_e" class="form-control">
                                <option value="Aktif">Aktif</option>
                                <option value="Tidak Aktif">Tidak Aktif</option>
                            </select>
                        </div>


                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary me-sm-3 me-1">Ubah</button>
                            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--/ Tambah meja Modal -->



    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

    <script src="<?= base_url('assets/template-admin/') ?>assets/vendor/libs/jquery/jquery.js"></script>
    <script src="<?= base_url('assets/template-admin/') ?>assets/vendor/libs/popper/popper.js"></script>
    <script src="<?= base_url('assets/template-admin/') ?>assets/vendor/js/bootstrap.js"></script>
    <script src="<?= base_url('assets/template-admin/') ?>assets/vendor/libs/node-waves/node-waves.js"></script>
    <script src="<?= base_url('assets/template-admin/') ?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="<?= base_url('assets/template-admin/') ?>assets/vendor/libs/hammer/hammer.js"></script>
    <script src="<?= base_url('assets/template-admin/') ?>assets/vendor/libs/i18n/i18n.js"></script>
    <script src="<?= base_url('assets/template-admin/') ?>assets/vendor/libs/typeahead-js/typeahead.js"></script>
    <script src="<?= base_url('assets/template-admin/') ?>assets/vendor/js/menu.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="<?= base_url('assets/template-admin/') ?>assets/vendor/libs/moment/moment.js"></script>
    <script src="<?= base_url('assets/template-admin/') ?>assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
    <script src="<?= base_url('assets/template-admin/') ?>assets/vendor/libs/select2/select2.js"></script>
    <script src="<?= base_url('assets/template-admin/') ?>assets/vendor/libs/@form-validation/umd/bundle/popular.min.js"></script>
    <script src="<?= base_url('assets/template-admin/') ?>assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js"></script>
    <script src="<?= base_url('assets/template-admin/') ?>assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js"></script>
    <script src="<?= base_url('assets/template-admin/') ?>assets/vendor/libs/cleavejs/cleave.js"></script>
    <script src="<?= base_url('assets/template-admin/') ?>assets/vendor/libs/cleavejs/cleave-phone.js"></script>
    <script src="<?= base_url('assets/template-admin/') ?>assets/vendor/libs/sweetalert2/sweetalert2.js"></script>

    <!-- Main JS -->
    <script src="<?= base_url('assets/template-admin/') ?>assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="<?= base_url('assets/template-admin/') ?>assets/js/app-user-list.js"></script>
</body>

</html>

<script>
    <?php $target = 0; ?>
    $(function() {
        //table kategori
        $("#table-kategori").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": false,
            'serverSide': true,
            'processing': true,
            'searching': false,
            "order": [
                [0, "desc"]
            ],
            'ajax': {
                'dataType': 'json',
                'url': '<?= base_url() ?>produk/ajax_table_kategori_cabang',
                'type': 'post',
                'data': {
                    id: '<?= $id ?>'
                }
            },
            'columns': [{
                    "target": [<?= $target ?>],
                    "className": 'text-center py-1',
                    "data": "data.no",
                }, {
                    "target": [<?= $target ?>],
                    "className": 'text-left py-1',
                    "data": "data.nama_kategori",
                }, {
                    "target": [<?= $target ?>],
                    "className": 'text-center py-1',
                    "data": "data.jumlah_produk",
                },
                {
                    "target": [<?= $target ?>],
                    "className": 'py-1',
                    "data": "data",
                    "render": function(data) {
                        return `<div class="d-flex align-items-center">
                                    
                                    <a href="javascript:;" class="text-body delete-record" onclick="delete_data_kategori('` + data.id + `')"><i class="ti ti-trash ti-sm mx-2"></i></a>
                                    
                                </div>`
                    }
                }
            ],
            "dom": '<"row" <"col-md-6" l><"col-md-6" f>>rt<"row" <"col-md-6" i><"col-md-6" p>>',
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        });

        //table produk
        $("#table-produk").DataTable({
            "responsive": false,
            "lengthChange": true,
            "autoWidth": false,
            'serverSide': true,
            'processing': true,
            "order": [
                [0, "desc"]
            ],
            'ajax': {
                'dataType': 'json',
                'url': '<?= base_url() ?>produk/ajax_table_produk_cabang',
                'type': 'post',
                'data': {
                    id: '<?= $id ?>'
                }
            },
            'columns': [{
                    "target": [<?= $target ?>],
                    "className": 'text-center py-1',
                    "data": "data.no",
                }, {
                    "target": [<?= $target ?>],
                    "className": 'text-left py-1',
                    "data": "data",
                    "render": function(data) {
                        return `<div class="d-flex justify-content-start align-items-center product-name">
                                    <div class="avatar-wrapper">
                                        <div class="avatar avatar me-2 rounded-2 bg-label-secondary"><img src="<?= base_url('assets/template-admin/assets/food/') ?>` + data.gambar + `" alt="Product" class="rounded-2"></div>
                                    </div>
                                        <div class="d-flex flex-column"><h6 class="text-body text-nowrap mb-0">` + data.nama_produk + `</h6><div>` + data.sku + `</div></div>
                                        
                                </div>`
                    }
                }, {
                    "target": [<?= $target ?>],
                    "className": 'text-center py-1',
                    "data": "data.kategori",
                }, {
                    "target": [<?= $target ?>],
                    "className": 'text-center py-1',
                    "data": "data.harga",
                },
                {
                    "target": [<?= $target ?>],
                    "className": 'text-center py-1',
                    "data": "data",
                    "render": function(data) {
                        if (data.kelola_stok == 'TIDAK') {
                            return `<button type="button" class="btn btn-danger btn-sm waves-effect waves-light" onclick="change('` + data.id + `','YA')"><i class="ti ti-arrows-exchange-2"></i> Tidak</button>`
                        } else {
                            return `<button type="button" class="btn btn-success btn-sm waves-effect waves-light" onclick="change('` + data.id + `','TIDAK')"><i class="ti ti-arrows-exchange-2"></i> Ya</button>`
                        }
                    }
                },
                {
                    "target": [<?= $target ?>],
                    "className": 'text-center py-1',
                    "data": "data",
                    "render": function(data) {
                        if (data.kelola_stok == 'TIDAK') {
                            return `<input type="text" id="stok" name="stok" class="form-control" value="` + data.stok + `" disabled />`
                        } else {
                            return `<input type="text" id="stok` + data.id + `" name="stok" class="form-control" value="` + data.stok + `" onkeyup="ubah_stok('` + data.id + `')" />`
                        }
                    }
                },
                {
                    "target": [<?= $target ?>],
                    "className": 'text-center py-1',
                    "data": "data",
                    "render": function(data) {
                        if (data.kelola_stok == 'TIDAK') {
                            return `<input type="text" id="minimum_stok" name="minimum_stok" class="form-control" value="` + data.minimum_stok + `" disabled />`
                        } else {
                            return `<input type="text" id="minimum_stok` + data.id + `" name="minimum_stok" class="form-control" value="` + data.minimum_stok + `" onkeyup="ubah_minimum_stok('` + data.id + `')" />`
                        }
                    }
                },
                {
                    "target": [<?= $target ?>],
                    "className": 'py-1',
                    "data": "data",
                    "render": function(data) {
                        return `<div class="d-flex align-items-center">
                                    
                                    <a href="javascript:;" class="text-body delete-record" onclick="delete_data_produk('` + data.id + `')"><i class="ti ti-trash ti-sm mx-2"></i></a>
                                    
                                </div>`
                    }
                }
            ],
            "dom": '<"row" <"col-md-6" l><"col-md-6" f>>rt<"row" <"col-md-6" i><"col-md-6" p>>',
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        });

        //table pajak
        $("#table-pajak").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            'serverSide': true,
            'processing': true,
            "order": [
                [0, "desc"]
            ],
            'ajax': {
                'dataType': 'json',
                'url': '<?= base_url() ?>customer/ajax_table_pajak_cabang',
                'type': 'post',
                'data': {
                    id: '<?= $id ?>'
                }
            },
            'columns': [{
                    "target": [<?= $target ?>],
                    "className": 'text-center py-1',
                    "data": "data.no",
                }, {
                    "target": [<?= $target ?>],
                    "className": 'text-center py-1',
                    "data": "data.nama_biaya"
                }, {
                    "target": [<?= $target ?>],
                    "className": 'text-center py-1',
                    "data": "data.jenis",
                }, {
                    "target": [<?= $target ?>],
                    "className": 'text-center py-1',
                    "data": "data.satuan",
                }, {
                    "target": [<?= $target ?>],
                    "className": 'text-center py-1',
                    "data": "data.jumlah",
                },
                {
                    "target": [<?= $target ?>],
                    "className": 'py-1',
                    "data": "data",
                    "render": function(data) {
                        return `<div class="d-flex align-items-center">
                                    
                                    <a href="javascript:;" class="text-body delete-record" onclick="delete_data_pajak('` + data.id + `')"><i class="ti ti-trash ti-sm mx-2"></i></a>
                                    
                                </div>`
                    }
                }
            ],
            "dom": '<"row" <"col-md-6" l><"col-md-6" f>>rt<"row" <"col-md-6" i><"col-md-6" p>>',
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        });

        $.ajax({
            url: '<?= base_url() ?>customer/showdatapajak',
            data: {
                id: $('#pajak').val(),
                table: "tbl_pajak_layanan"
            },
            type: 'post',
            dataType: 'json',
            success: function(result) {
                $('#jenis').val(result.jenis)
                $('#jumlah').val(result.jumlah)
                $('#satuan').val(result.satuan)
            }
        })

        //table meja
        $("#table-meja").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            'serverSide': true,
            'processing': true,
            "order": [
                [0, "desc"]
            ],
            'ajax': {
                'dataType': 'json',
                'url': '<?= base_url() ?>customer/ajax_table_meja',
                'type': 'post',
                'data': {
                    id: '<?= $id ?>'
                }
            },
            'columns': [{
                    "target": [<?= $target ?>],
                    "className": 'text-center py-1',
                    "data": "data.no",
                }, {
                    "target": [<?= $target ?>],
                    "className": 'text-center py-1',
                    "data": "data.nama_meja"
                }, {
                    "target": [<?= $target ?>],
                    "className": 'text-center py-1',
                    "data": "data.kapasitas",
                }, {
                    "target": [<?= $target ?>],
                    "className": 'text-center py-1',
                    "data": "data",
                    "render": function(data) {
                        if (data.status_meja == 'Aktif') {
                            return `<button type="button" class="btn rounded-pill btn-label-success btn-sm waves-effect">Aktif</button>`
                        } else {
                            return `<button type="button" class="btn rounded-pill btn-label-danger btn-sm waves-effect">Tidak Aktif</button>`
                        }
                    }
                },
                {
                    "target": [<?= $target ?>],
                    "className": 'py-1',
                    "data": "data",
                    "render": function(data) {
                        return `<div class="d-flex align-items-center">
                                    <a href="javascript:;" class="text-body" onclick="editm('` + data.id + `', '` + data.nama_meja + `','` + data.kapasitas + `')"><i class="ti ti-edit ti-sm me-2"></i></a>
                                    <a href="javascript:;" class="text-body delete-record" onclick="delete_data_meja('` + data.id + `')"><i class="ti ti-trash ti-sm mx-2"></i></a>
                                    
                                </div>`
                    }
                }
            ],
            "dom": '<"row" <"col-md-6" l><"col-md-6" f>>rt<"row" <"col-md-6" i><"col-md-6" p>>',
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        });

    });

    function reload_table_kategori() {
        $('#table-kategori').DataTable().ajax.reload(null, false);
    }

    function reload_table_produk() {
        $('#table-produk').DataTable().ajax.reload(null, false);
    }

    function reload_table_pajak() {
        $('#table-pajak').DataTable().ajax.reload(null, false);
    }

    function reload_table_meja() {
        $('#table-meja').DataTable().ajax.reload(null, false);
    }

    $("#form-data-kategori").submit(function(e) {
        e.preventDefault()

        var form_data = new FormData();
        form_data.append('table', 'mst_kategori_cabang');
        form_data.append('nama', $("#kategori").val());
        form_data.append('id_mst_outlet', '<?= $id ?>');
        form_data.append('id_mst_bisnis', '<?= $id_mst_bisnis ?>');

        var url_ajax = '<?= base_url() ?>produk/insert_data_kategori_cabang'

        $.ajax({
            url: url_ajax,
            type: "post",
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            dataType: "json",
            success: function(result) {
                if (result.status == "success") {
                    $('#tambahkategori').modal('hide');
                    reload_table_kategori()

                } else if (result.status == "double") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Kategori yang Anda tambahkan sudah tersedia',
                        customClass: {
                            confirmButton: 'btn btn-primary'
                        },
                        buttonsStyling: false
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Gagal tambah data',
                        customClass: {
                            confirmButton: 'btn btn-primary'
                        },
                        buttonsStyling: false
                    })
                }
            },
            error: function(err) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Telah terjadi kesalahan, silahkan contact CS',
                    customClass: {
                        confirmButton: 'btn btn-primary'
                    },
                    buttonsStyling: false
                })
            }
        })
    })

    $("#form-data-produk").submit(function(e) {
        e.preventDefault()

        var form_data = new FormData();
        form_data.append('table', 'mst_produk_cabang');
        form_data.append('id', $("#produk").val());
        form_data.append('id_mst_outlet', '<?= $id ?>');
        form_data.append('id_mst_bisnis', '<?= $id_mst_bisnis ?>');

        var url_ajax = '<?= base_url() ?>produk/insert_data_produk_cabang'

        $.ajax({
            url: url_ajax,
            type: "post",
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            dataType: "json",
            success: function(result) {
                if (result.status == "success") {
                    $('#tambahproduk').modal('hide');
                    reload_table_produk()

                } else if (result.status == "double") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Produk yang Anda tambahkan sudah tersedia',
                        customClass: {
                            confirmButton: 'btn btn-primary'
                        },
                        buttonsStyling: false
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Gagal tambah data',
                        customClass: {
                            confirmButton: 'btn btn-primary'
                        },
                        buttonsStyling: false
                    })
                }
            },
            error: function(err) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Telah terjadi kesalahan, silahkan contact CS',
                    customClass: {
                        confirmButton: 'btn btn-primary'
                    },
                    buttonsStyling: false
                })
            }
        })
    })

    $("#form-data-pajak").submit(function(e) {
        e.preventDefault()

        var form_data = new FormData();
        form_data.append('table', 'tbl_pajak_layanan_cabang');
        form_data.append('id', $("#pajak").val());
        form_data.append('id_mst_outlet', '<?= $id ?>');

        var url_ajax = '<?= base_url() ?>customer/insert_data_pajak_cabang'

        $.ajax({
            url: url_ajax,
            type: "post",
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            dataType: "json",
            success: function(result) {
                if (result.status == "success") {
                    $('#tambahpajak').modal('hide');
                    reload_table_pajak()
                    // location.reload();

                } else if (result.status == "double") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Pajak & Layanan yang Anda tambahkan sudah tersedia',
                        customClass: {
                            confirmButton: 'btn btn-primary'
                        },
                        buttonsStyling: false
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Gagal tambah data',
                        customClass: {
                            confirmButton: 'btn btn-primary'
                        },
                        buttonsStyling: false
                    })
                }
            },
            error: function(err) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Telah terjadi kesalahan, silahkan contact CS',
                    customClass: {
                        confirmButton: 'btn btn-primary'
                    },
                    buttonsStyling: false
                })
            }
        })
    })

    $("#form-data-meja").submit(function(e) {
        e.preventDefault()

        var form_data = new FormData();
        form_data.append('table', 'tbl_meja');
        form_data.append('nama_meja', $("#nama_meja").val());
        form_data.append('kapasitas', $("#kapasitas").val());
        form_data.append('status_meja', $("#status_meja").val());
        form_data.append('kondisi', 'Kosong');
        form_data.append('id_mst_outlet', '<?= $id ?>');
        form_data.append('id_mst_bisnis', '<?= $id_mst_bisnis ?>');

        var url_ajax = '<?= base_url() ?>customer/insert_data_meja'

        $.ajax({
            url: url_ajax,
            type: "post",
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            dataType: "json",
            success: function(result) {
                if (result.status == "success") {
                    $('#tambahmeja').modal('hide');
                    reload_table_meja()

                } else if (result.status == "double") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Meja yang Anda tambahkan sudah tersedia',
                        customClass: {
                            confirmButton: 'btn btn-primary'
                        },
                        buttonsStyling: false
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Gagal tambah data',
                        customClass: {
                            confirmButton: 'btn btn-primary'
                        },
                        buttonsStyling: false
                    })
                }
            },
            error: function(err) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Telah terjadi kesalahan, silahkan contact CS',
                    customClass: {
                        confirmButton: 'btn btn-primary'
                    },
                    buttonsStyling: false
                })
            }
        })
    })

    $("#form-data-edit-meja").submit(function(e) {
        e.preventDefault()

        var form_data = new FormData();
        form_data.append('table', 'tbl_meja');
        form_data.append('id', $("#id_e").val());
        form_data.append('nama_meja', $("#nama_meja_e").val());
        form_data.append('kapasitas', $("#kapasitas_e").val());
        form_data.append('status_meja', $("#status_meja_e").val());
        form_data.append('id_mst_outlet', '<?= $id ?>');
        form_data.append('id_mst_bisnis', '<?= $id_mst_bisnis ?>');

        var url_ajax = '<?= base_url() ?>customer/edit_data_meja'

        $.ajax({
            url: url_ajax,
            type: "post",
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            dataType: "json",
            success: function(result) {
                if (result.status == "success") {
                    $('#editmeja').modal('hide');
                    reload_table_meja()

                } else if (result.status == "double") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Meja yang Anda tambahkan sudah tersedia',
                        customClass: {
                            confirmButton: 'btn btn-primary'
                        },
                        buttonsStyling: false
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Gagal tambah data',
                        customClass: {
                            confirmButton: 'btn btn-primary'
                        },
                        buttonsStyling: false
                    })
                }
            },
            error: function(err) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Telah terjadi kesalahan, silahkan contact CS',
                    customClass: {
                        confirmButton: 'btn btn-primary'
                    },
                    buttonsStyling: false
                })
            }
        })
    })

    function tambahk(id) {
        $('#tambahkategori').modal('show')

        $('#id_mst_bisnis').val(id)
    }

    function tambahpj(id) {
        $('#tambahpajak').modal('show')

        $('#id_mst_bisnis').val(id)
    }

    function tambahp(id) {
        $('#tambahproduk').modal('show')

        $('#id_mst_bisnis').val(id)
    }

    function tambahm(id) {
        $('#tambahmeja').modal('show')

        $('#id_mst_bisnis').val(id)
    }

    function delete_data_kategori(id) {
        Swal.fire({
            title: 'Apakah Anda Yakin ?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus saja!',
            customClass: {
                confirmButton: 'btn btn-primary me-1',
                cancelButton: 'btn btn-label-secondary'
            },
            buttonsStyling: false
        }).then(function(result) {
            if (result.value) {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= base_url() ?>produk/delete_data',
                        data: {
                            id: id,
                            table: "mst_kategori_cabang"
                        },
                        type: 'post',
                        dataType: 'json',
                        success: function(result) {
                            if (result.status == "success") {
                                reload_table_kategori()
                            } else
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Gagal hapus data',
                                    customClass: {
                                        confirmButton: 'btn btn-primary'
                                    },
                                    buttonsStyling: false
                                })
                        }
                    })
                }
            }
        });
    }

    function delete_data_meja(id) {
        Swal.fire({
            title: 'Apakah Anda Yakin ?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus saja!',
            customClass: {
                confirmButton: 'btn btn-primary me-1',
                cancelButton: 'btn btn-label-secondary'
            },
            buttonsStyling: false
        }).then(function(result) {
            if (result.value) {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= base_url() ?>produk/delete_data',
                        data: {
                            id: id,
                            table: "tbl_meja"
                        },
                        type: 'post',
                        dataType: 'json',
                        success: function(result) {
                            if (result.status == "success") {
                                reload_table_meja()
                            } else
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Gagal hapus data',
                                    customClass: {
                                        confirmButton: 'btn btn-primary'
                                    },
                                    buttonsStyling: false
                                })
                        }
                    })
                }
            }
        });
    }

    function delete_data_pajak(id) {
        Swal.fire({
            title: 'Apakah Anda Yakin ?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus saja!',
            customClass: {
                confirmButton: 'btn btn-primary me-1',
                cancelButton: 'btn btn-label-secondary'
            },
            buttonsStyling: false
        }).then(function(result) {
            if (result.value) {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= base_url() ?>produk/delete_data',
                        data: {
                            id: id,
                            table: "tbl_pajak_layanan_cabang"
                        },
                        type: 'post',
                        dataType: 'json',
                        success: function(result) {
                            if (result.status == "success") {
                                reload_table_pajak()
                            } else
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Gagal hapus data',
                                    customClass: {
                                        confirmButton: 'btn btn-primary'
                                    },
                                    buttonsStyling: false
                                })
                        }
                    })
                }
            }
        });
    }

    function change(id, data) {
        $.ajax({
            url: '<?= base_url() ?>produk/ubah_kelola_stok',
            data: {
                id: id,
                kelola_stok: data
            },
            type: 'post',
            dataType: 'json',
            success: function(result) {
                if (result.status == "success") {
                    reload_table_produk()
                } else
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Telah terjadi kesalahan, silahkan contact CS',
                        customClass: {
                            confirmButton: 'btn btn-primary'
                        },
                        buttonsStyling: false
                    })
            }
        })
    }

    function ubah_stok(id) {
        $.ajax({
            url: '<?= base_url() ?>produk/ubah_stok',
            data: {
                id: id,
                stok: $('#stok' + id).val()
            },
            type: 'post',
            dataType: 'json',
            success: function(result) {
                if (result.status == "success") {
                    reload_table_produk()
                } else
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Telah terjadi kesalahan, silahkan contact CS',
                        customClass: {
                            confirmButton: 'btn btn-primary'
                        },
                        buttonsStyling: false
                    })
            }
        })
    }

    function ubah_minimum_stok(id) {
        $.ajax({
            url: '<?= base_url() ?>produk/ubah_minimum_stok',
            data: {
                id: id,
                minimum_stok: $('#minimum_stok' + id).val()
            },
            type: 'post',
            dataType: 'json',
            success: function(result) {
                if (result.status == "success") {
                    reload_table_produk()
                } else
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Telah terjadi kesalahan, silahkan contact CS',
                        customClass: {
                            confirmButton: 'btn btn-primary'
                        },
                        buttonsStyling: false
                    })
            }
        })
    }

    function delete_data_produk(id) {
        Swal.fire({
            title: 'Apakah Anda Yakin ?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus saja!',
            customClass: {
                confirmButton: 'btn btn-primary me-1',
                cancelButton: 'btn btn-label-secondary'
            },
            buttonsStyling: false
        }).then(function(result) {
            if (result.value) {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= base_url() ?>produk/delete_data',
                        data: {
                            id: id,
                            table: "mst_produk_cabang"
                        },
                        type: 'post',
                        dataType: 'json',
                        success: function(result) {
                            if (result.status == "success") {
                                reload_table_produk()
                            } else
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Gagal hapus data',
                                    customClass: {
                                        confirmButton: 'btn btn-primary'
                                    },
                                    buttonsStyling: false
                                })
                        }
                    })
                }
            }
        });
    }

    function showdata() {
        $.ajax({
            url: '<?= base_url() ?>customer/showdatapajak',
            data: {
                id: $('#pajak').val(),
                table: "tbl_pajak_layanan"
            },
            type: 'post',
            dataType: 'json',
            success: function(result) {
                $('#jenis').val(result.jenis)
                $('#jumlah').val(result.jumlah)
                $('#satuan').val(result.satuan)
            }
        })
    }

    function editm(id, nama, kapasitas) {
        $('#editmeja').modal('show')

        $('#id_e').val(id)
        $('#nama_meja_e').val(nama)
        $('#kapasitas_e').val(kapasitas)
    }
</script>