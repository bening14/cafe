<!DOCTYPE html>

<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="<?= base_url('assets/template-admin/') ?>assets/" data-template="vertical-menu-template">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>Cards basic - UI elements | Vuexy - Bootstrap Admin Template</title>

  <meta name="description" content="" />

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="<?= base_url('assets/template-admin/') ?>assets/img/favicon/favicon.ico" />

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

  <!-- Page CSS -->

  <!-- Helpers -->
  <script src="<?= base_url('assets/template-admin/') ?>assets/vendor/js/helpers.js"></script>
  <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
  <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
  <script src="<?= base_url('assets/template-admin/') ?>assets/vendor/js/template-customizer.js"></script>
  <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
  <script src="<?= base_url('assets/template-admin/') ?>assets/js/config.js"></script>

  <style>
    .keranjang {
      box-shadow: 0px -2px 42px 0px rgba(0, 0, 0, 0.2) !important;
      border-top-left-radius: 10px;
      border-top-right-radius: 10px;
    }
  </style>
</head>

<body>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <!-- Menu -->


      <!-- / Menu -->

      <!-- Layout container -->
      <div class="layout-page">
        <!-- Navbar -->

        <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">


          <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <!-- Search -->
            <div class="navbar-nav align-items-center">
              <div class="nav-item navbar-search-wrapper mb-0">
                <a class="nav-item nav-link search-toggler d-flex align-items-center px-0" href="javascript:void(0);">
                  <i class="ti ti-search ti-md me-2"></i> Cari Menu Favorit Kamu disini
                </a>
              </div>
            </div>
            <!-- /Search -->
          </div>
          <!-- Search Small Screens -->
          <div class="navbar-search-wrapper search-input-wrapper d-none">
            <input type="text" class="form-control search-input container-xxl border-0" placeholder="Cari Menu Favorit Kamu disini" aria-label="Search..." />
            <i class="ti ti-x ti-sm search-toggler cursor-pointer"></i>
          </div>
        </nav>

        <!-- / Navbar -->

        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->

          <div class="container-xxl flex-grow-1 container-p-y">
            <h3 class="py-1 mb-3" style="text-align: center;"><span class="badge bg-label-dark">MEJA-1</span></h3>
            <div>
              <label>Kategori</label>
              <select name="" id="" class="form-control mb-3">
                <option value="">Chinese Food</option>
                <option value="">Indonesian Food</option>
                <option value="">Western Food</option>
              </select>
            </div>

            <!-- <button type="button" class="btn btn-success waves-effect waves-light">
              <span class="ti-xs ti ti-bell me-1"></span> Makanan
            </button>
            <button type="button" class="btn btn-success waves-effect waves-light">
              <span class="ti-xs ti ti-bell me-1"></span> Minuman
            </button>
            <button type="button" class="btn btn-success waves-effect waves-light">
              <span class="ti-xs ti ti-bell me-1"></span> Snack
            </button> -->

            <!-- Horizontal -->
            <h5 class="pb-1 mb-4 mt-3">Makanan</h5>
            <div class="row mb-5">
              <div class="col-6">
                <div class="card mb-3">
                  <div class="row g-0">
                    <div class="col-md-4">
                      <img class="card-img card-img-left" src="<?= base_url('assets/template-admin/') ?>assets/food/nasi_goreng.jpg" alt="Card image" />
                    </div>
                    <div class="col-md-8">
                      <div class="card-body" style="padding-top: 10px;padding-left:10px;padding-right:10px;padding-bottom:0px;">
                        <p style="margin-bottom: 0px;">Nasi Goreng</p>
                        <p style="margin-bottom: 0px;" class="text-danger"><strong>Rp19.000</strong></p>
                      </div>

                      <div class="" style="margin-left: 10px;margin-right: 10px;margin-bottom: 10px;margin-top: 0px;text-align: right;" id="tambah_awal">
                        <button type="button" class="btn rounded-pill btn-icon btn-success waves-effect" onclick="tambah()">
                          <i class="fa fa-plus"></i>
                        </button>
                      </div>

                      <div class="d-flex justify-content-around" style="padding: 10px; display: none !important;" id="tambah_lanjut">
                        <button class="btn btn-info btn-sm" type="button"><i class="fa fa-plus"></i></button>
                        <label>1</label>
                        <button class="btn btn-danger btn-sm" type="button"><i class="fa fa-minus"></i></button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="card mb-3">
                  <div class="row g-0">
                    <div class="col-md-4">
                      <img class="card-img card-img-left" src="<?= base_url('assets/template-admin/') ?>assets/food/ayam_goreng.jpg" alt="Card image" />
                    </div>
                    <div class="col-md-8">
                      <div class="card-body" style="padding-top: 10px;padding-left:10px;padding-right:10px;padding-bottom:0px;">
                        <p style="margin-bottom: 0px;">Ayam Goreng</p>
                        <p style="margin-bottom: 0px;" class="text-danger"><strong>Rp19.000</strong></p>
                      </div>

                      <div class="" style="margin-left: 10px;margin-right: 10px;margin-bottom: 10px;margin-top: 0px;text-align: right;" id="tambah_awal">
                        <button type="button" class="btn rounded-pill btn-icon btn-success waves-effect" onclick="tambah()">
                          <i class="fa fa-plus"></i>
                        </button>
                      </div>

                      <div class="row" style="padding: 10px;display: none;" id="tambah_lanjut">
                        <div class="col-4" style="text-align: center;">
                          <button class="btn btn-info btn-sm" type="button"><i class="fa fa-plus"></i></button>
                        </div>
                        <div class="col-4" style="text-align: center;">
                          <label>1</label>
                        </div>
                        <div class="col-4" style="text-align: center;">
                          <button class="btn btn-danger btn-sm" type="button"><i class="fa fa-minus"></i></button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="card mb-3">
                  <div class="row g-0">
                    <div class="col-md-4">
                      <img class="card-img card-img-left" src="<?= base_url('assets/template-admin/') ?>assets/food/ayam_goreng.jpg" alt="Card image" />
                    </div>
                    <div class="col-md-8">
                      <div class="card-body" style="padding-top: 10px;padding-left:10px;padding-right:10px;padding-bottom:0px;">
                        <p style="margin-bottom: 0px;">Ayam Goreng</p>
                        <p style="margin-bottom: 0px;" class="text-danger"><strong>Rp19.000</strong></p>
                      </div>

                      <div style="margin-left: 10px;margin-right: 10px;margin-bottom: 10px;margin-top: 0px;text-align: right;" id="tambah_awal">
                        <span class="badge rounded-pill bg-label-danger">NOT AVAILABLE</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!--/ Horizontal -->

            <div class="row">
              <div class="col-lg-12 col-12 fixed-bottom mx-auto p-0 checkout-bar" style="display: none;">
                <div class="bg-white px-2 py-3 footer-shadow keranjang">
                  <div class="container-fluid">
                    <div class="row">
                      <div class="row mb-3">
                        <div class="col-6 fw-bold">TOTAL PESANAN</div>
                        <div class="col-6 fw-bold" style="text-align: right;">Rp24.000</div>
                      </div>
                      <div class="d-grid gap-2">
                        <button class="btn btn-success" type="button" onclick="checkout()">Checkout</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
          <!-- / Content -->

          <!-- Footer -->
          <footer class="content-footer footer bg-footer-theme">
            <div class="container-xxl">
              <div class="footer-container d-flex align-items-center justify-content-between py-2 flex-md-row flex-column">
                <div>
                  ©
                  <script>
                    document.write(new Date().getFullYear());
                  </script>
                  , made with ❤️ by <a href="https://solusiciptamedia.com" target="_blank" class="fw-medium">SCM</a>
                </div>
                <div class="d-none d-lg-inline-block">
                  <a href="https://themeforest.net/licenses/standard" class="footer-link me-4" target="_blank">License</a>
                  <a href="https://1.envato.market/pixinvent_portfolio" target="_blank" class="footer-link me-4">More Themes</a>

                  <a href="https://demos.pixinvent.com/vuexy-html-admin-template/documentation/" target="_blank" class="footer-link me-4">Documentation</a>

                  <a href="https://pixinvent.ticksy.com/" target="_blank" class="footer-link d-none d-sm-inline-block">Support</a>
                </div>
              </div>
            </div>
          </footer>
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
  <script src="<?= base_url('assets/template-admin/') ?>assets/vendor/libs/masonry/masonry.js"></script>

  <!-- Main JS -->
  <script src="<?= base_url('assets/template-admin/') ?>assets/js/main.js"></script>

  <!-- Page JS -->
</body>

</html>

<script>
  $(function() {
    //
  });

  function tambah() {
    $(".checkout-bar").show()

    $("#tambah_lanjut").show()
    $("#tambah_awal").hide()
  }

  function checkout() {
    $(".checkout-bar").hide()
  }
</script>