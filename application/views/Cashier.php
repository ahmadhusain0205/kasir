<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Ecommerce</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= site_url('assets/template/') ?>plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="<?= site_url('assets/template/') ?>plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?= site_url('assets/template/') ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="<?= site_url('assets/template/') ?>plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= site_url('assets/template/') ?>dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?= site_url('assets/template/') ?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?= site_url('assets/template/') ?>plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="<?= site_url('assets/template/') ?>plugins/summernote/summernote-bs4.min.css">

</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <div class="container">
            <div class="row">
                <div class="col-md">
                    <h1>Kasir</h1>
                    <h2>Hai, <?= $user['name']; ?></h2>
                    <a href="<?= site_url('Auth/logout'); ?>">Keluar</a>
                </div>
            </div>
            <br>
            <?= $this->session->flashdata('message'); ?>
            <div class="row">
                <div class="col-lg-10">
                    <div class="row">
                        <div class="col-md table-responsive">
                            <form action="<?= site_url('Cashier/tes') ?>" method="POST">
                                <div class="input-group">
                                    <input type="number" name="qty" class="form-control" placeholder="1">
                                    <input type="text" name="add" class="form-control" placeholder="barang..." autofocus>
                                    <span class="input-group-btn float-right">
                                        <button class="btn btn-primary btn-flat" type="submit">tambah</button>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr class="text-center">
                                        <th width="1%">no</th>
                                        <th>kode barang</th>
                                        <th>nama barang</th>
                                        <th width="10%">qty</th>
                                        <th>price</th>
                                        <th>sub total</th>
                                        <th>aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($tes as $c) :
                                    ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= $c->code; ?></td>
                                            <td><?= $c->nama_barang; ?></td>
                                            <td><a class="float-right"><?= $c->qty; ?></a></td>
                                            <td>Rp. <a class="float-right"><?= number_format($c->price); ?></a></td>
                                            <td>Rp. <a class="float-right"><?= number_format($c->sub_total); ?></a></td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#edit_tes<?= $c->sale_id; ?>">
                                                    <i class="fas fa-edit"></i> ubah
                                                </button>
                                                <a type="button" class="btn btn-danger btn-xs" href="<?= site_url('Cashier/delete/') . $c->sale_id; ?>">
                                                    <i class="fas fa-trash"></i> hapus
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="row">
                        <div class="col">
                            <form action="<?= site_url('Cashier/kembalian') ?>" method="post">
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary btn-flat" style="width: 60px;">total</button>
                                    </span>
                                    <?php foreach($tes as $t): ?>
                                        <input type="hidden" value="<?= $t->invoice;?>">
                                    <?php endforeach ?>
                                    <input type="number" name="total" class="form-control text-right" readonly value="<?php
                                                                                                                        foreach ($total as $t) {
                                                                                                                            echo $t->total;
                                                                                                                        }
                                                                                                                        ?>">
                                </div>
                                <br>
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary btn-flat" style="width: 60px;">bayar</button>
                                    </span>
                                    <input type="number" class="form-control text-right" name="cash" placeholder="bayar...">
                                </div>
                                <br>
                                <div class="form-group">
                                    <button class="btn btn-primary btn-flat" style="width: 100%;" type="submit">selesaikan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <div class="h3 form-group">
                                Rp. <div class="float-right">
                                    <?php foreach ($kembalian as $t) {
                                        echo number_format($t->kembalian);
                                    } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <!-- modal ubah -->
    <?php foreach ($tes as $c) : ?>
        <div class="modal fade" id="edit_tes<?= $c->sale_id; ?>" data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        Ubah Qty
                    </div>
                    <form action="<?= site_url('Cashier/edit_process/').$c->sale_id; ?>" method="POST">
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="number" class="form-control" value="<?= $c->qty; ?>" name="qty">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary btn-xs" type="submit"><i class="fa fa-save"></i> simpan</button>
                            <button type="button" class="btn btn-secondary btn-xs" data-dismiss="modal"><i class="fas fa-times"></i> tidak</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; ?>


    <!-- jQuery -->
    <script src="<?= base_url(); ?>assets/template/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url(); ?>assets/template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url(); ?>assets/template/dist/js/adminlte.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="<?= base_url(); ?>assets/template/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url(); ?>assets/template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url(); ?>assets/template/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?= base_url(); ?>assets/template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="<?= base_url(); ?>assets/template/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?= base_url(); ?>assets/template/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="<?= base_url(); ?>assets/template/plugins/jszip/jszip.min.js"></script>
    <script src="<?= base_url(); ?>assets/template/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="<?= base_url(); ?>assets/template/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="<?= base_url(); ?>assets/template/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="<?= base_url(); ?>assets/template/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="<?= base_url(); ?>assets/template/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#table1').DataTable()
        })
    </script>

</body>

</html>