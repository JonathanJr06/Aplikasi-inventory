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
                    <div class="fa fa-plus"></div> Tambah Barang Keluar
                </button>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover" id="dataTable">
                        <thead>
                            <tr>
                                <th width="10px">#</th>
                                <th>Tanggal</th>
                                <th>Kategori</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Qty</th>
                                <th>Satuan</th>
                                <th>Supplaier</th>
                                <th>Ket Penerima</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($issuing->result_array() as $row) {
                            ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $row['date'] ?></td>
                                    <td>
                                        <?php
                                        $this->db->where('id', $row['id_category']);
                                        foreach ($this->db->get('tb_category')->result() as $dProduct) {
                                            echo $dProduct->category;
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $this->db->where('id', $row['id_master_data_barang']);
                                        foreach ($this->db->get('tb_master_data_barang')->result() as $dProduct) {
                                            echo $dProduct->kd_barang;
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $this->db->where('id', $row['id_master_data_barang']);
                                        foreach ($this->db->get('tb_master_data_barang')->result() as $dProduct) {
                                            echo $dProduct->nama_barang;
                                        }
                                        ?>
                                    </td>
                                    <td><?= $row['jumlah'] ?></td>
                                    <td>
                                        <?php
                                        $this->db->where('id', $row['id_uom']);
                                        foreach ($this->db->get('tb_uom')->result() as $dProduct) {
                                            echo $dProduct->keterangan;
                                        }
                                        ?>
                                    </td>
                                    <td><?= $row['supplier'] ?></td>
                                    <td><?= $row['keterangan'] ?> </td>
                                    <td>
                                        <button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#editData<?= $row['id'] ?>">
                                            <div class="fa fa-edit"></div>Edit
                                        </button>
                                        <a href="<?= base_url('index.php/operator/issuing/delete/') . $row['id'] ?>" class="btn btn-danger btn-xs tombol-yakin" data-isidata="Data yang berhubungan akan terhapus juga!">
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
                <h4 class="modal-title" id="myModalLabel">Tambah <?= $title . $subtitle ?></h4>
            </div>
            <form action="<?= base_url('index.php/operator/issuing/insert_issuing') ?>" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal</label>
                                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
                                <input type="date" name="date" class="form-control" placeholder="Date" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Kategori</label>
                                <select name="id_category" class="form-control" style="width: 100%" required>
                                    <option value="" disabled selected> -- Pilih Kategori -- </option>
                                    <?php foreach ($category->result() as $dctg) { ?>
                                        <option value="<?= $dctg->id ?>"><?= $dctg->category ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Kode / Nama Barang</label>
                                <select name="id_master_data_barang" class="form-control" style="width: 100%" required>
                                    <option value="" disabled selected> -- Pilih Barang -- </option>
                                    <?php foreach ($master_data_barang->result() as $pMstrdtbrng) { ?>
                                        <option value="<?= $pMstrdtbrng->id ?>"><?= $pMstrdtbrng->kd_barang ?> / <?= $pMstrdtbrng->nama_barang ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Qty</label>
                                <input type="text" name="jumlah" class="form-control" placeholder="Input Qty" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Satuan</label>
                                <select name="id_uom" class="select2" style="width: 100%" required>
                                    <option value="" disabled selected> -- Pilih Satuan -- </option>
                                    <?php foreach ($uom->result() as $dUom) { ?>
                                        <option value="<?= $dUom->id ?>"><?= $dUom->keterangan ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Supplier</label>
                                <input type="text" name="supplier" class="form-control" placeholder="Input Suplier" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Keterangan Penerima</label>
                                <input type="text" name="keterangan" class="form-control" placeholder="Keterangan Penerima" required>
                            </div>
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
            </form>
        </div>
    </div>
</div>


<!-- Modal Edit Data -->
<?php foreach ($issuing->result() as $re) { ?>
    <div class="modal fade" id="editData<?= $re->id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Edit <?= $title ?></h4>
                </div>
                <form action="<?= base_url('index.php/operator/issuing/updateIssuing/') . $re->id ?>" method="POST">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal</label>
                                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
                                    <input type="date" name="date" class="form-control" placeholder="Date" value="<?= $re->date ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kategori</label>
                                    <select name="id_category" class="form-control" style="width: 100%" required>
                                        <option value="" disabled selected> -- Pilih Kategori -- </option>
                                        <?php foreach ($category->result() as $dctg) { ?>
                                            <option value="<?= $dctg->id ?>" <?= $dctg->id == $re->id_category ? "selected" : null ?>><?= $dctg->category ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Kode / Nama Barang</label>
                                    <select name="id_master_data_barang" class="form-control" style="width: 100%" required>
                                        <option value="" disabled selected> -- Pilih Barang -- </option>
                                       <?php foreach ($master_data_barang->result() as $pMstrdtbrng) { ?>
                                            <option value="<?= $pMstrdtbrng->id ?>" <?= $pMstrdtbrng->id == $re->id_master_data_barang ? "selected" : null ?>><?= $pMstrdtbrng->kd_barang ?> / <?= $pMstrdtbrng->nama_barang ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Qty</label>
                                    <input type="text" name="jumlah" class="form-control" placeholder="jumlah" value="<?= $re->jumlah ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Satuan</label>
                                    <select name="id_uom" class="form-control" style="width: 100%" required>
                                        <option value="" disabled selected> -- Pilih Satuan -- </option>
                                       <?php foreach ($uom->result() as $dctg) { ?>
                                            <option value="<?= $dctg->id ?>" <?= $dctg->id == $re->id_uom ? "selected" : null ?>><?= $dctg->keterangan ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Supplier</label>
                                    <input type="text" name="supplier" class="form-control" placeholder="Supplier" value="<?= $re->supplier ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Keterangan Penerima</label>
                                    <input type="text" name="keterangan" class="form-control" placeholder="keterangan penerima" value="<?= $re->keterangan ?>" required>
                                </div>
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
                </form>
            </div>
        </div>
    </div>
<?php } ?>