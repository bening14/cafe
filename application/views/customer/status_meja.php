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
                        <div class="col-md-12 col-xl-12 col-xl-12 mb-4">
                            <div class="row">
                                <div class="col-md-12 col-xl-12 mb-3">
                                    <div class="card">
                                        <div class="card-body pb-4 pt-1">
                                            <div class="col-12 col-md-12">
                                                <label class="form-label" for="outlet">Pilih Outlet</label>
                                                <select name="outlet" id="outlet" class="form-control" onchange="showdata()">
                                                    <?php
                                                    foreach ($outlet as $key => $value) {
                                                    ?>
                                                        <option value="<?= $value['id'] ?>"><?= $value['nama_outlet'] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Users List Table -->
                        <div class="col-md-12 col-xl-12 col-xl-12 mb-4">
                            <div class="row" id="status_meja">
                                <!-- <div class="col-md-3 col-xl-3 mb-3">
                                    <div class="card h-100 text-bg-info">
                                        <div class="card-header d-flex justify-content-between pb-2 mb-1">
                                            <div class="card-title mb-1">
                                                <h4 class="m-0 me-2 text-white">Meja-1</h4>
                                                <h4 class="pt-3 text-white">Reservasi</h4>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <button type="button" class="btn btn-dark waves-effect waves-light"><i class="ti ti-notes"></i>&nbsp;&nbsp;Lihat</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-xl-3 mb-3">
                                    <div class="card h-100 text-bg-danger">
                                        <div class="card-header d-flex justify-content-between pb-2 mb-1">
                                            <div class="card-title mb-1">
                                                <h4 class="m-0 me-2 text-white">Meja-2</h4>
                                                <h4 class="pt-3 text-white">Kosong</h4>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <button type="button" class="btn btn-dark waves-effect waves-light"><i class="ti ti-notes"></i>&nbsp;&nbsp;Cetak QR Menu</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-xl-3 mb-3">
                                    <div class="card h-100 text-bg-info">
                                        <div class="card-header d-flex justify-content-between pb-2 mb-1">
                                            <div class="card-title mb-1">
                                                <h4 class="m-0 me-2 text-white">Meja-3</h4>
                                                <h4 class="pt-3 text-white">Reservasi</h4>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <button type="button" class="btn btn-dark waves-effect waves-light"><i class="ti ti-notes"></i>&nbsp;&nbsp;Lihat</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-xl-3 mb-3">
                                    <div class="card h-100 text-bg-danger">
                                        <div class="card-header d-flex justify-content-between pb-2 mb-1">
                                            <div class="card-title mb-1">
                                                <h4 class="m-0 me-2 text-white">Meja-4</h4>
                                                <h4 class="pt-3 text-white">Kosong</h4>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <button type="button" class="btn btn-dark waves-effect waves-light"><i class="ti ti-notes"></i>&nbsp;&nbsp;Cetak QR Menu</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-xl-3 mb-3">
                                    <div class="card h-100 text-bg-info">
                                        <div class="card-header d-flex justify-content-between pb-2 mb-1">
                                            <div class="card-title mb-1">
                                                <h4 class="m-0 me-2 text-white">Meja-5</h4>
                                                <h4 class="pt-3 text-white">Reservasi</h4>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <button type="button" class="btn btn-dark waves-effect waves-light"><i class="ti ti-notes"></i>&nbsp;&nbsp;Lihat</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-xl-3 mb-3">
                                    <div class="card h-100 text-bg-danger">
                                        <div class="card-header d-flex justify-content-between pb-2 mb-1">
                                            <div class="card-title mb-1">
                                                <h4 class="m-0 me-2 text-white">Meja-6</h4>
                                                <h4 class="pt-3 text-white">Kosong</h4>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <button type="button" class="btn btn-dark waves-effect waves-light"><i class="ti ti-notes"></i>&nbsp;&nbsp;Cetak QR Menu</button>
                                        </div>
                                    </div>
                                </div> -->
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
    var a = ''
    $(function() {
        $.ajax({
            url: '<?= base_url() ?>customer/getmeja',
            data: {
                id: $('#outlet').val(),
                table: "tbl_meja"
            },
            type: 'post',
            dataType: 'json',
            success: function(result) {
                result.forEach(d => {
                    if (d.kondisi == 'Kosong') {
                        a += `<div class="col-md-3 col-xl-3 mb-3">
                                    <div class="card h-100 text-bg-danger">
                                        <div class="card-header d-flex justify-content-between pb-2 mb-1">
                                            <div class="card-title mb-1">
                                                <h4 class="m-0 me-2 text-white">` + d.nama_meja + `</h4>
                                                <h4 class="pt-3 text-white">` + d.kondisi + `</h4>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <button type="button" class="btn btn-dark waves-effect waves-light"><i class="ti ti-notes"></i>&nbsp;&nbsp;Lihat</button>
                                        </div>
                                    </div>
                                </div>`
                    } else {
                        a += `<div class="col-md-3 col-xl-3 mb-3">
                                    <div class="card h-100 text-bg-info">
                                        <div class="card-header d-flex justify-content-between pb-2 mb-1">
                                            <div class="card-title mb-1">
                                                <h4 class="m-0 me-2 text-white">` + d.nama_meja + `</h4>
                                                <h4 class="pt-3 text-white">` + d.kondisi + `</h4>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                        <button type="button" class="btn btn-dark waves-effect waves-light"><i class="ti ti-notes"></i>&nbsp;&nbsp;Cetak QR Menu</button>
                                        </div>
                                    </div>
                                </div>`
                    }
                });
                $('#status_meja').html(a)
            }
        })

    });

    function showdata() {
        var a = ''
        $.ajax({
            url: '<?= base_url() ?>customer/getmeja',
            data: {
                id: $('#outlet').val(),
                table: "tbl_meja"
            },
            type: 'post',
            dataType: 'json',
            success: function(result) {
                result.forEach(d => {
                    if (d.kondisi == 'Kosong') {
                        a += `<div class="col-md-3 col-xl-3 mb-3">
                                    <div class="card h-100 text-bg-danger">
                                        <div class="card-header d-flex justify-content-between pb-2 mb-1">
                                            <div class="card-title mb-1">
                                                <h4 class="m-0 me-2 text-white">` + d.nama_meja + `</h4>
                                                <h4 class="pt-3 text-white">` + d.kondisi + `</h4>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <button type="button" class="btn btn-dark waves-effect waves-light"><i class="ti ti-notes"></i>&nbsp;&nbsp;Lihat</button>
                                        </div>
                                    </div>
                                </div>`
                    } else {
                        a += `<div class="col-md-3 col-xl-3 mb-3">
                                    <div class="card h-100 text-bg-info">
                                        <div class="card-header d-flex justify-content-between pb-2 mb-1">
                                            <div class="card-title mb-1">
                                                <h4 class="m-0 me-2 text-white">` + d.nama_meja + `</h4>
                                                <h4 class="pt-3 text-white">` + d.kondisi + `</h4>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                        <button type="button" class="btn btn-dark waves-effect waves-light"><i class="ti ti-notes"></i>&nbsp;&nbsp;Cetak QR Menu</button>
                                        </div>
                                    </div>
                                </div>`
                    }
                });
                $('#status_meja').html(a)
            }
        })
    }
</script>