<?= $this->extend('layout_clear') ?>
<?= $this->section('content') ?>
<?php
$username = [
    'name' => 'username',
    'id' => 'username',
    'class' => 'form-control input-group input-group-outline'
];

$password = [
    'name' => 'password',
    'id' => 'password',
    'class' => 'form-control input-group input-group-outline'
];
?>
<main class="main-content mt-0">
    <div class="page-header align-items-start min-vh-100" style="background-image: url('https://images.unsplash.com/photo-1497294815431-9365093b7331?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1950&q=80');">
        <span class="mask bg-gradient-dark opacity-6"></span>
        <div class="container my-auto">
            <div class="row">
                <div class="col-lg-4 col-md-8 col-12 mx-auto">
                    <div class="card z-index-0 fadeIn3 fadeInBottom">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-dark shadow-dark border-radius-lg py-3 pe-1">
                                <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Toko</h4>
                                <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Sign in</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php
                            if (session()->getFlashData('failed')) {
                            ?>
                                <div class="col-12 alert alert-danger" role="alert">
                                    <hr>
                                    <p class="mb-0">
                                        <?= session()->getFlashData('failed') ?>
                                    </p>
                                </div>
                            <?php
                            }
                            ?>

                            <?= form_open('login', 'class = "row g-3 needs-validation"') ?>

                            <div class="input-group input-group-outline">
                                <label for="yourUsername" class="form-label">Username</label>
                                <?= form_input($username) ?>
                                <div class="invalid-feedback">Please enter your username!</div>
                            </div>

                            <div class="input-group input-group-outline">
                                <label for="yourPassword" class="form-label">Password</label>
                                <?= form_password($password) ?>
                                <div class="invalid-feedback">Please enter your password!</div>
                            </div>
                            <div class="input-group input-group-outline">
                                <?= form_submit('submit', 'Login', ['class' => 'btn btn-primary w-100']) ?>
                            </div>

                            <?= form_close() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer position-absolute bottom-2 py-2 w-100">
            <div class="container">
                <div class="row align-items-center justify-content-lg-between">
                    <div class="col-12 col-md-6 my-auto">
                        <div class="copyright text-center text-sm text-white text-lg-start">
                            © <script>
                                document.write(new Date().getFullYear())
                            </script>,
                            made with <i class="fa fa-heart" aria-hidden="true"></i> by
                            <a href="https://www.creative-tim.com" class="font-weight-bold text-white" target="_blank">Creative Tim</a>
                            for a better web.
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com" class="nav-link text-white" target="_blank">Creative Tim</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com/presentation" class="nav-link text-white" target="_blank">About Us</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com/blog" class="nav-link text-white" target="_blank">Blog</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-white" target="_blank">License</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </div>

</main>
<?= $this->endSection() ?>