<!DOCTYPE html>

<html lang="en" class="light-style layout-wide customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="<?= base_url('assets/template-admin/') ?>assets/" data-template="vertical-menu-template">

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

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="<?= base_url('assets/template-admin/') ?>assets/vendor/css/pages/page-auth.css" />

    <!-- Helpers -->
    <script src="<?= base_url('assets/template-admin/') ?>assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="<?= base_url('assets/template-admin/') ?>assets/vendor/js/template-customizer.js"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="<?= base_url('assets/template-admin/') ?>assets/js/config.js"></script>
</head>

<body>
    <!-- Content -->

    <div class="authentication-wrapper authentication-cover authentication-bg">
        <div class="authentication-inner row">
            <!-- /Left Text -->
            <div class="d-none d-lg-flex col-lg-7 p-0">
                <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
                    <img src="<?= base_url('assets/template-admin/') ?>assets/img/illustrations/auth-verify-email-illustration-light.png" alt="auth-verify-email-cover" class="img-fluid my-5 auth-illustration" data-app-light-img="illustrations/auth-verify-email-illustration-light.png" data-app-dark-img="illustrations/auth-verify-email-illustration-dark.png" />

                    <img src="<?= base_url('assets/template-admin/') ?>assets/img/illustrations/bg-shape-image-light.png" alt="auth-verify-email-cover" class="platform-bg" data-app-light-img="illustrations/bg-shape-image-light.png" data-app-dark-img="illustrations/bg-shape-image-dark.png" />
                </div>
            </div>
            <!-- /Left Text -->

            <!--  Verify email -->
            <div class="d-flex col-12 col-lg-5 align-items-center p-4 p-sm-5">
                <div class="w-px-400 mx-auto">
                    <div class="app-brand mb-4">
                        <img src="<?= base_url('assets/template-admin/') ?>assets/img/logo/solusicafe.png" alt="logo" class="img-fluid" style="max-width: 100px;margin-bottom: 20px;" />
                    </div>
                    <h3 class="mb-1">Verifikasi email Anda</h3>
                    <p class="text-start mb-4">
                        Pesan aktivasi telah dikirimkan ke email Anda : hello@example.com Tolong klik link yang terkirim untuk melanjutkan pendaftaran Anda.
                    </p>
                    <a class="btn btn-primary w-100 mb-3" href="<?= base_url('auth') ?>"> Login </a>
                    <p class="text-center">
                        Belum mendapatkan email?
                        <a href="javascript:void(0);"> Kirim ulang </a>
                    </p>
                </div>
            </div>
            <!-- / Verify email -->
        </div>
    </div>

    <!-- / Content -->

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

    <!-- Main JS -->
    <script src="<?= base_url('assets/template-admin/') ?>assets/js/main.js"></script>

    <!-- Page JS -->
</body>

</html>