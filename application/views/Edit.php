<section class="content pt-3 pb-3">

    <a type="button" href="<?= site_url('Profile'); ?>" class="btn btn-primary float-right"><i class="fas fa-arrow-left"></i> kembali</a>
    <br><br>
    <div class="card">
        <div class="card-body">
            <p>peringatan: tanda bintang (<b class="text-danger">*</b>) mengartikan <b>wajib</b> diisi</p>
            <?= form_open_multipart('Profile/edit_process') ?>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username" id="username" value="<?= $user['username']; ?>" readonly>
                <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" class="form-control" name="name" value="<?= $user['name']; ?>" id="name" placeholder="nama*" required>
                <?= form_error('name', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="address">Alamat</label>
                <input type="text" class="form-control" name="address" id="address" placeholder="alamat*" value="<?= $user['address']; ?>" required>
                <?= form_error('address', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="phone">Nomor Hp</label>
                <input type="text" class="form-control" name="phone" id="phone" placeholder="nomor hp*" value="<?= $user['phone']; ?>" required>
                <?= form_error('address', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm">
                        <label for="image">Foto</label>
                        <div class="row">
                            <div class="col-sm-1">
                                <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="img-thumbnail">
                            </div>
                            <div class="col-sm-11">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="image" name="image">
                                    <label class="custom-file-label" for="image">Cari foto...</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?= form_error('image', '<small class="text-danger">', '</small>'); ?>
                </div>
            </div>
            <button type="submit" class="btn btn-primary float-right"><i class="fas fa-paper-plane"></i> simpan</button>
            <?= form_close() ?>
        </div>
    </div>

</section>