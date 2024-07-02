<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">
    <link rel="icon" href="<?= base_url('/assets/images/icon/Icon.png') ?>" type="image/png">

    <!-- Title Page-->
    <title>Login</title>

    <!-- Fontfaces CSS-->
    <link href="<?= base_url('assets/') ?>css/font-face.css" rel="stylesheet" media="all">
    <link href="<?= base_url('assets/') ?>vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="<?= base_url('assets/') ?>vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="<?= base_url('assets/') ?>vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="<?= base_url('assets/') ?>vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="<?= base_url('assets/') ?>vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="<?= base_url('assets/') ?>vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="<?= base_url('assets/') ?>vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="<?= base_url('assets/') ?>vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="<?= base_url('assets/') ?>vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="<?= base_url('assets/') ?>vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="<?= base_url('assets/') ?>vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="<?= base_url('assets/') ?>css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition" >
    <div class="page-wrapper">
        <div class="page-content--bge5" style="background: #2E1118;">
            <div class="container" >
                <div class="login-wrap" >
                    <div class="login-content" style="border-radius: 8px; margin-top: 40px;">
                        <?= $this->session->flashdata('message'); ?>
                        <div class="login-logo">
                            <a href="#">
                                <img src="<?= base_url('assets/') ?>images/icon/Logo.png" width="400">
                            </a>
                        </div>
                        <div class="login-form">
                            <?= form_open('auth'); ?>
                            <div class="form-group">
                                <label style="font-size: 18px; font-weight:bold;">Username</label>
                                <input class="au-input au-input--full" type="username" name="username" placeholder="Username" autofocus>
                                <?= form_error('username', '<small class="text-danger pl-3">', '</small>') ?>
                            </div>
                            <div class="form-group">
                                <label style="font-size: 18px; font-weight:bold;">Password</label>
                                <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
                                <?= form_error('password', '<small class="text-danger pl-3">', '</small>') ?>
                            </div>
                            <button class="au-btn au-btn--block au-btn--blue m-b-20" type="submit" style="border-radius: 10px">sign in</button>
                            <!-- <button class="au-btn au-btn--block au-btn--white-border m-b-20" data-toggle="modal" data-target="#forgotPasswordModal" type="button" style="border-radius: 10px">forgot Password</button> -->

                            <p class="pt-8 text-center text-slate-400 text-sm">Copyright 2024 by PT. Asta Protek Jiarsi </p>
                            <?= form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Forgot Password</h5>
            </div>
            <div class="modal-body">
            <form id="forgotPasswordForm">
                <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="forgotUsername" placeholder="Enter your username">
                <div id="username-error" class="login__input-error text-danger mt-2"></div>
                </div>
            </form>
            </div>
            <div class="modal-footer">
            <button type="button" data-tw-dismiss="modal" class="btn btn-secondary">Close</button>
            <button type="button" id="submitForgotPassword" class="btn btn-primary">Submit</button>
            </div>
        </div>
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="<?= base_url('assets/') ?>vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="<?= base_url('assets/') ?>vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="<?= base_url('assets/') ?>vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="<?= base_url('assets/') ?>vendor/slick/slick.min.js">
    </script>
    <script src="<?= base_url('assets/') ?>vendor/wow/wow.min.js"></script>
    <script src="<?= base_url('assets/') ?>vendor/animsition/animsition.min.js"></script>
    <script src="<?= base_url('assets/') ?>vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="<?= base_url('assets/') ?>vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="<?= base_url('assets/') ?>vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="<?= base_url('assets/') ?>vendor/circle-progress/circle-progress.min.js"></script>
    <script src="<?= base_url('assets/') ?>vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="<?= base_url('assets/') ?>vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="<?= base_url('assets/') ?>vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="<?= base_url('assets/') ?>js/main.js"></script>

</body>

</html>


    