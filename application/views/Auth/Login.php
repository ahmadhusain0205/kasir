<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title; ?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/template/plugins/fontawesome-free/css/all.min.css">
    <!-- datatable -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- jquery -->
    <script src="<?= base_url(); ?>assets/template/plugins/jquery/jquery.min.js"></script>
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/template/dist/css/adminlte.min.css">
    <link rel="shortcut icon" href="<?= base_url('assets/'); ?>img/logo.png">
</head>

<body class="hold-transition login-page" background="<?= base_url('assets/img/99785.webp'); ?>" style="width: 100%;background-repeat: no-repeat;
  background-position: center;">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header">
                <div class="login-logo">
                    <a href="<?= base_url(); ?>" class="h2 text-primary">Point of Sale</a>
                </div>
            </div>
            <div class="card-body login-card-body">
                <p class="login-box-msg">
                    <?php
                    if ($this->session->flashdata() == true) {
                        echo $this->session->flashdata('message');
                    } else {
                        echo 'form masuk';
                    }
                    ?>
                </p>
                <form action="<?= site_url('Auth'); ?>" method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="username*" name="username" value="<?= set_value('username'); ?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="password*" name="password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-primary btn-sm float-right ml-3"><i class="fas fa-sign-in-alt"></i> masuk</button>
                            <button type="reset" class="btn btn-secondary btn-sm float-right"><i class="fas fa-undo"></i> atur ulang</button>
                        </div>
                    </div>
                </form>
                <hr>
                <p class="mb-0 text-center">
                    <a href="<?= site_url('Auth/register') ?>" class="text-center">belum punya akun</a>
                </p>
            </div>
        </div>
    </div>



    <script src="<?= base_url(); ?>assets/template/plugins/jquery/jquery.min.js"></script>
    <script src="<?= base_url(); ?>assets/template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url(); ?>assets/template/dist/js/adminlte.min.js"></script>
</body>

</html>