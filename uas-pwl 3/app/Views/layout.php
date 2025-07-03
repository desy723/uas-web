<?php
$hlm = "Home";
if (uri_string() != "") {
    $hlm = ucwords(uri_string());
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>- Toko - <?php echo $hlm ?></title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="<?= base_url() ?>material-dashboard/assets/img/favicon.png" rel="icon">
    <link href="<?= base_url() ?>material-dashboard/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
    <!-- Vendor CSS Files -->
    <link href="<?= base_url() ?>material-dashboard/assets/css/nucleo-icons.css" rel="stylesheet">
    <link href="<?= base_url() ?>material-dashboard/assets/css/nucleo-svg.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
    <!-- CSS Files -->
    <link id="pagestyle" href="<?= base_url() ?>material-dashboard/assets/css/material-dashboard.css?v=3.2.0" rel="stylesheet" />

</head>

<body class="g-sidenav-show bg-gray-100">
    <?= $this->include('components/sidebar') ?>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <?= $this->include('components/header') ?>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <?= $this->renderSection('content') ?>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <?= $this->include('components/footer') ?>
    </main><!-- End #main -->


    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!--   Core JS Files   -->
    <script src="<?= base_url() ?>material-dashboard/assets/js/core/popper.min.js"></script>
    <script src="<?= base_url() ?>material-dashboard/assets/js/core/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>material-dashboard/assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="<?= base_url() ?>material-dashboard/assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="<?= base_url() ?>material-dashboard/assets/js/material-dashboard.min.js?v=3.2.0"></script>

    <?= $this->renderSection('script') ?>
</body>

</html>