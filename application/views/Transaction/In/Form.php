<section class="content pl-3 pt-3 pb-3">

    <div class="card">
        <div class="card-header">
            <h3 class="card-title my-auto">form data</h3>
            <div class="float-right">
                <a href="<?= site_url('Stock/in'); ?>" class="btn btn-primary">
                    <i class="fas fa-arrow-left"></i> kembali
                </a>
            </div>
        </div>
        <div class="card-body">
            <p>peringatan: tanda bintang (<b class="text-danger">*</b>) mengartikan <b>wajib</b> diisi <br> tanda pagar (<b class="text-danger">#</b>) mengartikan <b>otomasi</b> diisi</p>
            <form action="<?= site_url('Stock/process'); ?>" method="POST">
                <div class="form-group">
                    <label for="date">tanggal<span class="text-danger">#</span></label>
                    <input type="date" class="form-control" name="date" value="<?= date('Y-m-d'); ?>" placeholder="tanggal*" required readonly>
                </div>
                <div>
                    <label for="item_code">kode barang<span class="text-danger">*</span></label>
                </div>
                <div class="input-group">
                    <input type="hidden" name="stock_id" id="stock_id" class="form-control">
                    <input type="text" name="item_code" id="item_code" class="form-control" placeholder="klik ikon cari*" required>
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-primary btn-flat form-control" data-toggle="modal" data-target="#modal_item">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
                <div class="form-group">
                    <label for="item_name">nama barang<span class="text-danger">#</span></label>
                    <input type="text" class="form-control" name="item_name" id="item_name" placeholder="nama barang*" readonly>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md">
                            <label for="stock">inisial stok<span class="text-danger">#</span></label>
                            <input type="text" name="stock" id="stock" value="-" class="form-control" readonly>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="detail">detail<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="detail" placeholder="kulakan/tambahan/etc*" required>
                </div>
                <div class="form-group">
                    <label for="supplier_id">pemasok<span class="text-danger">*</span></label>
                    <select name="supplier_id" class="form-control" required>
                        <option value="">-- pilih --</option>
                        <?php foreach ($supplier->result() as $s) : ?>
                            <option value="<?= $s->supplier_id; ?>"><?= $s->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="qty">qty<span class="text-danger">*</span></label>
                    <input type="number" class="form-control" name="qty" placeholder="jumlah*" required autofocus>
                </div>
                <button type="submit" name="add_process" class="btn btn-primary float-right ml-3"><i class="fas fa-save"></i> simpan</button>
                <button type="reset" class="btn btn-secondary float-right"><i class="fas fa-undo"></i> reset</button>
            </form>
        </div>
    </div>

</section>


<!-- modal -->
<div class="modal fade" id="modal_item" data-backdrop="static">
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
                                    <a class="float-left">Rp</a><a class="float-right"><?= number_format($i->price, 2, ',', '.'); ?></a>
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


<!-- script select in modal -->
<script type="text/javascript">
    $(document).ready(function() {
        $(document).on('click', '#select', function() {
            var $code = $(this).data('code');
            var $name = $(this).data('name');
            var $stock = $(this).data('stock');
            $('#item_code').val($code);
            $('#item_name').val($name);
            $('#stock').val($stock);
            $('#modal_item').modal('hide');
        });
    });
</script>