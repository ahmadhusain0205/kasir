<section class="content pt-3">

    <div class="card">
        <div class="card-header">
            <label for="profile" class="h3 text-primary">data diri</label>
            <div class="float-right">
                <a type="button" class="btn btn-warning" href="<?= site_url('Profile/edit_password'); ?>"><i class="fas fa-lock"></i> ubah sandi</a>
                <a type="button" class="btn btn-warning" href="<?= site_url('Profile/edit'); ?>"><i class="fas fa-edit"></i> ubah</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col my-auto">
                    <div class="row">
                        <div class="col-4 my-auto mx-auto">
                            <div class="row text-center">
                                <div class="col">
                                    <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="img-thumbnail img-circle" style="width: 100px;">
                                </div>
                            </div>
                            <br>
                            <div class="row text-center">
                                <div class="col">
                                    <div class="h3 text-primary"><?= $user['name']; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group row">
                                <label for="username" class="col-sm-2 col-form-label">Username</label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" name="username" value="<?= $user['username']; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <div class="form-group row">
                                <label for="phone" class="col-sm-2 col-form-label">Nomor Hp</label>
                                <div class="col-sm-10">
                                    <input type="number" readonly class="form-control-plaintext" name="phone" value="<?= $user['phone']; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <div class="form-group row">
                                <label for="address" class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" name="address" value="<?= $user['address']; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <div class="form-group row">
                                <label for="level" class="col-sm-2 col-form-label">Level</label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" name="level" value="<?php
                                                                                                                    if ($user['level'] == 1) {
                                                                                                                        echo 'Administrator';
                                                                                                                    } else {
                                                                                                                        echo 'Kasir';
                                                                                                                    }
                                                                                                                    ?>
                                    ">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row float-right">
                        <div class="col">
                            Terdaftar: <a class="text-danger"><?= date('D, d M Y', $user['date_created']); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>