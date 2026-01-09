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
    <section class="content">
        <div class="row">
            <div class="col-md-4">
                <div class="box">
                    <div class="box-header">
                        <h4 class="box-title">Informasi Pelanggan</h4>
                        <button class="btn btn-primary btn-sm pull-right" onclick="history.back(-1)">
                            <div class="fa fa-arrow-left"></div> Kembali
                        </button>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <?php foreach ($pelanggan->result_array() as $dPlgn) { ?>
                                    <tr>
                                        <td>Nama</td>
                                        <td>:</td>
                                        <td><?= $dPlgn['nama'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Telp</td>
                                        <td>:</td>
                                        <td><?= $dPlgn['telp'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td>:</td>
                                        <td><?= $dPlgn['alamat'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Tagihan</td>
                                        <td>:</td>
                                        <td><?= $dPlgn['tgltagihan'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Nominal</td>
                                        <td>:</td>
                                        <td>Rp. <?= number_format($dPlgn['nominal'],0,',','.') ?></td>
                                    </tr>
                                    <tr>
                                        <td>Status</td>
                                        <td>:</td>
                                        <td><?= $dPlgn['status'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Terdaftar</td>
                                        <td>:</td>
                                        <td><?= date('d F Y H:i:s', strtotime($dPlgn['terdaftar'])) ?></td>
                                    </tr>
                                <?php } ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="box">
                    <div class="box-header">
                        <h4 class="box-title">Riwayat Pembayaran</h4>
                        <button class="btn btn-primary btn-sm pull-right"data-toggle="modal" data-target="#tambahData">
                            <div class="fa fa-plus"></div> Tambah Data
                        </button>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover" id="dataTable">
                                <thead>
                                    <tr>
                                        <th width="10px">#</th>
                                        <th>Tanggal</th>
                                        <th>Admin</th>
                                        <th>Nominal</th>
                                        <th>Terdaftar</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $no = 1;
                                        foreach ($pembayaran->result_array() as $row) {
                                    ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= date('d F Y', strtotime($row['tanggal'])) ?></td>
                                            <td>
                                                <?php
                                                    $this->db->where('id', $row['idUser']);
                                                    foreach ($this->db->get('tb_user')->result() as $dUser) {
                                                        echo $dUser->nama;
                                                    }
                                                ?>
                                            </td>
                                            <td>Rp. <?= number_format($row['nominal'],0,',','.') ?></td>
                                            <td><?= date('d F Y H:i:s', strtotime($row['terdaftar'])) ?></td>
                                            <td>
                                                <button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#editData<?= $row['id'] ?>">
                                                    <div class="fa fa-edit"></div> Edit
                                                </button>
                                                <a href="<?= base_url('index.php/admin/pembayaran/delete/').$row['id'].'/'.$idPelanggan ?>" class="btn btn-danger btn-xs tombol-yakin" data-isidata="Ingin menghapus data pembayaran ini?">
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
                <h4 class="modal-title" id="myModalLabel">Tambah Pembayaran</h4>
            </div>
            <form action="<?= base_url('index.php/admin/pembayaran/insert/').$idPelanggan ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                        <input type="date" name="tanggal" class="form-control" placeholder="Tanggal" required>
                    </div>
                    <div class="form-group">
                        <label>Nominal</label>
                        <input type="number" name="nominal" class="form-control" value="<?= $dPlgn['nominal'] ?>" placeholder="Nominal" readonly required>
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
<?php foreach ($pembayaran->result() as $edit) { ?>
    <div class="modal fade" id="editData<?= $edit->id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Edit Pembayaran</h4>
                </div>
                <form action="<?= base_url('index.php/admin/pembayaran/update/').$edit->id.'/'.$idPelanggan ?>" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Tanggal</label>
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                            <input type="date" name="tanggal" class="form-control" value="<?= $edit->tanggal ?>" placeholder="Tanggal" required>
                        </div>
                        <div class="form-group">
                            <label>Nominal</label>
                            <input type="number" name="nominal" class="form-control" value="<?= $edit->nominal ?>" placeholder="Nominal" readonly required>
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