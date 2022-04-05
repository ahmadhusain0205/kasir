<section class="content pt-2">

    <div class="row row-cols-1 row-cols-md-3">
        <div class="col mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <table width="100%">
                        <tr>
                            <td>
                                <label for="date">tanggal</label>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="date" id="date" value="<?= date('Y-m-d'); ?>" class="form-control" readonly>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align:top; width:30%">
                                <label for="cashier">kasir</label>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="text" id="user" name="user" value="<?= $user['name']; ?>" class="form-control" readonly>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top;">
                                <label for="customer">pelanggan</label>
                            </td>
                            <td>
                                <div class="form-group">
                                    <select name="customer" id="customer" class="form-control">
                                        <option value="">umum</option>
                                        <?php foreach ($customer as $c) : ?>
                                            <option value="<?= $c->customer_id; ?>"><?= $c->name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <form action="<?= site_url('Sale/insert') ?>" method="POST">
                        <table width="100%">
                            <tr>
                                <td style="vertical-align: top;">
                                    <label for="qty">qty</label>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="number" name="qty" class="form-control" placeholder="1" min="1">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align: top; width:30%;">
                                    <label for="barcode">barcode/ <br> nama barang</label>
                                </td>
                                <td>
                                    <div class="form-group input-group">
                                        <!-- <input type="text" name="add" id="item_name" class="form-control" autofocus required>
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-primary btn-flat form-group" data-toggle="modal" data-target="#modal_item_out">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </span> -->

                                        <?php if (empty($transaction)) { ?>
                                            <input type="text" name="add" id="item_name" class="form-control" autofocus required>
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-primary btn-flat form-group" data-toggle="modal" data-target="#modal_item_out">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </span>
                                        <?php } ?>


                                        <?php
                                        foreach ($transaction1 as $s) {
                                            if ($s->changes == null) {
                                        ?>
                                                <input type="text" name="add" id="item_name" class="form-control" autofocus required>
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-primary btn-flat form-group" data-toggle="modal" data-target="#modal_item_out">
                                                        <i class="fa fa-search"></i>
                                                    </button>
                                                </span>
                                            <?php
                                            } else {
                                            ?>
                                                <input type="text" name="add" id="item_name" class="form-control" readonly required>
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-primary btn-flat form-group" data-toggle="modal" data-target="#modal_item_out">
                                                        <i class="fa fa-search"></i>
                                                    </button>
                                                </span>
                                        <?php
                                            }
                                        }
                                        ?>
                                        <!-- <input type="text" name="add" id="barcode" class="form-control" autofocus> -->
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div>
                                        <button type="submit" id="add_cart" class="btn btn-primary float-right">
                                            <i class="fa fa-cart-plus"></i> tambah
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
        <div class="col mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div>
                        <?php foreach ($transaction as $t) : ?>
                            <form action="<?= site_url('Sale/changes/') . $t->invoice; ?>" method="POST">
                            <?php endforeach; ?>
                            <h4>invoice <b><span id="invoice"><?= $invoice; ?></span></b></h4>
                            <h1>
                                <b>
                                    <span id="grand_total2" style="font-size: 50pt;" name="total">
                                        <input type="hidden" name="total" value="<?php foreach ($total as $t) {
                                                                                        echo $t->total;
                                                                                    } ?>">
                                        <?php foreach ($total as $t) {
                                            if ($t->total == null) {
                                                echo 'Rp. 0';
                                            } else {
                                                echo 'Rp. ' . number_format($t->total);
                                            }
                                        } ?>
                                    </span>
                                </b>
                            </h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-cols-1 row-cols-md-3">
        <div class="col-md-8  mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th width="1%">no</th>
                                    <th>barang</th>
                                    <th width="5%">qty</th>
                                    <th>harga</th>
                                    <th>diskon</th>
                                    <th>sub total</th>
                                    <th>aksi</th>
                                </tr>
                            </thead>
                            <tbody id="cart-table">
                                <?php
                                $i = 1;
                                foreach ($transaction as $t) :
                                ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $t->nama_barang; ?></td>
                                        <td><a class="float-right"><?= $t->qty; ?></a></td>
                                        <td>Rp. <a class="float-right"><?= number_format($t->purchase); ?></a></td>
                                        <td>
                                            <a class="float-right">
                                                <?php
                                                if ($t->discount == null) {
                                                    echo 'Rp. 0';
                                                } else {
                                                    echo 'Rp. ' . $t->discount;
                                                }
                                                ?>
                                            </a>
                                        </td>
                                        <td>Rp. <a class="float-right"><?= number_format($t->sub_total); ?></a></td>

                                        <?php if ($t->changes == null) { ?>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#edit_trans<?= $t->sale_id; ?>">
                                                    <i class="fas fa-edit"></i> ubah
                                                </button>
                                                <a type="button" class="btn btn-danger btn-xs" href="<?= site_url('Sale/delete/') . $t->sale_id; ?>">
                                                    <i class="fas fa-trash"></i> hapus
                                                </a>
                                            </td>
                                        <?php } else {
                                            echo '<td class="text-center"><a class="btn btn-success btn-sm">
                                                sudah dibayar
                                            </a></td>';
                                        } ?>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="form-group">
                        <?php foreach ($transaction1 as $t) :
                            if ($t->changes == null) {
                        ?>
                                <input type="hidden" value="<?php foreach ($total as $t) {
                                                                echo $t->total;
                                                            } ?>">
                                Rp. <input type="number" class="h1 text-right" style="border-top: 0; border-left:0; border-right:0; width: 300px;" name="payment" placeholder="bayar...">
                        <?php }
                        endforeach; ?>
                    </div>
                    <h1>
                        <b>
                            <span id="grand_total2" style="font-size: 50pt;">
                                <input type="hidden" name="changes" value="<?php foreach ($changes as $c) {
                                                                                echo $c->changes;
                                                                            } ?>">
                                <?php foreach ($changes as $c) {
                                    if ($c->changes == null) {
                                        echo 'Rp. 0';
                                    } else {
                                        echo 'Rp. ' . number_format($c->changes);
                                    }
                                } ?>
                            </span>
                        </b>
                    </h1>
                    <?php
                    foreach ($changes as $t) {
                        if ($t->changes == null) {
                            echo '
                            <button id="process_payment" type="submit" class="btn btn-success float-right ml-3">
                                <i class="fa fa-paper-plane"></i> bayar
                            </button>
                            ';
                        }
                    }
                    ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 mb-4">
            <?php foreach ($transaction as $t) : ?>
                <form action="<?= site_url('Sale/next/') . $t->invoice; ?>" method="POST">
                <?php endforeach; ?>
                <button type="submit" class="btn btn-primary float-right">
                    <i class="fa fa-arrow-right"> selesaikan</i>
                </button>
                </form>
        </div>
    </div>

</section>


<!-- modal ubah -->
<?php foreach ($transaction as $t) : ?>
    <div class="modal fade" id="edit_trans<?= $t->sale_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    perbarui
                </div>
                <form action="<?= site_url('Sale/edit_process/') . $t->sale_id; ?>" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="number" class="form-control" value="
                            <?php
                            if ($t->discount == null) {
                                echo 'Rp. 0';
                            } else {
                                echo $t->discount;
                            }
                            ?>
                            " name="discount" placeholder="Rp. 0" min="0">
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control" value="<?= $t->qty; ?>" name="qty"> jml stok tersedia:
                            <?php
                            $stok = $this->db->query('select i.code as barcode, i.stock_id, i.name, i.price, c.categori, i.stock_id as qty from items i join categories c on i.categori_code=c.code where i.code = "' . $t->code . '"')->row_array();
                            echo $stok['stock_id'];
                            ?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> tidak</button>
                        <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- manual input -->
<div class="modal fade" id="manual" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Manual input</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="close">
                    <span arial-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php foreach ($total as $t) {
                    if ($t->total == null) {
                        echo '
                                <p>
                                    <input type="text" class="form-control" name="total" id="total" value="0" placeholder="total*" readonly>
                                </p>          
                                ';
                    } else {
                        echo '
                                <p>
                                    <input type="text" class="form-control" id="total" name="total" value="';
                        echo $t->total;
                        echo '" placeholder="total*" readonly>
                                </p> 
                                ';
                    }
                } ?>
                <p>
                    <input type="number" class="form-control" id="p" placeholder="tambahan harga*">
                </p>
                <p>
                    <input type="number" class="form-control" id="m" placeholder="pembayaran*">
                </p>
                <p>
                <table border="1px" width="100%" height="30px" style="color:gray;">
                    <tr>
                        <td id="o" class="ml-3"></td>
                    </tr>
                </table>
                </p>
                <p>
                <table border="1px" width="100%" height="30px" style="color:gray;">
                    <tr>
                        <td id="k" class="ml-3"></td>
                    </tr>
                </table>
                </p>
                <p>
                    <button class="btn btn-success float-right" onclick="hitung()"><i class="fas fa-calculator"></i> hitung</button>
                </p>
            </div>
        </div>
    </div>
</div>

<!-- modal -->
<div class="modal fade" id="modal_item_out" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">pilih barang</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="close">
                    <span arial-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body table-reponsive">
                <table class="table table-striped table-bordered" id="table1">
                    <thead>
                        <tr class="text-center">
                            <th>code</th>
                            <th>nama</th>
                            <th>harga</th>
                            <th>stok</th>
                            <th>aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($item->result() as $i) : ?>
                            <tr>
                                <td><?= $i->barcode; ?></td>
                                <td><?= $i->name; ?></td>
                                <td>
                                    <a class="float-left">Rp</a><a class="float-right"><?= number_format($i->purchase); ?></a>
                                </td>
                                <td><a class="float-right"><?= $i->stock_id;  ?></a></td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-success btn-xs" id="select" data-code="<?= $i->barcode; ?>" data-name="<?= $i->name; ?>" data-stock="<?= $i->stock_id; ?>">
                                        <i class="fas fa-check"></i> pilih
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<script>
    function hitung() {
        var total = document.getElementById("total").value;
        var p = document.getElementById("p").value;
        var m = document.getElementById("m").value;
        total_bayar = Number(total) + Number(p);
        susuk = Number(m) - total_bayar;
        document.getElementById("o").innerHTML = '<b style="margin-left:10px;">Total Rp</b>. ' + total_bayar;
        document.getElementById("k").innerHTML = '<b style="margin-left:10px;">Kembalian Rp</b>. ' + susuk;
    }
</script>
<!-- script select in modal -->
<script type="text/javascript">
    $(document).ready(function() {
        $(document).on('click', '#select', function() {
            var $code = $(this).data('code');
            var $name = $(this).data('name');
            $('#item_code').val($code);
            $('#item_name').val($name);
            $('#modal_item_out').modal('hide');
        });
    });
</script>