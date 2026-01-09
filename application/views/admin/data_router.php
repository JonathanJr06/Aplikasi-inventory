<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <?= $title ?>
            <small><?= $subtitle ?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('index.php/admin/dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
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
                                <th>Router</th>
                                <th>IP Router</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no = 1;
                                foreach ($iprouter->result_array() as $row) {
                            ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $row['router'] ?></td>
                                    <td><?= $row['ip_router'] ?></td>
                                    <td><?= $row['nama'] ?></td>
                                    <td><?= $row['alamat'] ?></td>
                                    <td>
                                        <?php if($row['status'] == 'Aktif') { ?>
                                            <div class="label label-success"><div class="fa fa-check"></div> <?= $row['status'] ?></div>
                                        <?php } else { ?>
                                            <div class="label label-danger"><div class="fa fa-close"></div> <?= $row['status'] ?></div>
                                        <?php } ?>
                                    </td>
                                    <td>

                                        <!-- Detail
                                        <a href="<?= base_url('index.php/admin/data_router/detailrouter/').$row['id'] ?>" class="btn btn-info btn-xs">
                                            <div class="fa fa-eye"></div> Detail
                                        </a>
                                        -->

                                        <button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#editData<?= $row['id'] ?>">
                                            <div class="fa fa-edit"></div> Edit
                                        </button>
                                        <a href="<?= base_url('index.php/admin/data_router/delete/').$row['id'] ?>" class="btn btn-danger btn-xs tombol-yakin" data-isidata="Data yang berhubungan akan terhapus juga!">
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
            <form action="<?= base_url('index.php/admin/data_router/insert') ?>" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Router</label>
                                <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                                <input type="text" name="router" class="form-control" placeholder="Router" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>IP Router</label>
                                <input type="text" name="ip_router" class="form-control" placeholder="IP Router" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" name="nama" class="form-control" placeholder="Nama" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Alamat</label>
                                <input type="text" name="alamat" class="form-control" placeholder="Alamat" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control" required>
                                    <option value="" disabled selected> -- Pilih Status -- </option>
                                    <option value="Aktif">Aktif</option>
                                    <option value="Tidak Aktif">Tidak Aktif</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-danger"><div class="fa fa-trash"></div> Reset</button>
                    <button type="submit" class="btn btn-primary"><div class="fa fa-save"></div> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Data -->
<?php foreach ($iprouter->result() as $th) { ?>
<div class="modal fade" id="editData<?= $th->id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit <?= $title ?></h4>
            </div>
            <form action="<?= base_url('index.php/admin/data_router/update/').$th->id ?>" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Router</label>
                                <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                                <input type="text" name="router" class="form-control" placeholder="Router" value="<?= $th->router ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>IP Router</label>
                                <input type="text" name="ip_router" class="form-control" placeholder="IP Router" value="<?= $th->ip_router ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="nama" name="nama" class="form-control" placeholder="Nama" value="<?= $th->nama ?>" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Alamat</label>
                                <input type="alamat" name="alamat" class="form-control" placeholder="Alamat" value="<?= $th->alamat ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control" required>
                                    <option value="Aktif" <?= ($th->status == 'Aktif') ? 'selected' : '' ?>>Aktif</option>
                                    <option value="Tidak Aktif" <?= ($th->status == 'Tidak Aktif') ? 'selected' : '' ?>>Tidak Aktif</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-danger"><div class="fa fa-trash"></div> Reset</button>
                    <button type="submit" class="btn btn-primary"><div class="fa fa-save"></div> Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php } ?>