<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Point Of Sale</title>

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

<body class="hold-transition sidebar-mini <?= $this->uri->segment(1) == 'Sale' || $this->uri->segment(1) == 'Items' || $this->uri->segment(1) == 'Admin' || $this->uri->segment(1) == 'Cashier' || $this->uri->segment(1) == 'Categories' || $this->uri->segment(1) == 'Customer' || $this->uri->segment(1) == 'Dashboard' || $this->uri->segment(1) == 'Logs' || $this->uri->segment(1) == 'Profile' || $this->uri->segment(1) == 'Report' || $this->uri->segment(1) == 'Stock' || $this->uri->segment(1) == 'Supplier' || $this->uri->segment(1) == 'Units' || $this->uri->segment(1) == 'User' ? 'sidebar-collapse' : null ?>">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <div class="col-md-4 offset-md-4 text-center my-auto"><?= $this->session->flashdata('message'); ?></div>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <?php
                if ($this->uri->segment(1) == 'Sale') {
                ?>
                    <li class="nav-item ml-3 mr-3">
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#manual" style="cursor:<?= 'keluar'; ?>;">
                            <i class="fas fa-box"></i> Manual input
                        </button>
                    </li>
                <?php } ?>
                <hr style="border-left: 1px black solid; height: auto; width: 0px; padding:0; margin:0;">
                <li class="nav-item ml-3">
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#logout" style="cursor:<?= 'keluar'; ?>;">
                        <i class="fas fa-power-off"></i>
                    </button>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <a href="<?= site_url('Profile'); ?>">
                            <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="img-circle elevation-2" alt="User Image">
                        </a>
                    </div>
                    <div class="info">
                        <a href="<?= site_url('Profile'); ?>" class="d-block"><?= $user['name']; ?></a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <?php
                            if ($user['level'] == 1) {
                                if ($this->uri->segment(1) == 'Dashboard') {
                                    echo '<a href="';
                                    echo site_url('Dashboard');
                                    echo '" class="nav-link active">';
                                } else {
                                    echo '<a href="';
                                    echo site_url('Dashboard');
                                    echo '" class="nav-link">';
                                }
                            ?>
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Beranda
                                </p>
                                </a>
                        </li>
                    <?php
                            }
                            if ($user['level'] == 1) {
                                echo
                                '
                            <li class="nav-header">Master</li>
                            <li class="nav-item">';
                                if ($this->uri->segment(1) == 'Admin') {
                                    echo '<a href="';
                                    echo site_url('Admin');
                                    echo '" class="nav-link active">';
                                } else {
                                    echo '<a href="';
                                    echo site_url('Admin');
                                    echo '" class="nav-link">';
                                }
                                echo
                                '<i class="nav-icon fas fa-shield-alt"></i>
                                    <p>
                                        Administrator
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                ';
                                if ($this->uri->segment(1) == 'User') {
                                    echo '<a href="';
                                    echo site_url('User');
                                    echo '" class="nav-link active">';
                                } else {
                                    echo '<a href="';
                                    echo site_url('User');
                                    echo '" class="nav-link">';
                                }
                                echo
                                '
                                    <i class="nav-icon fas fa-cash-register"></i>
                                    <p>
                                        Kasir
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                ';
                                if ($this->uri->segment(1) == 'Management') {
                                    echo '<a href="';
                                    echo site_url('Management');
                                    echo '" class="nav-link active">';
                                } else {
                                    echo '<a href="';
                                    echo site_url('Management');
                                    echo '" class="nav-link">';
                                }
                                echo '
                                    <i class="nav-icon fas fa-user-cog"></i>
                                    <p>
                                        Management User
                                    </p>
                                </a>
                            </li>
                            ';
                            }
                    ?>
                    <li class="nav-header">Menu</li>
                    <li class="nav-item">
                        <?php
                        if ($user['level'] == 1) {
                            if ($this->uri->segment(1) == 'Supplier') {
                                echo '<a href="';
                                echo site_url('Supplier');
                                echo '" class="nav-link active">';
                            } else {
                                echo '<a href="';
                                echo site_url('Supplier');
                                echo '" class="nav-link">';
                            }
                        ?>
                            <i class="nav-icon fas fa-truck"></i>
                            <p>
                                Pemasok
                            </p>
                            </a>
                    </li>
                <?php
                        }
                        if (($user['level'] == 1)) {
                            echo '
                            <li class="nav-item">';
                            if ($this->uri->segment(1) == 'Customer') {
                                echo '<a href="';
                                echo site_url('Customer');
                                echo '" class="nav-link active">';
                            } else {
                                echo '<a href="';
                                echo site_url('Customer');
                                echo '" class="nav-link">';
                            }
                            echo '<i class="nav-icon fas fa-users"></i>
                                    <p>
                                        Pelanggan
                                    </p>
                                </a>
                            </li>';
                        }
                ?>
                <?php if ($user['level'] == 1) { ?>
                    <li class="nav-item">
                        <?php
                        if (($this->uri->segment(1) == 'Categories') or ($this->uri->segment(1) == 'Items') or ($this->uri->segment(1) == 'Units')) {
                            echo '<a href="#" class="nav-link active">';
                        } else {
                            echo '<a href="#" class="nav-link">';
                        }
                        ?>
                        <i class="nav-icon fas fa-archive"></i>
                        <p>
                            Produk
                            <i class="fas fa-angle-left right"></i>
                        </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= site_url('Categories'); ?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Kategori</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url('Items'); ?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Barang</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                    <?php }
                if ($user['level'] == 1) {
                    if (($this->uri->segment(1) == 'Stock') or ($this->uri->segment(1) == 'Sale')) {
                        echo '<a href="#" class="nav-link active">';
                    } else {
                        echo '<a href="#" class="nav-link">';
                    }
                    ?>
                        <i class="nav-icon fas fa-exchange-alt"></i>
                        <p>
                            Transaksi
                            <i class="fas fa-angle-left right"></i>
                        </p>
                        </a>
                        <ul class="nav nav-treeview">
                        <?php } ?>
                        <li class="nav-item">
                            <a href="<?= site_url('Sale'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Penjualan</p>
                            </a>
                        </li>
                        <?php if ($user['level'] == 1) { ?>
                            <li class="nav-item">
                                <a href="<?= site_url('Stock/in'); ?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Stok Masuk</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url('Stock/out_data'); ?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Stok Keluar</p>
                                </a>
                            </li>
                        </ul>
                    <?php } ?>
                    </li>

                    <li class="nav-item">
                        <?php
                        if ($user['level'] == 1) { ?>
                            <?php
                            if (($this->uri->segment(1) == 'Report')) {
                                echo '<a href="#" class="nav-link active">';
                            } else {
                                echo '<a href="#" class="nav-link">';
                            }
                            ?>
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>
                                Laporan
                                <i class="fas fa-angle-left right"></i>
                            </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= site_url('Report'); ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Laporan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= site_url('Report/full'); ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Cetak Laporan</p>
                                    </a>
                                </li>
                            </ul>
                    </li>
                <?php
                        }
                        if ($user['level'] == 1) {
                ?>
                    <li class="nav-header">Data log</li>
                    <li class="nav-item">
                        <?php
                            if ($this->uri->segment(1) == 'Logs') {
                                echo '<a href="';
                                echo site_url('Logs');
                                echo '" class="nav-link active">';
                            } else {
                                echo '<a href="';
                                echo site_url('Logs');
                                echo '" class="nav-link">';
                            }
                        ?>
                        <i class="fas fa-cogs nav-icon"></i>
                        <p>
                            Aktifitas Login
                        </p>
                        </a>
                    </li>
                <?php } ?>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <!-- Main content -->

            <?= $content; ?>

            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 1.5
            </div>
            <strong>Copyright &copy; <b class="text-primary"></b>
        </footer>

        <!-- modal logout -->
        <div class="modal fade" id="logout" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">Keluar</div>
                    <div class="modal-body">
                        Yakin ingin keluar ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary float-right ml-3" data-dismiss="modal"><i class="fas fa-times"></i> Tidak</button>
                        <a href="<?= site_url('Auth/logout') ?>" type="button" class="btn btn-primary float-right"><i class="fas fa-check"></i> Ya</a>
                    </div>
                </div>
            </div>
        </div>


        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="<?= base_url(); ?>assets/template/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url(); ?>assets/template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- my script -->
    <script>
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
    </script>
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

    <!-- Page specific script -->
    <script>
        $(function() {
            $("#print").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["print"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#table1').DataTable()
        });
    </script>
</body>

</html>