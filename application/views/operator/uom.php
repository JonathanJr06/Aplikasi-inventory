<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <?= $title ?>
            <small><?= $subtitle ?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('index.php/operator/o_dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><?= $title ?></li>
        </ol>
    </section>
    <?php
    date_default_timezone_set('Asia/Jakarta');
    ?>
    <section class="content">
        <div class="box">
            <div class="box-header">
                <button class="btn btn-primary" data-toggle="modal" data-target="#tambahData">
                    <div class="fa fa-plus"></div> Tambah Data
                </button>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover" id="dataTable">
                        <thead>
                            <tr>
                                <th width="10px">#</th>
                                <th>Nama Satuan</th>
                                <th>Ketarangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($uom->result_array() as $u) {
                            ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $u['nama_satuan'] ?></td>
                                    <td><?= $u['keterangan'] ?></td>
                                    <td>
                                        <button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#editData<?= $u['id'] ?>">
                                            <div class="fa fa-edit"></div> Edit
                                        </button>
                                        <a href="<?= base_url('index.php/operator/uom/delete/') . $u['id'] ?>" class="btn btn-danger btn-xs tombol-yakin" data-isidata="Data yang berhubungan akan terhapus juga!">
                                            <div class="fa fa-trash"></div> Delete
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal Tambah Data -->
<div class="modal fade" id="tambahData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Tambah <?= $title ?></h4>
            </div>
            <form action="<?= base_url('index.php/operator/uom/insert') ?>" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nama Satuan</label>
                                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
                                <input type="text" name="nama_satuan" class="form-control" placeholder="Nama Satuan" required>
                            </div>
                            <div class="form-group">
                                <label>Keterangan</label>
                                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
                                <input type="text" name="keterangan" class="form-control" placeholder="keterangan" required>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="reset" class="btn btn-danger">
                                <div class="fa fa-trash"></div> Reset
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <div class="fa fa-save"></div> Save
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Data -->
<?php foreach ($uom->result() as $u) { ?>
    <div class="modal fade" id="editData<?= $u->id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Edit <?= $title ?></h4>
                </div>
                <form action="<?= base_url('index.php/operator/uom/update/') . $u->id ?>" method="POST">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Nama Satuan</label>
                                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
                                    <input type="text" name="nama_satuan" class="form-control" placeholder="Nama Satuan" value="<?= $u->nama_satuan ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
                                    <input type="text" name="keterangan" class="form-control" placeholder="keterangan" value="<?= $u->keterangan ?>" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="reset" class="btn btn-danger">
                                    <div class="fa fa-trash"></div> Reset
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <div class="fa fa-save"></div> Update
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>