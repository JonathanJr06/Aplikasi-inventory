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
                                <th>Nama</th>
                                <th>Telp</th>
                                <th>Alamat</th>
                                <th>Tanggal Tagihan</th>
                                <th>Nominal</th>
                                <th>Status</th>
                                <th>Tagihan Bulan Ini</th>
                                <th>Terdaftar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no = 1;
                                foreach ($pelanggan->result_array() as $row) {
                            ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $row['nama'] ?></td>
                                    <td><?= $row['telp'] ?></td>
                                    <td><?= $row['alamat'] ?></td>
                                    <td><?= $row['tgltagihan'] ?></td>
                                    <td>Rp. <?= number_format($row['nominal'],0,',','.') ?></td>
                                    <td>
                                        <?php if($row['status'] == 'Aktif') { ?>
                                            <div class="label label-success"><div class="fa fa-check"></div> <?= $row['status'] ?></div>
                                        <?php } else { ?>
                                            <div class="label label-danger"><div class="fa fa-close"></div> <?= $row['status'] ?></div>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php
                                            $this->db->where('idPelanggan', $row['id']);
                                            $this->db->where('MONTH(tanggal)', date('m'));
                                            $this->db->where('YEAR(tanggal)', date('Y'));
                                            $tagihan = $this->db->get('tb_pembayaran');
                                        ?>
                                            <?php
                                                if(!empty($tagihan->num_rows())) {
                                                    foreach ($tagihan->result() as $dLns) {
                                                        $this->db->where('id', $dLns->idUser);
                                                        foreach ($this->db->get('tb_user')->result() as $dLusr) {
                                                            
                                                        }
                                                    }
                                            ?>
                                                <div class="label label-success"><div class="fa fa-check"></div> Lunas - Admin : <?= $dLusr->nama ?></div>
                                            <?php } else { ?>
                                                <div class="label label-danger"><div class="fa fa-close"></div> Belum Bayar</div>
                                            <?php } ?>
                                    </td>
                                    <td><?= date('d F Y H:i:s', strtotime($row['terdaftar'])) ?></td>
                                    <td>
                                        <a href="<?= base_url('index.php/admin/pembayaran/detailpembayaran/').$row['id'] ?>" class="btn btn-info btn-sm">
                                            <div class="fa fa-eye"></div> Detail
                                        </a>
                                        <button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#editData<?= $row['id'] ?>">
                                            <div class="fa fa-edit"></div> Edit
                                        </button>
                                        <a href="<?= base_url('index.php/admin/pelanggan/delete/').$row['id'] ?>" class="btn btn-danger btn-xs tombol-yakin" data-isidata="Data yang berhubungan akan terhapus juga!">
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
            <form action="<?= base_url('index.php/admin/pelanggan/insert') ?>" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                                <input type="text" name="nama" class="form-control" placeholder="Nama" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Telp</label>
                                <input type="number" name="telp" class="form-control" placeholder="Telp" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Alamat</label>
                                <input type="text" name="alamat" class="form-control" placeholder="Alamat" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal Tagihan</label>
                                <select name="tgltagihan" class="form-control" required>
                                    <option value="" disabled selected> -- Pilih Tanggal Tagihan -- </option>
                                    <?php for ($i=1; $i <= 31; $i++) {  ?>
                                        <option value="<?= $i ?>"><?= $i ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nominal</label>
                                <input type="number" name="nominal" class="form-control" placeholder="Nominal" required>
                            </div>
                        </div>
                        <div class="col-md-12">
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
<?php foreach ($pelanggan->result() as $th) { ?>
<div class="modal fade" id="editData<?= $th->id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit <?= $title ?></h4>
            </div>
            <form action="<?= base_url('index.php/admin/pelanggan/update/').$th->id ?>" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                                <input type="text" name="nama" class="form-control" placeholder="Nama" value="<?= $th->nama ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Telp</label>
                                <input type="number" name="telp" class="form-control" placeholder="Telp" value="<?= $th->telp ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Alamat</label>
                                <input type="text" name="alamat" class="form-control" placeholder="Alamat" value="<?= $th->alamat ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal Tagihan</label>
                                <select name="tgltagihan" class="form-control" required>
                                    <option value="<?= $th->tgltagihan ?>" selected><?= $th->tgltagihan ?></option>
                                    <option value="" disabled> -- Pilih Tanggal Tagihan -- </option>
                                    <?php for ($i=1; $i <= 31; $i++) {  ?>
                                        <option value="<?= $i ?>"><?= $i ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nominal</label>
                                <input type="number" name="nominal" class="form-control" placeholder="Nominal" value="<?= $th->nominal ?>" required>
                            </div>
                        </div>
                        <div class="col-md-12">
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