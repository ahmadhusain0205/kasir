<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Log Activity</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/template/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/template/dist/css/adminlte.min.css">
    <link rel="shortcut icon" href="<?= base_url('assets/'); ?>img/logo.png">
</head>

<body>

    <div class="row mt-5">
        <div class="col text-center">
            <label for="title" class="h2">Cetak aktifitas log user</label>
            <a class="float-right mr-3">
                tanggal: <?= date('D, d-M-Y H:i:s') ?>
            </a>
        </div>
    </div>
    <hr>
    <div class="row">
        <table class="table table-striped table-bordered">
            <thead>
                <tr class="text-center">
                    <th width="1%">no</th>
                    <th>nama user</th>
                    <th>waktu masuk</th>
                    <th>waktu keluar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($print as $p) :
                ?>
                    <tr>
                        <td><a class="float-right"><?= $no++; ?></a></td>
                        <td><?= $p->name; ?></td>
                        <td>
                            <a class="float-right">
                                <?= date('D, d-M-Y H:i:s', $p->time_login); ?>
                            </a>
                        </td>
                        <td>
                            <?php if ($p->time_logout == null) {
                                echo 'pencetak <a class="float-right">' . date('D, d-M-Y H:i:s') . '</a>';
                            } else {
                                echo '<a class="float-right">' . date('D, d-M-Y H:i:s', $p->time_logout) . '</a>';
                            } ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script>
        window.print();
    </script>


    <!-- jQuery -->
    <script src="<?= base_url(); ?>assets/template/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url(); ?>assets/template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url(); ?>assets/template/dist/js/adminlte.min.js"></script>
</body>

</html>