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
                            <div class="col-sm-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-start justify-content-between">
                                            <div class="content-left">
                                                <span>Session</span>
                                                <div class="d-flex align-items-center my-2">
                                                    <h3 class="mb-0 me-2">21,459</h3>
                                                    <p class="text-success mb-0">(+29%)</p>
                                                </div>
                                                <p class="mb-0">Total Users</p>
                                            </div>
                                            <div class="avatar">
                                                <span class="avatar-initial rounded bg-label-primary">
                                                    <i class="ti ti-user ti-sm"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-start justify-content-between">
                                            <div class="content-left">
                                                <span>Paid Users</span>
                                                <div class="d-flex align-items-center my-2">
                                                    <h3 class="mb-0 me-2">4,567</h3>
                                                    <p class="text-success mb-0">(+18%)</p>
                                                </div>
                                                <p class="mb-0">Last week analytics</p>
                                            </div>
                                            <div class="avatar">
                                                <span class="avatar-initial rounded bg-label-danger">
                                                    <i class="ti ti-user-plus ti-sm"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-start justify-content-between">
                                            <div class="content-left">
                                                <span>Active Users</span>
                                                <div class="d-flex align-items-center my-2">
                                                    <h3 class="mb-0 me-2">19,860</h3>
                                                    <p class="text-danger mb-0">(-14%)</p>
                                                </div>
                                                <p class="mb-0">Last week analytics</p>
                                            </div>
                                            <div class="avatar">
                                                <span class="avatar-initial rounded bg-label-success">
                                                    <i class="ti ti-user-check ti-sm"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-start justify-content-between">
                                            <div class="content-left">
                                                <span>Pending Users</span>
                                                <div class="d-flex align-items-center my-2">
                                                    <h3 class="mb-0 me-2">237</h3>
                                                    <p class="text-success mb-0">(+42%)</p>
                                                </div>
                                                <p class="mb-0">Last week analytics</p>
                                            </div>
                                            <div class="avatar">
                                                <span class="avatar-initial rounded bg-label-warning">
                                                    <i class="ti ti-user-exclamation ti-sm"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Users List Table -->
                        <div class="card">
                            <div class="card-header border-bottom">
                                <h5 class="card-title mb-3">Search Filter</h5>
                                <div class="d-flex justify-content-between align-items-center row pb-2 gap-3 gap-md-0">
                                    <div class="col-md-4 user_role"></div>
                                    <div class="col-md-4 user_plan"></div>
                                    <div class="col-md-4 user_status"></div>
                                </div>
                            </div>
                            <div class="card-datatable table-responsive">
                                <table id="table-user" class="table">
                                    <thead class="border-top">
                                        <tr>
                                            <th>#</th>
                                            <th>User</th>
                                            <th>Brand</th>
                                            <th>Jml. Cabang</th>
                                            <th>Member</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <!-- Offcanvas to add new user -->
                            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddUser" aria-labelledby="offcanvasAddUserLabel">
                                <div class="offcanvas-header">
                                    <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Add User</h5>
                                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                </div>
                                <div class="offcanvas-body mx-0 flex-grow-0 pt-0 h-100">
                                    <form class="add-new-user pt-0" id="addNewUserForm" onsubmit="return false">
                                        <div class="mb-3">
                                            <label class="form-label" for="add-user-fullname">Full Name</label>
                                            <input type="text" class="form-control" id="add-user-fullname" placeholder="John Doe" name="userFullname" aria-label="John Doe" />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="add-user-email">Email</label>
                                            <input type="text" id="add-user-email" class="form-control" placeholder="john.doe@example.com" aria-label="john.doe@example.com" name="userEmail" />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="add-user-contact">Contact</label>
                                            <input type="text" id="add-user-contact" class="form-control phone-mask" placeholder="+1 (609) 988-44-11" aria-label="john.doe@example.com" name="userContact" />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="add-user-company">Company</label>
                                            <input type="text" id="add-user-company" class="form-control" placeholder="Web Developer" aria-label="jdoe1" name="companyName" />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="country">Country</label>
                                            <select id="country" class="select2 form-select">
                                                <option value="">Select</option>
                                                <option value="Australia">Australia</option>
                                                <option value="Bangladesh">Bangladesh</option>
                                                <option value="Belarus">Belarus</option>
                                                <option value="Brazil">Brazil</option>
                                                <option value="Canada">Canada</option>
                                                <option value="China">China</option>
                                                <option value="France">France</option>
                                                <option value="Germany">Germany</option>
                                                <option value="India">India</option>
                                                <option value="Indonesia">Indonesia</option>
                                                <option value="Israel">Israel</option>
                                                <option value="Italy">Italy</option>
                                                <option value="Japan">Japan</option>
                                                <option value="Korea">Korea, Republic of</option>
                                                <option value="Mexico">Mexico</option>
                                                <option value="Philippines">Philippines</option>
                                                <option value="Russia">Russian Federation</option>
                                                <option value="South Africa">South Africa</option>
                                                <option value="Thailand">Thailand</option>
                                                <option value="Turkey">Turkey</option>
                                                <option value="Ukraine">Ukraine</option>
                                                <option value="United Arab Emirates">United Arab Emirates</option>
                                                <option value="United Kingdom">United Kingdom</option>
                                                <option value="United States">United States</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="user-role">User Role</label>
                                            <select id="user-role" class="form-select">
                                                <option value="subscriber">Subscriber</option>
                                                <option value="editor">Editor</option>
                                                <option value="maintainer">Maintainer</option>
                                                <option value="author">Author</option>
                                                <option value="admin">Admin</option>
                                            </select>
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label" for="user-plan">Select Plan</label>
                                            <select id="user-plan" class="form-select">
                                                <option value="basic">Basic</option>
                                                <option value="enterprise">Enterprise</option>
                                                <option value="company">Company</option>
                                                <option value="team">Team</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Submit</button>
                                        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancel</button>
                                    </form>
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

    <!-- Enable OTP Modal -->
    <div class="modal fade" id="modalBrand" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-simple modal-enable-otp modal-dialog-centered">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-4">
                        <img src="<?= base_url('assets/template-admin/') ?>assets/img/\illustrations/wizard-create-deal-confirm.png" alt="picture-hello">
                        <h3 class="mb-2">Halo <?= $this->session->userdata('nama') ?>, Selamat datang di Solusicafe, Aplikasi Manajemen Cafe atau Resto Gratis untuk #UMKM Indonesia</h3>

                    </div>
                    <p class="text-center mb-3">Sebelum memulai, kamu harus mendaftarkan Brand atau Bisnis kamu terlebih dahulu.</p>
                    <div class="d-grid gap-2">
                        <a href="<?= base_url('customer/bisnis') ?>" class="btn btn-primary" type="button">Daftarkan Brand atau Bisnis Saya</a>
                    </div>
                    <!-- <form id="addProductForm" class="row g-3" onsubmit="return false">
                        <div class="col-12">
                            <label class="form-label" for="modaladdProduct">Phone Number</label>
                            <div class="input-group">
                                <span class="input-group-text">US (+1)</span>
                                <input type="text" id="modaladdProduct" name="modaladdProduct" class="form-control phone-number-otp-mask" placeholder="202 555 0111" />
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary me-sm-3 me-1">Daftarkan Branda atau Bisnis Saya</button>
                        </div>
                    </form> -->
                </div>
            </div>
        </div>
    </div>
    <!--/ Enable OTP Modal -->

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

    <!-- Main JS -->
    <script src="<?= base_url('assets/template-admin/') ?>assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="<?= base_url('assets/template-admin/') ?>assets/js/app-user-list.js"></script>
</body>

</html>

<script>
    var brand = '<?= $this->session->userdata('id_mst_brand') ?>'
    <?php $target = 0; ?>
    $(function() {
        // alert('OK')
        if (brand == '0') {
            $('#modalBrand').modal('show')
        }

        $("#table-user").DataTable({
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
                'url': '<?= base_url() ?>dashboard/ajax_table_user',
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
                                    <img src="<?= base_url('assets/template-admin/assets/img/avatars/') ?>` + data.photo + `" alt="Avatar" class="rounded-circle">
                                </div>
                            </div>
                            <div class="d-flex flex-column">
                                <a href="app-user-view-account.html" class="text-body text-truncate">
                                    <span class="fw-medium">` + data.nama + `</span>
                                </a>
                                <small class="text-muted">` + data.email + `</small>
                            </div>
                        </div>`
                    }
                }, {
                    "target": [<?= $target ?>],
                    "className": 'text-center py-1',
                    "data": "data.brand"
                }, {
                    "target": [<?= $target ?>],
                    "className": 'text-center py-1',
                    "data": "data.cabang",
                }, {
                    "target": [<?= $target ?>],
                    "className": 'py-1',
                    "data": "data",
                    "render": function(data) {
                        if (data.member == 'Basic') {
                            return `<span class="badge rounded-pill bg-label-info">Basic</span>`
                        } else if (data.member == 'Premium') {
                            return `<span class="badge rounded-pill bg-label-primary">Premium</span>`
                        }
                    }
                },
                {
                    "target": [<?= $target ?>],
                    "className": 'text-center py-1',
                    "data": "data",
                    "render": function(data) {
                        if (data.is_active == '1') {
                            return `<span class="badge bg-label-success">Active</span>`
                        } else if (data.is_active == '0') {
                            return `<span class="badge bg-label-danger">Suspend</span>`
                        }
                    }
                },
                {
                    "target": [<?= $target ?>],
                    "className": 'text-center py-1',
                    "data": "data",
                    "render": function(data) {
                        return `<div class="d-flex align-items-center">
                                    <a href="javascript:;" class="text-body"><i class="ti ti-edit ti-sm me-2"></i></a>
                                    <a href="javascript:;" class="text-body delete-record"><i class="ti ti-trash ti-sm mx-2"></i></a>
                                    <a href="javascript:;" class="text-body dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical ti-sm mx-1"></i></a>
                                        <div class="dropdown-menu dropdown-menu-end m-0">
                                            <a href="app-user-view-account.html" class="dropdown-item">View</a>
                                                <a href="javascript:;" class="dropdown-item">Suspend</a>
                                        </div>
                                </div>`
                    }
                }
            ],
            "dom": '<"row" <"col-md-6" l><"col-md-6" f>>rt<"row" <"col-md-6" i><"col-md-6" p>>',
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        });

    });

    function reload_table() {
        $('#table-user').DataTable().ajax.reload(null, false);
    }

    function delete_data(id) {

        Swal.fire({
            title: 'Apakah Anda Yakin ?',
            text: "Data yang dihapus tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus saja!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url() ?>sosiometri/delete_data',
                    data: {
                        id: id,
                        table: "user"
                    },
                    type: 'post',
                    dataType: 'json',
                    success: function(result) {
                        if (result.status == "success") {
                            Swal.fire(
                                'Deleted!',
                                'Data berhasil di hapus.',
                                'success'
                            )
                            reload_table()
                        } else
                            toast('error', result.message)
                    }
                })
            }
        })


    }

    function aktif(id) {

        Swal.fire({
            title: 'Apakah Anda Yakin ?',
            text: "Anda akan mengaktifkan user!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, aktifkan saja!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url() ?>sosiometri/aktifkan',
                    data: {
                        id: id,
                        table: "user"
                    },
                    type: 'post',
                    dataType: 'json',
                    success: function(result) {
                        if (result.status == "success") {
                            Swal.fire(
                                'Activated!',
                                'User berhasil di aktifkan.',
                                'success'
                            )
                            reload_table()
                        } else
                            toast('error', result.message)
                    }
                })
            }
        })


    }

    function nonaktif(id) {

        Swal.fire({
            title: 'Apakah Anda Yakin ?',
            text: "Anda akan menonaktifkan user!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, nonaktifkan saja!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url() ?>sosiometri/nonaktifkan',
                    data: {
                        id: id,
                        table: "user"
                    },
                    type: 'post',
                    dataType: 'json',
                    success: function(result) {
                        if (result.status == "success") {
                            Swal.fire(
                                'Freezed!',
                                'User berhasil di nonaktifkan.',
                                'success'
                            )
                            reload_table()
                        } else
                            toast('error', result.message)
                    }
                })
            }
        })


    }

    function reset(id) {

        Swal.fire({
            title: 'Apakah Anda Yakin ?',
            text: "Anda akan melakukan reset password user menjadi password default : 12345",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, reset saja!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url() ?>sosiometri/reset',
                    data: {
                        id: id,
                        table: "user"
                    },
                    type: 'post',
                    dataType: 'json',
                    success: function(result) {
                        if (result.status == "success") {
                            Swal.fire(
                                'Reset!',
                                'Password user berhasil di reset ke default : 12345',
                                'success'
                            )
                            reload_table()
                        } else
                            toast('error', result.message)
                    }
                })
            }
        })


    }

    $('#btn-tambah').on('click', function() {
        $('#exampleModalgrid').modal('show');
        $('#batch').val('<?= $this->uri->segment(3) ?>')
        $('#kelas').val('<?= $this->uri->segment(4) ?>')
    })

    $("#form-data").submit(function(e) {
        // alert('OK')
        e.preventDefault()

        if ($('#userid').val() == '' || $('#name').val() == '' || $('#pekerjaan').val() == '' || $('#phone').val() == '' || $('#email').val() == '') {
            Swal.fire(
                'error!',
                'Tidak boleh ada kolom kosong!',
                'error'
            )
            return
        }


        var form_data = new FormData();
        form_data.append('table', 'user');
        form_data.append('userid', $("#userid").val());
        form_data.append('name', $("#name").val());
        form_data.append('pekerjaan', $("#pekerjaan").val());
        form_data.append('phone', $("#phone").val());
        form_data.append('email', $("#email").val());

        var url_ajax = '<?= base_url() ?>sosiometri/insert_konselor'


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
                    Swal.fire(
                        'Success!',
                        result.message,
                        'success'
                    )
                    $('#exampleModalgrid').modal('hide');
                    reload_table()
                } else {
                    Swal.fire(
                        'error!',
                        result.message,
                        'error'
                    )
                }
            },
            error: function(err) {
                Swal.fire(
                    'error!',
                    err.responseText,
                    'error'
                )
            }
        })
    })

    $("#form-data-2").submit(function(e) {
        // alert('OK')
        e.preventDefault()

        if ($('#name_edit').val() == '' || $('#nik_edit').val() == '' || $('#pekerjaan_edit').val() == '' || $('#phone_edit').val() == '' || $('#email_edit').val() == '') {
            Swal.fire(
                'error!',
                'Tidak boleh ada kolom kosong!',
                'error'
            )
            return
        }


        var form_data = new FormData();
        form_data.append('table', 'user');
        form_data.append('id', $("#id_edit").val());
        form_data.append('name', $("#name_edit").val());
        form_data.append('nik', $("#nik_edit").val());
        form_data.append('pekerjaan', $("#pekerjaan_edit").val());
        form_data.append('phone', $("#phone_edit").val());
        form_data.append('email', $("#email_edit").val());

        var url_ajax = '<?= base_url() ?>sosiometri/update_konselor'


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
                    Swal.fire(
                        'Success!',
                        result.message,
                        'success'
                    )
                    $('#editmodal').modal('hide');
                    reload_table()
                } else {
                    Swal.fire(
                        'error!',
                        result.message,
                        'error'
                    )
                }
            },
            error: function(err) {
                Swal.fire(
                    'error!',
                    err.responseText,
                    'error'
                )
            }
        })
    })

    $("#form-data-3").submit(function(e) {
        // alert('OK')
        e.preventDefault()

        if ($('#sekolah_edit').val() == '' || $('#alamat_edit').val() == '' || $('#provinsi_edit').val() == '' || $('#kota_edit').val() == '' || $('#telp_sekolah_edit').val() == '') {
            Swal.fire(
                'error!',
                'Tidak boleh ada kolom kosong!',
                'error'
            )
            return
        }


        var form_data = new FormData();
        form_data.append('table', 'user');
        form_data.append('id', $("#id_edit2").val());
        form_data.append('sekolah', $("#sekolah_edit").val());
        form_data.append('alamat', $("#alamat_edit").val());
        form_data.append('provinsi', $("#provinsi_edit").val());
        form_data.append('kota', $("#kota_edit").val());
        form_data.append('telp_sekolah', $("#telp_sekolah_edit").val());

        var url_ajax = '<?= base_url() ?>sosiometri/update_konselor'


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
                    Swal.fire(
                        'Success!',
                        result.message,
                        'success'
                    )
                    $('#editmodal').modal('hide');
                    reload_table()
                } else {
                    Swal.fire(
                        'error!',
                        result.message,
                        'error'
                    )
                }
            },
            error: function(err) {
                Swal.fire(
                    'error!',
                    err.responseText,
                    'error'
                )
            }
        })
    })

    function info_konselor(id) {

        $.ajax({
            url: '<?= base_url() ?>sosiometri/info_konselor',
            type: "post",
            async: true,
            data: {
                id: id
            },
            dataType: "json",
            success: function(result) {
                $('#infoModal').modal('show');

                var html2 = `<div class="row mt-3">
                    <div class="col-4">
                        <img src="<?= base_url('assets/default/assets/images/konselor/') ?>` + result.photo + `" alt="" class="object-cover w-100" height="220">
                        <h5 class="text-center mt-3">UserID : ` + result.userid + `</h5>
                    </div>
                    <div class="col-8">
                        <table class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                            <tr>
                                <td>Nama</td>
                                <td>` + result.name + `</td>
                            </tr>
                            <tr>
                                <td>NIK</td>
                                <td>` + result.nik + `</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>` + result.email + `</td>
                            </tr>
                            <tr>
                                <td>Phone</td>
                                <td>` + result.phone + `</td>
                            </tr>
                            <tr>
                                <td>Pekerjaan</td>
                                <td>` + result.pekerjaan + `</td>
                            </tr>
                            <tr>
                                <td>Sekolah</td>
                                <td>` + result.sekolah + `<br>` + result.alamat + `, ` + result.kota + `, ` + result.provinsi + `<br>` + result.telp_sekolah + `</td>
                            </tr>
                        </table>
                    </div>
                </div>`

                $('#info').html(html2)

            },
            error: function(err) {
                Swal.fire(
                    'error!',
                    err.responseText,
                    'error'
                )
            }
        })
    }

    $('#userid').on('keyup', function() {
        $.ajax({
            url: '<?= base_url() ?>sosiometri/getuserid',
            type: "post",
            async: true,
            data: {
                userid: $('#userid').val()
            },
            dataType: "json",
            success: function(result) {
                if (result.status == 'error') {
                    $('#erroruserid').show()
                } else {
                    $('#erroruserid').hide()
                }

            },
            error: function(err) {
                Swal.fire(
                    'error!',
                    err.responseText,
                    'error'
                )
            }
        })
    })

    function edit(id) {

        $('#editmodal').modal('show');

        $.ajax({
            url: '<?= base_url() ?>sosiometri/getuseriddata',
            type: "post",
            async: true,
            data: {
                id: id
            },
            dataType: "json",
            success: function(result) {
                $('#name_edit').val(result.name)
                $('#nik_edit').val(result.nik)
                $('#pekerjaan_edit').val(result.pekerjaan)
                $('#phone_edit').val(result.phone)
                $('#email_edit').val(result.email)
                $('#sekolah_edit').val(result.sekolah)
                $('#alamat_edit').val(result.alamat)
                $('#provinsi_edit').val(result.provinsi)
                $('#kota_edit').val(result.kota)
                $('#telp_sekolah_edit').val(result.telp_sekolah)
                $('#id_edit').val(result.id)
                $('#id_edit2').val(result.id)
                $('#id_edit3').val(result.id)
                $('#photo-konselor').attr('src', `<?= base_url('assets/default/assets/images/konselor/') ?>` + result.photo)


            },
            error: function(err) {
                Swal.fire(
                    'error!',
                    err.responseText,
                    'error'
                )
            }
        })
    }

    $('#profile-konselor').on('change', function() {
        var form_data = new FormData();
        form_data.append('table', 'user');
        form_data.append('id', $('#id_edit3').val());
        if ($('#profile-konselor').val() !== "") {
            var file_data = $('#profile-konselor').prop('files')[0];
            form_data.append('file', file_data);
        }


        url_ajax = '<?= base_url() ?>sosiometri/update_setting_gambar_profil_konselor'


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
                    $('#photo-konselor').attr('src', `<?= base_url('assets/default/assets/images/konselor/') ?>` + result.gambar)

                    reload_table()
                } else {
                    Swal.fire(
                        'error!',
                        result.message,
                        'error'
                    )
                }
            },
            error: function(err) {
                Swal.fire(
                    'error!',
                    err.responseText,
                    'error'
                )
            }
        })
    });
</script>