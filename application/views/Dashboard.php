<section class="content pt-2">

    <div class="row">
        <!-- items -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-archive"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">jumlah keseluruhan barang</span>
                    <span class="info-box-number">
                        <?= $count_item;  ?>
                    </span>
                </div>
            </div>
        </div>
        <!-- supplier -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-truck"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">jumlah pemasok</span>
                    <span class="info-box-number"><?= $count_supplier;  ?></span>
                </div>
            </div>
        </div>

        <div class="clearfix hidden-md-up"></div>

        <!-- stock -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">jumlah stok keluar/masuk</span>
                    <span class="info-box-number">
                        <?php
                        foreach ($count_out as $co) {
                            echo $co->qty_out;
                        }
                        echo '/';
                        foreach ($count_in as $ci) {
                            echo $ci->qty_in;
                        } ?>
                    </span>
                </div>
            </div>
        </div>
        <!-- user -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">jumlah pegawai kasir</span>
                    <span class="info-box-number"><?= $count_user; ?></span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-6 col-md-6">
            <div class="info-box">
                <span class="info-box-icon bg-secondary elevation-1"><i class="fas fa-dollar-sign"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text h4"><b>keuntungan hari ini:</b></span>
                </div>
                <div class="info-box-content">
                    <span class="info-box-text h4">
                        <b>Rp. </b>
                        <a class="float-right">
                            <?php foreach ($profit as $p) {
                                echo '<div class="h1">' . number_format($p->profit) . '</div>';
                            } ?>
                        </a>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-6">
            <div class="info-box">
                <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-dollar-sign"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text h4"><b>Modal:</b></span>
                </div>
                <div class="info-box-content">
                    <span class="info-box-text h4">
                        <b>Rp. </b>
                        <a class="float-right">
                            <?php foreach($modal as $m) : ?>
                                Rp. <?= number_format($m->md);?>
                            <?php endforeach;?>
                        </a>
                    </span>
                </div>
            </div>
        </div>
    </div>

</section>