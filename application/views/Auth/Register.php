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
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/template/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
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
                <p class="login-box-msg">form pendaftaran</p>

                <form action="<?= site_url('Auth/register'); ?>" method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="username*" name="username" value="<?= set_value('username'); ?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
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
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="nomor hp*" name="phone" value="<?= set_value('phone'); ?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-phone"></span>
                            </div>
                        </div>
                    </div>
                    <?= form_error('phone', '<small class="text-danger">', '</small>'); ?>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="nama*" name="name" value="<?= set_value('name'); ?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <?= form_error('name', '<small class="text-danger">', '</small>'); ?>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="alamat*" name="address" value="<?= set_value('address'); ?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-map-marker-alt"></span>
                            </div>
                        </div>
                    </div>
                    <?= form_error('address', '<small class="text-danger">', '</small>'); ?>
                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-primary btn-sm float-right ml-3"><i class="fas fa-user-plus"></i> daftar</button>
                            <button type="reset" class="btn btn-secondary btn-sm float-right"><i class="fas fa-undo"></i> atur ulang</button>
                        </div>
                    </div>
                </form>
                <hr>
                <p class="mb-0 text-center">
                    <a href="<?= site_url('Auth') ?>" class="text-center">sudah punya akun</a>
                </p>
            </div>
        </div>
    </div>

    <script src="<?= base_url(); ?>assets/template/plugins/jquery/jquery.min.js"></script>
    <script src="<?= base_url(); ?>assets/template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url(); ?>assets/template/dist/js/adminlte.min.js"></script>
</body>

</html>