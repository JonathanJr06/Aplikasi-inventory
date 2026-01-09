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
                        <h4 class="box-title">Information Receiving</h4>
                        <button class="btn btn-primary btn-sm pull-right" onclick="history.back(-1)">
                            <div class="fa fa-arrow-left"></div> Kembali
                        </button>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <?php foreach ($receiving->result_array() as $rcv) { ?>
                                    <tr>
                                        <td>Date</td>
                                        <td>:</td>
                                        <td><?= $rcv['date'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>No Receiving</td>
                                        <td>:</td>
                                        <td><?= $rcv['no_receiving'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Supplier</td>
                                        <td>:</td>
                                        <td><?= $rcv['supplier'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Keterangan penerima</td>
                                        <td>:</td>
                                        <td><?= $rcv['keterangan'] ?></td>
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
                        <h4 class="box-title">Transaksi Barang Masuk</h4>
                        <button class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#tambahData">
                            <div class="fa fa-plus"></div> Tambah Barang
                        </button>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover" id="dataTable">
                                <thead>
                                    <tr>
                                        <th width="10px">#</th>
                                        <th>Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Kategori</th>
                                        <th>Satuan</th>
                                        <th>Jumlah</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($productreceiving->result_array() as $row) {
                                    ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td>
                                                <?php
                                                $this->db->where('id', $row['id_master_data_barang']);
                                                foreach ($this->db->get('tb_master_data_barang')->result() as $dProduct) {
                                                    echo $dProduct->kd_barang;
                                                }
                                                ?></td>
                                            <td>
                                                <?php
                                                $this->db->where('id', $row['id_master_data_barang']);
                                                foreach ($this->db->get('tb_master_data_barang')->result() as $dProduct) {
                                                    echo $dProduct->nama_barang;
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                $this->db->where('id', $row['id_category']);
                                                foreach ($this->db->get('tb_category')->result() as $dUom) {
                                                    echo $dUom->category;
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                $this->db->where('id', $row['id_uom']);
                                                foreach ($this->db->get('tb_uom')->result() as $dUom) {
                                                    echo $dUom->keterangan;
                                                }
                                                ?>
                                            </td>
                                            <td><?= $row['jumlah'] ?></td>
                                            <td>
                                                <!--
                                                <button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#editData<?= $row['id'] ?>">
                                                    <div class="fa fa-edit"></div> Edit
                                                </button>
                                                --->
                                                <a href="<?= base_url('index.php/operator/receiving/deleteDetailReceiving/') . $row['id'] . '/' . $idReceiving ?>" class="btn btn-danger btn-xs tombol-yakin" data-isidata="Ingin menghapus data product ini?">
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
                <h4 class="modal-title" id="myModalLabel">Tambah Barang Masuk</h4>
            </div>
            <form action="<?= base_url('index.php/operator/receiving/insertDetailreceiving/') . $idReceiving ?>" method="POST">
                <div class="modal-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama Barang</label>
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
                            <select name="id_master_data_barang" class="select2" style="width: 100%" required>
                                <option value="" disabled selected> -- Pilih Barang -- </option>
                                <?php foreach ($masterDatabarang->result() as $pMstrdtbrng) { ?>
                                    <option value="<?= $pMstrdtbrng->id ?>"><?= $pMstrdtbrng->nama_barang ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Kategori</label>
                            <select name="id_category" class="select2" style="width: 100%" required>
                                <option value="" disabled selected> -- Pilih Kategori -- </option>
                                <?php foreach ($category->result() as $dctg) { ?>
                                    <option value="<?= $dctg->id ?>"><?= $dctg->category ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Satuan</label>
                            <select name="id_uom" class="select2" style="width: 100%" required>
                                <option value="" disabled selected> -- Pilih Satuan -- </option>
                                <?php foreach ($Uom->result() as $dUom) { ?>
                                    <option value="<?= $dUom->id ?>"><?= $dUom->keterangan ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Jumlah</label>
                            <input type="number" name="jumlah" class="form-control" placeholder="Isi Jumlah" required>
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
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Data -->
<?php foreach ($productreceiving->result() as $edit) { ?>
    <div class="modal fade" id="editData<?= $edit->id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Edit Product</h4>
                </div>
                <form action="<?= base_url('index.php/operator/receiving/updateDetailReceiving/') . $edit->id . '/' . $idReceiving ?>" method="POST">
                    <div class="modal-body">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Product</label>
                                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
                                <select name="tgltagihan" class="form-control" required>
                                    <?php foreach ($masterDatabarang->result() as $pMstrdtbrng) { ?>
                                        <option value="<?= $pMstrdtbrng->id ?>"><?= $pMstrdtbrng->description ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Satuan</label>
                                <select name="id_uom" class="select2" style="width: 100%" required>
                                    <?php
                                    $this->db->where('id', $row['id_master_data_barang']);
                                    ?>
                                    <?php foreach ($masterDatabarang->result() as $dUoms) { ?>
                                        <option value="<?= $dUoms->id ?>" <?php if ($Uoms->id == $Uom->id) ?>><?= $Uom->keterangan ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Jumlah</label>
                                <input type="number" name="jumlah" class="form-control" value="<?= $edit->jumlah ?>" placeholder="Nominal" required>
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
                </form>
            </div>
        </div>
    </div>
<?php } ?>