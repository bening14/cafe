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
                            <div class="col-xl-6 mb-4 col-lg-6 col-12">
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
                                                    <a href="<?= base_url('customer/bisnis') ?>" class="btn btn-primary">Bisnis Anda</a>
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
                            <div class="card-header border-bottom" style="text-align: right;">
                                <button class="btn btn-sm btn-info" onclick="tambaho('<?= $id_mst_bisnis ?>')"><i class="ti ti-building-store"></i> Tambah Outlet</button>
                            </div>
                            <div class="card-datatable table-responsive">
                                <table id="table-outlet" class="table">
                                    <thead class="border-top">
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Outlet</th>
                                            <th>Lokasi</th>
                                            <th>Telephone</th>
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

    <!-- edit Outlet Modal -->
    <div class="modal fade" id="editoutlet" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-simple modal-edit-user modal-dialog-centered">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-4">
                        <h3 class="mb-2">Edit Outlet</h3>
                    </div>
                    <form id="form-data-outlet-edit" class="row g-3">
                        <div class="col-12 col-md-12">
                            <label class="form-label" for="nama_outlet_e">Nama Outlet</label>
                            <input type="text" id="nama_outlet_e" name="nama_outlet_e" class="form-control" placeholder="Misal : Outlet Cake" />
                            <input type="hidden" id="id_e" name="id_e" class="form-control" />
                        </div>
                        <div class="col-12 col-md-12">
                            <label class="form-label" for="lokasi_e">Lokasi</label>
                            <input type="text" id="lokasi_e" name="lokasi_e" class="form-control" placeholder="Misal : Jl. Pramuka No. 48 Malang" />
                        </div>
                        <div class="col-12 col-md-12">
                            <label class="form-label" for="phone_e">Phone</label>
                            <input type="text" id="phone_e" name="phone_e" class="form-control" placeholder="Misal : 0341-556677" />
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
        $("#table-outlet").DataTable({
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
                'url': '<?= base_url() ?>customer/ajax_table_outlet',
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
                    "data": "data.nama_outlet"
                }, {
                    "target": [<?= $target ?>],
                    "className": 'text-center py-1',
                    "data": "data.lokasi",
                }, {
                    "target": [<?= $target ?>],
                    "className": 'text-center py-1',
                    "data": "data.phone",
                },
                {
                    "target": [<?= $target ?>],
                    "className": 'py-1',
                    "data": "data",
                    "render": function(data) {
                        return `<div class="d-flex align-items-center">
                                    <a href="javascript:;" class="text-body" onclick="edito('` + data.id + `','` + data.nama_outlet + `','` + data.lokasi + `','` + data.phone + `')"><i class="ti ti-edit ti-sm me-2"></i></a>
                                    <a href="javascript:;" class="text-body delete-record" onclick="delete_data('` + data.id + `')"><i class="ti ti-trash ti-sm mx-2"></i></a>
                                    <a href="<?= base_url('customer/kelola_outlet/') ?>` + data.id + `" type="button" class="btn btn-sm btn-success waves-effect waves-light">Kelola Outlet</a>
                                    
                                </div>`
                    }
                }
            ],
            "dom": '<"row" <"col-md-6" l><"col-md-6" f>>rt<"row" <"col-md-6" i><"col-md-6" p>>',
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        });

    });

    function reload_table() {
        $('#table-outlet').DataTable().ajax.reload(null, false);
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
                    // Swal.fire({
                    //     position: 'top-end',
                    //     icon: 'success',
                    //     title: 'berhasil tambah data',
                    //     showConfirmButton: false,
                    //     timer: 1500,
                    //     customClass: {
                    //         confirmButton: 'btn btn-primary'
                    //     },
                    //     buttonsStyling: false
                    // })
                    $('#nama_outlet').val('')
                    $('#lokasi').val('')
                    $('#phone').val('')
                    $('#tambahoutlet').modal('hide');
                    reload_table()

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
        $('#tambahoutlet').modal('show')

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
                            table: "mst_outlet"
                        },
                        type: 'post',
                        dataType: 'json',
                        success: function(result) {
                            if (result.status == "success") {
                                // Swal.fire({
                                //     icon: 'success',
                                //     title: 'Terhapus!',
                                //     text: 'Data berhasil dihapus',
                                //     customClass: {
                                //         confirmButton: 'btn btn-success'
                                //     }
                                // });
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

    function edito(id, nama, kota, phone) {
        $('#editoutlet').modal('show')

        $('#id_e').val(id)
        $('#nama_outlet_e').val(nama)
        $('#lokasi_e').val(kota)
        $('#phone_e').val(phone)
    }

    $("#form-data-outlet-edit").submit(function(e) {
        e.preventDefault()

        if ($('#nama_outlet_e').val() == '' || $('#lokasi_e').val() == '' || $('#phone_e').val() == '') {
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
        form_data.append('id', $("#id_e").val());
        form_data.append('nama_outlet', $("#nama_outlet_e").val());
        form_data.append('lokasi', $("#lokasi_e").val());
        form_data.append('phone', $("#phone_e").val());
        form_data.append('kategori', 'edit');

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
                    // Swal.fire({
                    //     position: 'top-end',
                    //     icon: 'success',
                    //     title: 'berhasil ubah data',
                    //     showConfirmButton: false,
                    //     timer: 1500,
                    //     customClass: {
                    //         confirmButton: 'btn btn-primary'
                    //     },
                    //     buttonsStyling: false
                    // })
                    $('#editoutlet').modal('hide');
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
</script>