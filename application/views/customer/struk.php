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

                        <div class="row">
                            <div class="col-xl-8 col-md-8 order-2 order-lg-1 mb-4">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between">
                                        <div class="card-title mb-0">
                                            <h5 class="mb-0">Pengaturan Struk</h5>
                                            <small class="text-muted">Anda dapat mengatur logo dan text untuk ditampilkan pada cetakan struk</small>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-unstyled mb-0">
                                            <li class="mb-3 pb-1">
                                                <div class="d-flex align-items-start">
                                                    <div class="badge bg-label-secondary p-2 me-3 rounded"><i class="ti ti-shadow ti-sm"></i></div>
                                                    <div class="d-flex justify-content-between w-100 flex-wrap gap-2">
                                                        <div class="me-2">
                                                            <h6 class="mb-0">Direct Source</h6>
                                                            <small class="text-muted">Direct link click</small>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <p class="mb-0">1.2k</p>
                                                            <div class="ms-3 badge bg-label-success">+4.2%</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="mb-3 pb-1">
                                                <div class="d-flex align-items-start">
                                                    <div class="badge bg-label-secondary p-2 me-3 rounded"><i class="ti ti-globe ti-sm"></i></div>
                                                    <div class="d-flex justify-content-between w-100 flex-wrap gap-2">
                                                        <div class="me-2">
                                                            <h6 class="mb-0">Social Network</h6>
                                                            <small class="text-muted">Social Channels</small>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <p class="mb-0">31.5k</p>
                                                            <div class="ms-3 badge bg-label-success">+8.2%</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="mb-3 pb-1">
                                                <div class="d-flex align-items-start">
                                                    <div class="badge bg-label-secondary p-2 me-3 rounded"><i class="ti ti-mail ti-sm"></i></div>
                                                    <div class="d-flex justify-content-between w-100 flex-wrap gap-2">
                                                        <div class="me-2">
                                                            <h6 class="mb-0">Email Newsletter</h6>
                                                            <small class="text-muted">Mail Campaigns</small>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <p class="mb-0">893</p>
                                                            <div class="ms-3 badge bg-label-success">+2.4%</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="mb-3 pb-1">
                                                <div class="d-flex align-items-start">
                                                    <div class="badge bg-label-secondary p-2 me-3 rounded"><i class="ti ti-external-link ti-sm"></i></div>
                                                    <div class="d-flex justify-content-between w-100 flex-wrap gap-2">
                                                        <div class="me-2">
                                                            <h6 class="mb-0">Referrals</h6>
                                                            <small class="text-muted">Impact Radius Visits</small>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <p class="mb-0">342</p>
                                                            <div class="ms-3 badge bg-label-danger">-0.4%</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="mb-3 pb-1">
                                                <div class="d-flex align-items-start">
                                                    <div class="badge bg-label-secondary p-2 me-3 rounded"><i class="ti ti-discount-2 ti-sm"></i></div>
                                                    <div class="d-flex justify-content-between w-100 flex-wrap gap-2">
                                                        <div class="me-2">
                                                            <h6 class="mb-0">ADVT</h6>
                                                            <small class="text-muted">Google ADVT</small>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <p class="mb-0">2.15k</p>
                                                            <div class="ms-3 badge bg-label-success">+9.1%</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="mb-2">
                                                <div class="d-flex align-items-start">
                                                    <div class="badge bg-label-secondary p-2 me-3 rounded"><i class="ti ti-star ti-sm"></i></div>
                                                    <div class="d-flex justify-content-between w-100 flex-wrap gap-2">
                                                        <div class="me-2">
                                                            <h6 class="mb-0">Other</h6>
                                                            <small class="text-muted">Many Sources</small>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <p class="mb-0">12.5k</p>
                                                            <div class="ms-3 badge bg-label-success">+6.2%</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-4 order-2 order-lg-1 mb-4">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between">
                                        <div class="card-title mb-0">
                                            <h5 class="mb-0">Cetakan Struk</h5>
                                            <small class="text-muted">Hasil printout struk</small>
                                        </div>
                                        <div style="text-align: right;">
                                            <button class="btn btn-sm btn-success"><i class="ti ti-refresh"></i> Preview</button>
                                        </div>
                                    </div>
                                    <div class="card-body" style="background-color: white;color: black;">
                                        <div style="width: 75%;margin: 0 auto;border: 1px solid gray;margin-top: 30px;margin-bottom:30px;padding: 10px;">
                                            <div class="row mb-3">
                                                <div class="col-md-12 text-center mt-3">
                                                    <img src="<?= base_url('assets/template-admin/assets/img/avatars/outlet.png') ?>" alt="logo struk" class="img-fluid mb-1" style="max-width: 40px;filter: grayscale(100%); "><br>
                                                    <small>Cafe SCM</small><br>
                                                    <small>Jl. Subali I Blok 13C No.5 Malang</small><br>
                                                    <small>0341-556677</small>
                                                </div>
                                            </div>
                                            <div class="row text-left">
                                                <div class="col-md-4">
                                                    <small>Struk</small>
                                                </div>
                                                <div class="col-md-8">
                                                    <small>: 5677898786</small>
                                                </div>
                                                <div class="col-md-4">
                                                    <small>No. Meja</small>
                                                </div>
                                                <div class="col-md-8">
                                                    <small>: 1</small>
                                                </div>
                                                <div class="col-md-4">
                                                    <small>Tanggal</small>
                                                </div>
                                                <div class="col-md-8">
                                                    <small>: 26-Sep-2023 15:56:01</small>
                                                </div>
                                                <div class="col-md-4">
                                                    <small>Kasir</small>
                                                </div>
                                                <div class="col-md-8">
                                                    <small>: Agus Salim</small>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 text-center">-------------------------------------------</div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <small>Nasi Rawon</small>
                                                </div>
                                                <div class="col-md-2">
                                                    <small>x2</small>
                                                </div>
                                                <div class="col-md-4">
                                                    <small>50.000</small>
                                                </div>
                                                <div class="col-md-5">
                                                    <small>Es Teh</small>
                                                </div>
                                                <div class="col-md-2">
                                                    <small>x2</small>
                                                </div>
                                                <div class="col-md-4">
                                                    <small>20.000</small>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 text-center">-------------------------------------------</div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <small>Subtotal</small>
                                                </div>
                                                <div class="col-md-4">
                                                    <small>70.000</small>
                                                </div>
                                                <div class="col-md-8">
                                                    <small>PPN (11%)</small>
                                                </div>
                                                <div class="col-md-4">
                                                    <small>7.700</small>
                                                </div>
                                                <div class="col-md-8">
                                                    <small><strong>Total</strong></small>
                                                </div>
                                                <div class="col-md-4">
                                                    <small><strong>77.700</strong></small>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 text-center">-------------------------------------------</div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <small>Tunai</small>
                                                </div>
                                                <div class="col-md-4">
                                                    <small>100.000</small>
                                                </div>
                                                <div class="col-md-8">
                                                    <small>Kembali</small>
                                                </div>
                                                <div class="col-md-4">
                                                    <small>12.300</small>
                                                </div>
                                            </div>
                                            <div class="row text-center mt-3">
                                                <small>Terima Kasih</small>
                                            </div>
                                            <div class="row text-center mt-3">
                                                <small><strong>Supported by Solusicafe</strong></small>
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

    <!-- Tambah Pajak Modal -->
    <div class="modal fade" id="tambahpajak" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-simple modal-edit-user modal-dialog-centered modal-lg">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-4">
                        <h3 class="mb-2">Tambah Biaya Pajak & Layanan</h3>
                    </div>
                    <form id="form-data-pajak" class="row g-3">
                        <div class="col-12 col-md-12">
                            <label class="form-label" for="nama_biaya">Nama Biaya</label>
                            <input type="text" id="nama_biaya" name="nama_biaya" class="form-control" placeholder="Misal : PPN" />
                            <input type="hidden" id="id_mst_bisnis" name="id_mst_bisnis" class="form-control" />
                        </div>
                        <div class="col-12 col-md-12">
                            <label class="form-label" for="jenis">Jenis</label>
                            <select name="jenis" id="jenis" class="form-control">
                                <option value="Pajak">Pajak</option>
                                <option value="Layanan">Layanan</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-12">
                            <label class="form-label" for="satuan">Satuan</label>
                            <select name="satuan" id="satuan" class="form-control">
                                <option value="Persentase">Persentase</option>
                                <option value="Rupiah">Rupiah</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-12">
                            <label class="form-label" for="jumlah">Jumlah</label>
                            <input type="text" id="jumlah" name="jumlah" class="form-control" placeholder="Contoh : Jika Persentase isikan 11 atau jika Rupiah isikan 1000" />
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

    <!-- edit Outlet Modal -->
    <div class="modal fade" id="editpajak" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-simple modal-edit-user modal-dialog-centered modal-lg">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-4">
                        <h3 class="mb-2">Edit Biaya Pajak & Layanan</h3>
                    </div>
                    <form id="form-data-pajak-edit" class="row g-3">
                        <div class="col-12 col-md-12">
                            <label class="form-label" for="nama_biaya_e">Nama Biaya</label>
                            <input type="text" id="nama_biaya_e" name="nama_biaya_e" class="form-control" placeholder="Misal : Outlet Cake" />
                            <input type="hidden" id="id_e" name="id_e" class="form-control" />
                        </div>
                        <div class="col-12 col-md-12">
                            <label class="form-label" for="jenis_e">Jenis</label>
                            <select name="jenis_e" id="jenis_e" class="form-control">
                                <option value="Pajak">Pajak</option>
                                <option value="Layanan">Layanan</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-12">
                            <label class="form-label" for="satuan_e">Satuan</label>
                            <select name="satuan_e" id="satuan_e" class="form-control">
                                <option value="Persentase">Persentase</option>
                                <option value="Rupiah">Rupiah</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-12">
                            <label class="form-label" for="jumlah_e">Jumlah</label>
                            <input type="text" id="jumlah_e" name="jumlah_e" class="form-control" placeholder="Contoh : Jika Persentase isikan 11 atau jika Rupiah isikan 1000" />
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
    <!--/ edit Outlet Modal -->

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
                'url': '<?= base_url() ?>customer/ajax_table_pajak',
                'type': 'post',
                'data': {
                    id_mst_bisnis: '<?= $id_mst_bisnis ?>'
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
                                    <a href="javascript:;" class="text-body" onclick="edito('` + data.id + `','` + data.nama_biaya + `','` + data.jenis + `','` + data.satuan + `','` + data.jumlah + `')"><i class="ti ti-edit ti-sm me-2"></i></a>
                                    <a href="javascript:;" class="text-body delete-record" onclick="delete_data('` + data.id + `')"><i class="ti ti-trash ti-sm mx-2"></i></a>
                                    
                                </div>`
                    }
                }
            ],
            "dom": '<"row" <"col-md-6" l><"col-md-6" f>>rt<"row" <"col-md-6" i><"col-md-6" p>>',
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        });

    });

    function reload_table() {
        $('#table-pajak').DataTable().ajax.reload(null, false);
    }

    $("#form-data-pajak").submit(function(e) {
        e.preventDefault()

        if ($('#nama_biaya').val() == '' || $('#jenis').val() == '' || $('#satuan').val() == '' || $('#jumlah').val() == '') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Tidak boleh ada kolom kosong!',
                customClass: {
                    confirmButton: 'btn btn-primary'
                },
                buttonsStyling: false
            })
            return
        }

        var form_data = new FormData();
        form_data.append('table', 'tbl_pajak_layanan');
        form_data.append('nama_biaya', $("#nama_biaya").val());
        form_data.append('jenis', $("#jenis").val());
        form_data.append('id_mst_bisnis', $("#id_mst_bisnis").val());
        form_data.append('satuan', $("#satuan").val());
        form_data.append('jumlah', $("#jumlah").val());
        form_data.append('kategori', 'tambah');

        var url_ajax = '<?= base_url() ?>customer/insert_data_pajak'

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
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'berhasil tambah data',
                        showConfirmButton: false,
                        timer: 1500,
                        customClass: {
                            confirmButton: 'btn btn-primary'
                        },
                        buttonsStyling: false
                    })
                    $('#nama_biaya').val('')
                    $('#jenis').val('')
                    $('#satuan').val('')
                    $('#jumlah').val('')
                    $('#tambahpajak').modal('hide');
                    reload_table()
                    location.reload();

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


    function tambaho(id) {
        $('#tambahpajak').modal('show')

        $('#id_mst_bisnis').val(id)
    }

    function delete_data(id) {
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
                        url: '<?= base_url() ?>customer/delete_data',
                        data: {
                            id: id,
                            table: "tbl_pajak_layanan"
                        },
                        type: 'post',
                        dataType: 'json',
                        success: function(result) {
                            if (result.status == "success") {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Terhapus!',
                                    text: 'Data berhasil dihapus',
                                    customClass: {
                                        confirmButton: 'btn btn-success'
                                    }
                                });
                                reload_table()
                                location.reload()
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

    function edito(id, nama, jenis, satuan, jumlah) {
        $('#editpajak').modal('show')

        $('#id_e').val(id)
        $('#nama_biaya_e').val(nama)
    }

    $("#form-data-pajak-edit").submit(function(e) {
        e.preventDefault()

        if ($('#nama_biaya_e').val() == '' || $('#jenis_e').val() == '' || $('#satuan_e').val() == '' || $('#jumlah_e').val() == '') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Tidak boleh ada kolom kosong!',
                customClass: {
                    confirmButton: 'btn btn-primary'
                },
                buttonsStyling: false
            })
            return
        }

        var form_data = new FormData();
        form_data.append('table', 'tbl_pajak_layanan');
        form_data.append('id', $("#id_e").val());
        form_data.append('nama_biaya', $("#nama_biaya_e").val());
        form_data.append('jenis', $("#jenis_e").val());
        form_data.append('satuan', $("#satuan_e").val());
        form_data.append('jumlah', $("#jumlah_e").val());
        form_data.append('kategori', 'edit');

        var url_ajax = '<?= base_url() ?>customer/insert_data_pajak'

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
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'berhasil ubah data',
                        showConfirmButton: false,
                        timer: 1500,
                        customClass: {
                            confirmButton: 'btn btn-primary'
                        },
                        buttonsStyling: false
                    })
                    $('#editpajak').modal('hide');
                    reload_table()
                    location.reload()

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Gagal ubah data',
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
</script>