<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Barcode</title>

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
            <label for="title" class="h2">Cetak semua barcode pada barang</label>
        </div>
    </div>
    <hr>
    <div class="row">
        <?php foreach ($print as $p) : ?>
            <div class="col-lg-2 text-center my-auto">
                <div>
                    <?php
                    $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
                    echo '<img style="width:150px; height:30px;" src="data:image/png;base64,' . base64_encode($generator->getBarcode($p->code, $generator::TYPE_CODE_128)) . '">';
                    echo '<br>';
                    echo $p->code;
                    echo '<hr>';
                    ?>
                </div>
                <br><br>
            </div>
        <?php endforeach; ?>
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