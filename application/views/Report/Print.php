<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Report</title>

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
            <label for="title" class="h2">Cetak laporan</label>
            <a class="float-right mr-3">
                tanggal: <?= date('D, d-M-Y H:i:s') ?>
            </a>
        </div>
    </div>
    <hr>
    <div class="row">
        <table class="table table-striped table-bordered ml-5 mr-5">
            <thead>
                <tr class="text-center">
                    <th width="1%">no</th>
                    <th>tanggal</th>
                    <th>penjual</th>
                    <th>invoice</th>
                    <th>barcode</th>
                    <th>barang</th>
                    <th>jumlah</th>
                    <th>harga beli</th>
                    <th>harga jual</th>
                    <th>total jual</th>
                    <th>keuntungan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($print as $p) :
                ?>
                    <tr>
                        <td><a class="float-right"><?= $no++; ?></a></td>
                        <td>
                            <a class="float-right">
                                <?= $p->date; ?>
                            </a>
                        </td>
                        <td><?= $p->u_name; ?></td>
                        <td><?= $p->invoice; ?></td>
                        <td><?= $p->barcode; ?></td>
                        <td><?= $p->name; ?></td>
                        <td><?= $p->qty; ?></td>
                        <td>Rp. <a class="float-right"><?= number_format($p->beli); ?></a></td>
                        <td>Rp. <a class="float-right"><?= number_format($p->jual); ?></a></td>
                        <td>Rp. <a class="float-right"><?= number_format($p->sub_total_jual); ?></a></td>
                        <td>Rp. <a class="float-right"><?= number_format($p->keuntungan); ?></a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfooter>
                <tr>
                    <td colspan="9" class="text-center"><b>total keuntungan</b></td>
                    <td>
                        <?php
                        $query = $this->db->query('select sum(re.sub_total_jual) as pr from report re')->result();
                        foreach ($query as $q) {
                            echo 'Rp. <a class="float-right">';
                            echo number_format($q->pr);
                            echo '</a>';
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        $query = $this->db->query('select sum(re.keuntungan) as k from report re')->result();
                        foreach ($query as $q) {
                            echo 'Rp. <a class="float-right">';
                            echo number_format($q->k);
                            echo '</a>';
                        }
                        ?>
                    </td>
                </tr>
            </tfooter>
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