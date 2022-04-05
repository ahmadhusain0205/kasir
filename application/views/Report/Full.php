<section class="content pl-3 pt-3 pb-3">
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-header">Cari laporan</div>
        <div class="card-body">
          <form method="POST" action="<?= site_url('Report/full'); ?>">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="dari">dari(<span class="text-danger">*</span>)</label>
                <input type="date" class="form-control" id="dari" name="dari">
              </div>
              <div class="form-group col-md-6">
                <label for="sampai">sampai(<span class="text-danger">*</span>)</label>
                <input type="date" class="form-control" id="sampai" name="sampai">
              </div>
            </div>
            <button type="submit" class="btn btn-secondary btn-sm float-right"><i class="fa fa-search"></i> cari</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-header">Cetak Laporan Penjualan
          <div class="float-right">
            <a href="<?= site_url('Report/refresh') ?>" type="button" class="btn btn-danger btn-sm">
              <i class="fa fa-redo-alt"></i> muat ulang
            </a>
            <a href="<?= site_url('Report/print'); ?>" type="button" class="btn btn-success btn-sm" target="_BLANK">
              <i class="fa fa-print"></i> cetak
            </a>
            <a href="<?= site_url('Report/unduh'); ?>" type="button" class="btn btn-primary btn-sm">
              <i class="fa fa-download"></i> unduh
            </a>
          </div>
        </div>
        <div class="card-body">
          <table class="table table-striped table-bordered" id="print">
            <thead>
              <tr>
                <th width="1%">no</th>
                <th>tanggal</th>
                <th>invoice</th>
                <th>penjual</th>
                <th>nama barang</th>
                <th>qty</th>
                <th>harga beli</th>
                <th>harga jual</th>
                <th>diskon</th>
                <th>sub total jual</th>
                <th>keuntungan</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              foreach ($cetak as $c) : ?>
                <tr>
                  <td><?= $no++; ?></td>
                  <td><?= $c->date; ?></td>
                  <td><?= $c->invoice; ?></td>
                  <td><?= $c->u_name; ?></td>
                  <td><?= $c->i_name; ?></td>
                  <td><?= $c->qty; ?></td>
                  <td><?= number_format($c->beli); ?></td>
                  <td><?= number_format($c->jual); ?></td>
                  <td><?= number_format($c->discount); ?></td>
                  <td><?= number_format($c->sub_total_jual); ?></td>
                  <td><?= number_format($c->keuntungan); ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
            <?php if (isset($c)) { ?>
              <tfooter>
                <tr>
                  <td class="text-center" colspan="9">Total</td>
                  <td>
                    <?php
                    if (!isset($c)) {
                      echo "";
                    } else {
                      echo number_format($total_jual['jual_total']);
                    }
                    ?>
                  </td>
                  <td>
                    <?php
                    if (!isset($c)) {
                      echo "";
                    } else {
                      echo number_format($total_keuntungan['keuntungan_total']);
                    }
                    ?>
                  </td>
                </tr>
              </tfooter>
            <?php } ?>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>