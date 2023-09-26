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
                                                <select name="outlet" id="outlet" class="form-control">
                                                    <option value="Outlet">Cabang Malang</option>
                                                    <option value="Outlet">Cabang Surabaya</option>
                                                    <option value="Outlet">Cabang Bojonegoro</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Users List Table -->
                        <div class="col-md-12 col-xl-12 col-xl-12 mb-4">
                            <div class="row">
                                <div class="col-md-3 col-xl-3 mb-3">
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

    <!-- Tambah Pelanggan Modal -->
    <div class="modal fade" id="tambahpelanggan" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-simple modal-edit-user modal-dialog-centered modal-lg">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-4">
                        <h3 class="mb-2">Tambah Pelanggan</h3>
                    </div>
                    <form id="form-data" class="row g-3">
                        <div class="col-12 col-md-12">
                            <label class="form-label" for="nama">Nama Lengkap</label>
                            <input type="text" id="nama" name="nama" class="form-control" placeholder="Misal : Budi Waluyo" />
                        </div>
                        <div class="col-12 col-md-12">
                            <label class="form-label" for="jenis_kelamin">Jenis Kelamin</label>
                            <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-12">
                            <label class="form-label" for="telephone">Telephone</label>
                            <input type="text" id="telephone" name="telephone" class="form-control" placeholder="Contoh : 0817-9090-7856" />
                        </div>
                        <div class="col-12 col-md-12">
                            <label class="form-label" for="email">Email</label>
                            <input type="text" id="email" name="email" class="form-control" placeholder="Contoh : budi@gmail.com" />
                        </div>
                        <div class="col-12 col-md-12">
                            <label class="form-label" for="alamat">Alamat</label>
                            <input type="text" id="alamat" name="alamat" class="form-control" placeholder="Contoh : Jl. Perusahaan Gg.5 Surabaya" />
                        </div>
                        <div class="col-12 col-md-12">
                            <label class="form-label" for="catatan">Catatan</label>
                            <input type="text" id="catatan" name="catatan" class="form-control" />
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
    <!--/ Tambah Pelanggan Modal -->

    <!-- edit pelanggan Modal -->
    <div class="modal fade" id="editpelanggan" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-simple modal-edit-user modal-dialog-centered modal-lg">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-4">
                        <h3 class="mb-2">Edit Pelanggan</h3>
                    </div>
                    <form id="form-data-edit" class="row g-3">
                        <div class="col-12 col-md-12">
                            <label class="form-label" for="nama_e">Nama Lengkap</label>
                            <input type="text" id="nama_e" name="nama_e" class="form-control" placeholder="Misal : Budi Waluyo" />
                            <input type="hidden" id="id_e" name="id_e" class="form-control" />
                        </div>
                        <div class="col-12 col-md-12">
                            <label class="form-label" for="jenis_kelamin_e">Jenis Kelamin</label>
                            <select name="jenis_kelamin_e" id="jenis_kelamin_e" class="form-control">
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-12">
                            <label class="form-label" for="telephone_e">Telephone</label>
                            <input type="text" id="telephone_e" name="telephone_e" class="form-control" placeholder="Contoh : 0817-9090-7856" />
                        </div>
                        <div class="col-12 col-md-12">
                            <label class="form-label" for="email_e">Email</label>
                            <input type="text" id="email_e" name="email_e" class="form-control" placeholder="Contoh : budi@gmail.com" />
                        </div>
                        <div class="col-12 col-md-12">
                            <label class="form-label" for="alamat_e">Alamat</label>
                            <input type="text" id="alamat_e" name="alamat_e" class="form-control" placeholder="Contoh : Jl. Perusahaan Gg.5 Surabaya" />
                        </div>
                        <div class="col-12 col-md-12">
                            <label class="form-label" for="catatan_e">Catatan</label>
                            <input type="text" id="catatan_e" name="catatan_e" class="form-control" />
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
    <!--/ edit pelanggan Modal -->

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
        $("#table-pelanggan").DataTable({
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
                'url': '<?= base_url() ?>customer/ajax_table_pelanggan',
                'type': 'post'
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
                        return `<h5 class="mb-0">` + data.nama + `</h5><span>` + data.kode_pelanggan + `</span>`
                    }
                }, {
                    "target": [<?= $target ?>],
                    "className": 'text-center py-1',
                    "data": "data.jenis_kelamin",
                }, {
                    "target": [<?= $target ?>],
                    "className": 'text-center py-1',
                    "data": "data.telephone",
                }, {
                    "target": [<?= $target ?>],
                    "className": 'text-center py-1',
                    "data": "data.email",
                }, {
                    "target": [<?= $target ?>],
                    "className": 'text-center py-1',
                    "data": "data.alamat",
                }, {
                    "target": [<?= $target ?>],
                    "className": 'text-center py-1',
                    "data": "data.catatan",
                },
                {
                    "target": [<?= $target ?>],
                    "className": 'py-1',
                    "data": "data",
                    "render": function(data) {
                        return `<div class="d-flex align-items-center">
                                    <a href="javascript:;" class="text-body" onclick="edito('` + data.id + `','` + data.nama + `','` + data.telephone + `','` + data.email + `','` + data.alamat + `','` + data.catatan + `')"><i class="ti ti-edit ti-sm me-2"></i></a>
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
        $('#table-pelanggan').DataTable().ajax.reload(null, false);
    }

    $("#form-data").submit(function(e) {
        e.preventDefault()

        if ($('#nama').val() == '' || $('#jenis_kelamin').val() == '' || $('#telephone').val() == '' || $('#email').val() == '' || $('#alamat').val() == '' || $('#catatan').val() == '') {
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
        form_data.append('table', 'tbl_pelanggan');
        form_data.append('nama', $("#nama").val());
        form_data.append('jenis_kelamin', $("#jenis_kelamin").val());
        form_data.append('telephone', $("#telephone").val());
        form_data.append('email', $("#email").val());
        form_data.append('alamat', $("#alamat").val());
        form_data.append('catatan', $("#catatan").val());
        form_data.append('kategori', 'tambah');

        var url_ajax = '<?= base_url() ?>customer/insert_data_pelanggan'

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
                    $('#nama').val('')
                    $('#telephone').val('')
                    $('#email').val('')
                    $('#alamat').val('')
                    $('#catatan').val('')
                    $('#tambahpelanggan').modal('hide');
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


    function tambaho() {
        $('#tambahpelanggan').modal('show')
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
                            table: "tbl_pelanggan"
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

    function edito(id, nama, telephone, email, alamat, catatan) {
        $('#editpelanggan').modal('show')

        $('#id_e').val(id)
        $('#nama_e').val(nama)
        $('#telephone_e').val(telephone)
        $('#email_e').val(email)
        $('#alamat_e').val(alamat)
        $('#catatan_e').val(catatan)
    }

    $("#form-data-edit").submit(function(e) {
        e.preventDefault()

        if ($('#nama_e').val() == '' || $('#telephone_e').val() == '' || $('#email_e').val() == '' || $('#alamat_e').val() == '' || $('#catatan_e').val() == '') {
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
        form_data.append('table', 'tbl_pelanggan');
        form_data.append('id', $("#id_e").val());
        form_data.append('nama', $("#nama_e").val());
        form_data.append('jenis_kelamin', $("#jenis_kelamin_e").val());
        form_data.append('telephone', $("#telephone_e").val());
        form_data.append('email', $("#email_e").val());
        form_data.append('alamat', $("#alamat_e").val());
        form_data.append('catatan', $("#catatan_e").val());
        form_data.append('kategori', 'edit');

        var url_ajax = '<?= base_url() ?>customer/insert_data_pelanggan'

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
                    $('#editpelanggan').modal('hide');
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