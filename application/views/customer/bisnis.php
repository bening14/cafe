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
                        <div class="row g-4 mb-4">
                            <div class="col-xl-4 mb-4 col-lg-5 col-12">
                                <div class="card">
                                    <div class="d-flex align-items-end row">
                                        <?php
                                        if ($kode_bisnis != '') {
                                        ?>
                                            <div class="col-7">
                                                <div class="card-body text-nowrap">
                                                    <h5 class=" card-title mb-0 text-muted">Nama Bisnis</h5>
                                                    <h3 class="mt-2 mb-0"><?= $nama_bisnis ?></h3>
                                                    <h5 class="text mb-3"><?= $kode_bisnis ?></h5>
                                                    <a href="<?= base_url('customer/bisnis') ?>" class="btn btn-primary">Lihat Bisnis</a>
                                                </div>
                                            </div>
                                        <?php
                                        } else {
                                        ?>
                                            <div class="col-7">
                                                <div class="card-body text-nowrap">
                                                    <h5 class="card-title mb-0">Nama Bisnis</h5>
                                                    <p class="mb-2">Anda belum memiliki Nama Bisnis</p>
                                                    <h3 class="text mb-3">-</h3>
                                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahbisnis">Buat Nama Bisnis</button>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                        <div class="col-5 text-center text-sm-left">
                                            <div class="card-body pb-0 px-0 px-md-4 mb-2">
                                                <img src="<?= base_url('assets/template-admin/') ?>assets/img/illustrations/girl-with-laptop.png" height="140" alt="view sales">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Users List Table -->
                        <div class="card">
                            <!-- <div class="card-header border-bottom">
                                <h5 class="card-title mb-3">Search Filter</h5>
                                <div class="d-flex justify-content-between align-items-center row pb-2 gap-3 gap-md-0">
                                    <div class="col-md-4 user_role"></div>
                                    <div class="col-md-4 user_plan"></div>
                                    <div class="col-md-4 user_status"></div>
                                </div>
                            </div> -->
                            <div class="card-datatable table-responsive">
                                <table id="table-bisnis" class="table">
                                    <thead class="border-top">
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Bisnis</th>
                                            <th>Kota Bisnis</th>
                                            <th>Telephone</th>
                                            <th>Pajak</th>
                                            <th>Outlet</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                </table>
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

    <!-- Tambah Bisnis Modal -->
    <div class="modal fade" id="tambahbisnis" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-simple modal-edit-user modal-dialog-centered">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-4">
                        <h3 class="mb-2">Tambah Bisnis Anda</h3>
                    </div>
                    <form id="form-data" class="row g-3">
                        <div class="col-12 col-md-12">
                            <label class="form-label" for="nama_bisnis">Nama Bisnis</label>
                            <input type="text" id="nama_bisnis" name="nama_bisnis" class="form-control" placeholder="Misal : Cafe Keren" />
                        </div>
                        <div class="col-12 col-md-12">
                            <label class="form-label" for="kota_bisnis">Kota Bisnis</label>
                            <input type="text" id="kota_bisnis" name="kota_bisnis" class="form-control" placeholder="Misal : Surabaya" />
                        </div>
                        <div class="col-12 col-md-12">
                            <label class="form-label" for="telephone">Telephone</label>
                            <input type="text" id="telephone" name="telephone" class="form-control" />
                        </div>
                        <div class="col-12 col-md-12">
                            <label class="form-label" for="pajak">Pajak</label>
                            <select id="pajak" name="pajak" class="form-select" aria-label="Default select example">
                                <option value="Tidak">Tidak</option>
                                <option value="Ya">Ya</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-12" style="display: none;" id="ppn">
                            <div class="row">
                                <div class="col-10 col-md-10">
                                    <label class="form-label" for="nilai_ppn">PPN (%)</label>
                                    <input type="text" id="nilai_ppn" name="nilai_ppn" class="form-control" placeholder="Misal : 11" />
                                </div>
                                <div class="col-2 col-md-2">
                                    <h3 class="mt-4">%</h3>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary me-sm-3 me-1">Daftarkan</button>
                            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--/ Tambah Bisnis Modal -->

    <!-- Edit Bisnis Modal -->
    <div class="modal fade" id="editbisnis" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-simple modal-edit-user modal-dialog-centered">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-4">
                        <h3 class="mb-2">Edit Bisnis Anda</h3>
                    </div>
                    <form id="form-data-edit" class="row g-3">
                        <div class="col-12 col-md-12">
                            <label class="form-label" for="nama_bisnis_e">Nama Bisnis</label>
                            <input type="hidden" id="id_e" name="id_e" class="form-control" />
                            <input type="text" id="nama_bisnis_e" name="nama_bisnis_e" class="form-control" placeholder="Misal : Cafe Keren" />
                        </div>
                        <div class="col-12 col-md-12">
                            <label class="form-label" for="kota_bisnis_e">Kota Bisnis</label>
                            <input type="text" id="kota_bisnis_e" name="kota_bisnis_e" class="form-control" placeholder="Misal : Surabaya" />
                        </div>
                        <div class="col-12 col-md-12">
                            <label class="form-label" for="telephone_e">Telephone</label>
                            <input type="text" id="telephone_e" name="telephone_e" class="form-control" />
                        </div>
                        <div class="col-12 col-md-12">
                            <label class="form-label" for="pajak_e">Pajak</label>
                            <select id="pajak_e" name="pajak_e" class="form-select" aria-label="Default select example">
                                <option value="Tidak">Tidak</option>
                                <option value="Ya">Ya</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-12" style="display: none;" id="ppn_e">
                            <div class="row">
                                <div class="col-10 col-md-10">
                                    <label class="form-label" for="nilai_ppn_e">PPN (%)</label>
                                    <input type="text" id="nilai_ppn_e" name="nilai_ppn_e" class="form-control" placeholder="Misal : 11" />
                                </div>
                                <div class="col-2 col-md-2">
                                    <h3 class="mt-4">%</h3>
                                </div>
                            </div>
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
    <!--/ Edit Bisnis Modal -->

    <!-- Tambah Outlet Modal -->
    <div class="modal fade" id="tambahoutlet" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-simple modal-edit-user modal-dialog-centered">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-4">
                        <h3 class="mb-2">Tambah Outlet</h3>
                    </div>
                    <form id="form-data-outlet" class="row g-3">
                        <div class="col-12 col-md-12">
                            <label class="form-label" for="nama_outlet">Nama Outlet</label>
                            <input type="text" id="nama_outlet" name="nama_outlet" class="form-control" placeholder="Misal : Outlet Cake" />
                            <input type="hidden" id="id_mst_bisnis" name="id_mst_bisnis" class="form-control" />
                        </div>
                        <div class="col-12 col-md-12">
                            <label class="form-label" for="lokasi">Lokasi</label>
                            <input type="text" id="lokasi" name="lokasi" class="form-control" placeholder="Misal : Jl. Pramuka No. 48 Malang" />
                        </div>
                        <div class="col-12 col-md-12">
                            <label class="form-label" for="phone">Phone</label>
                            <input type="text" id="phone" name="phone" class="form-control" placeholder="Misal : 0341-556677" />
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
    <!--/ Tambah Outlet Modal -->

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
        $("#table-bisnis").DataTable({
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
                'url': '<?= base_url() ?>customer/ajax_table_bisnis',
                'type': 'post'
            },
            'columns': [{
                    "target": [<?= $target ?>],
                    "className": 'text-center py-1',
                    "data": "data.no",
                }, {
                    "target": [<?= $target ?>],
                    "className": 'py-1',
                    "data": "data",
                    "render": function(data) {
                        return `
                        <div class="d-flex justify-content-start align-items-center user-name">
                            <div class="avatar-wrapper">
                                <div class="avatar me-3">
                                    <img src="<?= base_url('assets/template-admin/assets/img/avatars/') ?>` + data.logo + `" alt="Logo Bisnis" class="rounded-circle">
                                </div>
                            </div>
                            <div class="d-flex flex-column">
                                    <span class="fw-medium">` + data.nama_bisnis + `</span>
                                <small class="text-muted">` + data.kode_bisnis + `</small>
                            </div>
                        </div>`
                    }
                }, {
                    "target": [<?= $target ?>],
                    "className": 'text-center py-1',
                    "data": "data.kota_bisnis"
                }, {
                    "target": [<?= $target ?>],
                    "className": 'text-center py-1',
                    "data": "data.telephone",
                }, {
                    "target": [<?= $target ?>],
                    "className": 'py-1',
                    "data": "data",
                    "render": function(data) {
                        if (data.pajak == 'Ya') {
                            return `<span class="badge rounded-pill bg-label-info">Ya</span>`
                        } else if (data.pajak == 'Tidak') {
                            return `<span class="badge rounded-pill bg-label-primary">Tidak</span>`
                        }
                    }
                },
                {
                    "target": [<?= $target ?>],
                    "className": 'text-center py-1',
                    "data": "data",
                    "render": function(data) {
                        if (data.outlet == 'Belum ada outlet') {
                            return `<span>Belum ada outlet</span>&nbsp;&nbsp;<button class="btn btn-primary btn-sm" onclick="tambaho('` + data.id + `')">Tambah</button>`
                        } else {
                            return `<a href="<?= base_url('customer/outlet') ?>" class="btn btn-success btn-sm">lihat Outlet</a>`
                        }
                    }
                },
                {
                    "target": [<?= $target ?>],
                    "className": 'py-1',
                    "data": "data",
                    "render": function(data) {
                        return `<div class="d-flex align-items-center">
                                    <a href="javascript:;" class="text-body" onclick="editb('` + data.id + `','` + data.nama_bisnis + `','` + data.kota_bisnis + `','` + data.telephone + `','` + data.pajak + `','` + data.ppn + `')"><i class="ti ti-edit ti-sm me-2"></i></a>
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
        $('#table-bisnis').DataTable().ajax.reload(null, false);
    }

    $('#pajak').on('change', function() {
        if ($('#pajak').val() == 'Ya') {
            $('#ppn').show();
        } else {
            $('#ppn').hide();
            $('#nilai_ppn').val('')
        }
    })
    $('#pajak_e').on('change', function() {
        if ($('#pajak_e').val() == 'Ya') {
            $('#ppn_e').show();
        } else {
            $('#ppn_e').hide();
            $('#nilai_ppn_e').val('')
        }
    })

    $("#form-data").submit(function(e) {
        e.preventDefault()

        if ($('#nama_bisnis').val() == '' || $('#kota_bisnis').val() == '' || $('#telephone').val() == '') {
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
        form_data.append('table', 'mst_bisnis');
        form_data.append('nama_bisnis', $("#nama_bisnis").val());
        form_data.append('kota_bisnis', $("#kota_bisnis").val());
        form_data.append('telephone', $("#telephone").val());
        form_data.append('pajak', $("#pajak").val());
        form_data.append('ppn', $("#nilai_ppn").val());
        form_data.append('kategori', 'tambah');

        var url_ajax = '<?= base_url() ?>customer/insert_data_bisnis'

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
                    $('#nama_bisnis').val('')
                    $('#kota_bisnis').val('')
                    $('#telephone').val('')
                    $('#pajak').val('')
                    $('#nilai_ppn').val('')
                    $('#tambahbisnis').modal('hide');
                    reload_table()
                    location.reload()

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

    function editb(id, nama, kota_bisnis, telephone, pajak, ppn) {
        $('#editbisnis').modal('show')

        $('#id_e').val(id)
        $('#nama_bisnis_e').val(nama)
        $('#kota_bisnis_e').val(kota_bisnis)
        $('#telephone_e').val(telephone)
        $('#ppn_e').val(pajak)
        // $('#nilai_ppn_e').val(ppn)
    }

    $("#form-data-edit").submit(function(e) {
        e.preventDefault()

        if ($('#nama_bisnis_e').val() == '' || $('#kota_bisnis_e').val() == '' || $('#telephone_e').val() == '') {
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
        form_data.append('table', 'mst_bisnis');
        form_data.append('id', $("#id_e").val());
        form_data.append('nama_bisnis', $("#nama_bisnis_e").val());
        form_data.append('kota_bisnis', $("#kota_bisnis_e").val());
        form_data.append('telephone', $("#telephone_e").val());
        form_data.append('pajak', $("#pajak_e").val());
        form_data.append('ppn', $("#nilai_ppn_e").val());
        form_data.append('kategori', 'edit');

        var url_ajax = '<?= base_url() ?>customer/insert_data_bisnis'

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
                    $('#editbisnis').modal('hide');
                    reload_table()

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

    function tambaho(id) {
        $('#tambahoutlet').modal('show')

        $('#id_mst_bisnis').val(id)
    }

    $("#form-data-outlet").submit(function(e) {
        e.preventDefault()

        if ($('#nama_outlet').val() == '' || $('#lokasi').val() == '' || $('#phone').val() == '') {
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
        form_data.append('table', 'mst_outlet');
        form_data.append('nama_outlet', $("#nama_outlet").val());
        form_data.append('id_mst_bisnis', $("#id_mst_bisnis").val());
        form_data.append('lokasi', $("#lokasi").val());
        form_data.append('phone', $("#phone").val());
        form_data.append('kategori', 'tambah');

        var url_ajax = '<?= base_url() ?>customer/insert_data_outlet'

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
                    $('#nama_outlet').val('')
                    $('#lokasi').val('')
                    $('#phone').val('')
                    $('#tambahoutlet').modal('hide');
                    reload_table()
                    window.location.replace("<?= base_url('customer/outlet') ?>");

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

    function delete_data(id) {
        Swal.fire({
            title: 'Apakah Anda Yakin ?',
            text: "Dengan menghapus Nama Bisnis, Data Outlet (jika ada) otomatis juga akan terhapus!",
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
                            table: "mst_bisnis"
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
</script>