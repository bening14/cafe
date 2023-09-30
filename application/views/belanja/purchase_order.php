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
                        <div class="card">
                            <div class="card-header">
                                <h5>Purchase Order</h5>
                                <div class="row">
                                    <div class="col-2 col-md-2">
                                        <label class="form-label" for="outlet">Outlet</label>
                                        <select name="outlet" id="outlet" class="form-control">
                                            <?php
                                            foreach ($outlet as $key => $val) {
                                            ?>
                                                <option value="<?= $val['id'] . '-' . $val['nama_outlet'] ?>"> <?= $val['nama_outlet'] ?> </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-2 col-md-2">
                                        <label class="form-label" for="supplier">Supplier</label>
                                        <select name="supplier" id="supplier" class="form-control">
                                            <option value="SEMUA">SEMUA</option>
                                            <?php
                                            foreach ($supplier as $key => $val) {
                                            ?>
                                                <option value="<?= $val['kode_supplier'] ?>"> <?= $val['nama_supplier'] ?> </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-2 col-md-2">
                                        <label class="form-label" for="dari_tanggal">Dari Tanggal</label>
                                        <input type="date" id="dari_tanggal" name="dari_tanggal" class="form-control" />
                                    </div>
                                    <div class="col-2 col-md-2">
                                        <label class="form-label" for="sampai_tanggal">Sampai Tanggal</label>
                                        <input type="date" id="sampai_tanggal" name="sampai_tanggal" class="form-control" />
                                    </div>
                                    <div class="col-1 col-md-1">
                                        <label class="form-label" for="status_po">Status PO</label>
                                        <select name="status_po" id="status_po" class="form-control">
                                            <option value="SEMUA">SEMUA</option>
                                            <option value="Dipesan">Dipesan</option>
                                            <option value="Dibatalkan">Dibatalkan</option>
                                        </select>
                                    </div>
                                    <div class="col-2 col-md-2">
                                        <label class="form-label" for="nomor_po">Nomor PO</label>
                                        <input type="text" id="nomor_po" name="nomor_po" class="form-control" />
                                    </div>
                                    <div class="col-1 col-md-1">
                                        <!-- <button type="button" class="btn btn-info waves-effect waves-light mt-4" onclick="cari()"><i class="ti ti-search"></i> Cari</button> -->
                                        <button class="btn btn-info waves-effect waves-light mt-4" onclick="terapkanfilter()"> Terapkan</button>
                                        <a class="btn btn-success waves-effect waves-light mt-4 text-white" id="btn_download_excel"><i class="ti ti-file-spreadsheet"></i> Export</a>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="card mt-3">

                            <div class="card-datatable table-responsive">
                                <table id="table-po" class="table">
                                    <thead class="border-top">
                                        <tr>
                                            <th>#</th>
                                            <th>ID Purchase Order</th>
                                            <th>Supplier</th>
                                            <th>Nomor PO</th>
                                            <th>Tanggal</th>
                                            <th>Status</th>
                                            <th>Action</th>
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

    <!-- Tambah kategori Modal -->
    <div class="modal fade" id="modalpodetail" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h5 class="modal-title" id="exampleModalLabel4">Purchase Order : </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3" id="info_kode">
                            PO/SCM/1000/1
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-1 mb-3">
                            <h5 for="nameExLarge" class="form-label">Outlet</h5>
                            <h5 for="nameExLarge" class="form-label">Tanggal</h5>
                            <h5 for="nameExLarge" class="form-label">Supplier</h5>
                            <h5 for="nameExLarge" class="form-label">Catatan</h5>
                        </div>
                        <div class="col-8 mb-3" id="info_outlet">
                            <h5 for="nameExLarge" class="form-label">: -</h5>
                            <h5 for="nameExLarge" class="form-label">: -</h5>
                            <h5 for="nameExLarge" class="form-label">: -</h5>
                            <h5 for="nameExLarge" class="form-label">: -</h5>
                        </div>
                    </div>
                    <div class="row g-2">
                        <table id="table-po-detail" class="table">
                            <thead class="border-top">
                                <tr>
                                    <th>#</th>
                                    <th>Produk</th>
                                    <th>Jumlah</th>
                                    <th>Satuan</th>
                                    <th>Harga Beli/Unit</th>
                                    <th>Total Harga Beli</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ Tambah kategori Modal -->




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

    function terapkanfilter() {
        $("#table-po").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            'serverSide': true,
            'processing': true,
            'searching': true,
            "bDestroy": true,
            "order": [
                [0, "desc"]
            ],
            'ajax': {
                'dataType': 'json',
                'url': '<?= base_url() ?>belanja/ajax_table_po',
                'type': 'post',
                'data': {
                    outlet: $('#outlet').val(),
                    supplier: $('#supplier').val(),
                    dari_tanggal: $('#dari_tanggal').val(),
                    sampai_tanggal: $('#sampai_tanggal').val(),
                    status_po: $('#status_po').val(),
                    nomor_po: $('#nomor_po').val(),
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
                "data": "data.kode_trx",
            }, {
                "target": [<?= $target ?>],
                "className": 'text-center py-1',
                "data": "data.nama_supplier",
            }, {
                "target": [<?= $target ?>],
                "className": 'text-center py-1',
                "data": "data.nomor_po",
            }, {
                "target": [<?= $target ?>],
                "className": 'text-center py-1',
                "data": "data.tanggal",
            }, {
                "target": [<?= $target ?>],
                "className": 'text-center py-1',
                "data": "data",
                "render": function(data) {
                    if (data.status_po == 'Dipesan') {
                        return `<span class="badge rounded-pill bg-label-success">Dipesan</span>`
                    } else {
                        return `<span class="badge rounded-pill bg-label-danger">Dibatalkan</span>`
                    }
                }
            }, {
                "target": [<?= $target ?>],
                "className": 'py-1',
                "data": "data",
                "render": function(data) {
                    return `<div class="d-flex align-items-center">
                                 <button type="button" class="btn btn-info btn-sm waves-effect waves-light text-white" id="btn_detail" onclick="detailpo('` + data.kode_trx + `')"><i class="ti ti-info-circle"></i> Detail</button>
                            </div>`
                }
            }],
            "dom": '<"row" <"col-md-6" l><"col-md-6" f>>rt<"row" <"col-md-6" i><"col-md-6" p>>',
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        });
    }

    $('#btn_download_excel').on('click', function() {

        if ($('#nomor_po').val() == '') {
            if ($('#outlet').val() == '' || $('#supplier').val() == '' || $('#dari_tanggal').val() == '' || $('#sampai_tanggal').val() == '' || $('#status_po').val() == '') {
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

            var outlet = $("#outlet").val();
            var supplier = $("#supplier").val();
            var dari_tanggal = $("#dari_tanggal").val();
            var sampai_tanggal = $("#sampai_tanggal").val();
            var status_po = $("#status_po").val();
            var nomor_po = '';
            var id_mst_bisnis = '<?= $id_mst_bisnis ?>';
        } else {
            var outlet = '';
            var supplier = '';
            var dari_tanggal = '';
            var sampai_tanggal = '';
            var status_po = '';
            var nomor_po = $("#nomor_po").val();
            var id_mst_bisnis = '<?= $id_mst_bisnis ?>';

        }





        $("#btn_download_excel").attr("href", "<?= base_url('belanja/generatedatapo') ?>?outlet=" + outlet + "&supplier=" + supplier + "&dari_tanggal=" + dari_tanggal + "&sampai_tanggal=" + sampai_tanggal + "&status_po=" + status_po + "&nomor_po=" + nomor_po + "&id_mst_bisnis=" + id_mst_bisnis)
    });

    function detailpo(kode) {
        $('#modalpodetail').modal('show')
        //ambil data transaksi
        $.ajax({
            url: '<?= base_url() ?>belanja/getdata',
            data: {
                kode_trx: kode,
                table: "tbl_purchase_order"
            },
            type: 'post',
            dataType: 'json',
            success: function(result) {
                console.log(result)
                var a = `    <h5 for="nameExLarge" class="form-label">: ` + result.nama_outlet + `</h5>
                                 <h5 for="nameExLarge" class="form-label">: ` + result.tanggal + `</h5>
                                 <h5 for="nameExLarge" class="form-label">: ` + result.nama_supplier + `</h5>
                                 <h5 for="nameExLarge" class="form-label">: ` + result.catatan + `</h5>`

                var b = result.nomor_po

                $('#info_outlet').html(a)
                $('#info_kode').html(b)
            }
        })

        //datatable
        $("#table-po-detail").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            'serverSide': true,
            'processing': true,
            'searching': true,
            "bDestroy": true,
            "order": [
                [0, "desc"]
            ],
            'ajax': {
                'dataType': 'json',
                'url': '<?= base_url() ?>belanja/ajax_table_po_detail',
                'type': 'post',
                'data': {
                    kode: kode
                }
            },
            'columns': [{
                "target": [<?= $target ?>],
                "className": 'text-center py-1',
                "data": "data.no",
            }, {
                "target": [<?= $target ?>],
                "className": 'text-left py-1',
                "data": "data.nama_produk",
            }, {
                "target": [<?= $target ?>],
                "className": 'text-center py-1',
                "data": "data.jumlah",
            }, {
                "target": [<?= $target ?>],
                "className": 'text-center py-1',
                "data": "data.satuan",
            }, {
                "target": [<?= $target ?>],
                "className": 'text-center py-1',
                "data": "data.harga_beli_satuan",
            }, {
                "target": [<?= $target ?>],
                "className": 'text-center py-1',
                "data": "data.harga_beli_total",
            }],
            "dom": '<"row" <"col-md-6" l><"col-md-6" f>>rt<"row" <"col-md-6" i><"col-md-6" p>>',
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        });
    }
</script>