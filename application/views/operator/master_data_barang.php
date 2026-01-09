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
                                <th>Kode Barang</th>
                                <th>Tanggal</th>
                                <th>Nama Barang</th>
                                <th>Kategori</th>
                                <th>Satuan</th>
                                <th>Stock</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($master_data_barang->result_array() as $m) {
                            ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $m['kd_barang'] ?></td>
                                    <td><?= $m['date'] ?></td>
                                    <td><?= $m['nama_barang'] ?></td>
                                    <td>
                                        <?php
                                        $this->db->where('id', $m['id_category']);
                                        foreach ($this->db->get('tb_category')->result() as $dcategory) {
                                            echo $dcategory->category;
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $this->db->where('id', $m['id_uom']);
                                        foreach ($this->db->get('tb_uom')->result() as $dUom) {
                                            echo $dUom->nama_satuan . ' _' . $dUom->keterangan;
                                        }
                                        ?>
                                    </td>
                                    <td><?= $m['stock'] ?></td>
                                    <td>
                                        <!-- <a href="<?= base_url('index.php/operator/master_data_barang/detailmasterdata/') . $m['id'] ?>" class="btn btn-info btn-xs">
                                            <div class="fa fa-eye"></div> Detail
                                        </a> -->
                                        <button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#editData<?= $m['id'] ?>">
                                            <div class="fa fa-edit"></div> Edit
                                        </button>
                                        <a href="<?= base_url('index.php/operator/master_data_barang/delete/') . $m['id'] ?>" class="btn btn-danger btn-xs tombol-yakin" data-isidata="Data yang berhubungan akan terhapus juga!">
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
            <form class="form-horizontal" action="<?= base_url('index.php/operator/master_data_barang/insert') ?>" method="POST" enctype="multipart/form-data">
                <div class="box-body">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label text">Kode Barang</label>
                        <div class="col-sm-10">
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
                            <input type="text" name="kd_barang" class="form-control" id="inputEmail3" placeholder="Kode Barang">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Date</label>
                        <div class="col-sm-10">
                            <input type="date" name="date" class="form-control" id="inputPassword3" placeholder="Date">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Nama Barang</label>
                        <div class="col-sm-10">
                            <input type="text" name="nama_barang" class="form-control" id="inputPassword3" placeholder="Nama Barang">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Kategori</label>
                        <div class="col-sm-10">
                            <select name="id_category" class="form-control select2" style="width: 100%" required>
                                <option value="" disabled selected>Pilih Kategori</option>
                                <?php foreach ($category->result() as $ctg) { ?>
                                    <option value="<?= $ctg->id ?>"><?= $ctg->category ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Satuan</label>
                        <div class="col-sm-10">
                            <select name="id_uom" class="form-control select2" style="width: 100%" required>
                                <option value="" disabled selected>Pilih Satuan</option>
                                <?php foreach ($uom->result() as $uo) { ?>
                                    <option value="<?= $uo->id ?>"><?= $uo->nama_satuan ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <!-- 
                        <div class="form-group">
                        <label class="col-sm-2 control-label">Move Type</label>
                        <div class="col-sm-10">
                            <select name="move_type" class="form-control">
                                <option value="" disabled selected>Chose type</option>
                                <option value="fast Moving">Fast Moving</option>
                                <option value="slow moving">Slow Moving</option>
                            </select>
                        </div>
                    </div> 
                    -->
                    <!-- <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Price</label>
                        <div class="col-sm-10">
                            <input type="text" name="price" class="form-control" id="inputPassword3" placeholder="Price">
                        </div>
                    </div> -->
                    <!-- <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Image</label>
                        <div class="col-sm-10">
                            <input type="file" name="img" class="form-control-file">
                        </div>
                    </div> -->
                    <!-- <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Remarks</label>
                        <div class="col-sm-10">
                            <input type="text" name="remark" class="form-control" id="inputPassword3" placeholder="Remarks">
                        </div>
                    </div> -->
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Stock</label>
                        <div class="col-sm-10">
                            <input type="text" name="stock" class="form-control" id="inputPassword3" placeholder="Stock">
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

            <!-- 
            <form class="form-horizontal" action="<?= base_url('index.php/operator/master_data_barang/insert') ?>" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Part Number</label>
                                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
                                <input type="text" name="part_number" class="form-control" placeholder="Part number" required>
                            </div>
                            <div class="form-group">
                                <label>Category</label>
                                <select name="id_category" class="select2" style="width: 100%" required>
                                    <option value="" disabled selected>Pilih Category</option>
                                    <?php foreach ($category->result() as $ctg) { ?>
                                        <option value="<?= $ctg->id ?>"><?= $ctg->category ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Brand</label>
                                <select name="id_brand" class="select2" style="width: 100%" required>
                                    <option value="" disabled selected>Pilih Category</option>
                                    <?php foreach ($category->result() as $ctg) { ?>
                                        <option value="<?= $ctg->id ?>"><?= $ctg->category ?></option>
                                    <?php } ?>
                                </select>
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
            -->
        </div>
    </div>
</div>


<!-- Modal Edit Data -->
<?php foreach ($master_data_barang->result() as $m) { ?>
    <div class="modal fade" id="editData<?= $m->id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Edit <?= $title ?></h4>
                </div>
                <form action="<?= base_url('index.php/operator/master_data_barang/update/') . $m->id ?>" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Kode Barang</label>
                                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
                                    <input type="text" name="kd_barang" class="form-control" placeholder="Kode Barang" value="<?= $m->kd_barang ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Nama Barang</label>
                                    <input type="text" name="nama_barang" class="form-control" placeholder="Nama Barang" value="<?= $m->nama_barang ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal</label>
                                    <input type="date" name="date" class="form-control" placeholder="Tanggal" value="<?= $m->date ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Kategori</label>
                                    <select name="id_category" class="form-control" required>
                                        <?php foreach ($category->result() as $ctg) { ?>
                                            <option value="<?= $ctg->id ?>" selected><?= $ctg->category ?></option>
                                        <?php } ?>
                                    </select>
                                    <!-- </div>
                                <div class="form-group">
                                    <label>Brand</label>
                                    <select name="id_brand" class="form-control" required>
                                        <?php foreach ($brand->result() as $dBrand) { ?>
                                            <option value="<?= $dBrand->id ?>" selected><?= $dBrand->brand ?></option>
                                        <?php } ?>
                                    </select>
                                </div> -->
                                    <div class="form-group">
                                        <label>Satuan</label>
                                        <select name="id_uom" class="form-control" required>
                                            <?php foreach ($uom->result() as $dUom) { ?>
                                                <option value="<?= $dUom->id ?>" selected><?= $dUom->keterangan ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <!-- <div class="form-group">
                                        <label>Move Type</label>
                                        <input type="text" name="move_type" class="form-control" placeholder="Move Type" value="<?= $m->move_type ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Price</label>
                                        <input type="text" name="price" class="form-control" placeholder="Price" value="<?= $m->price ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Remarks</label>
                                        <input type="text" name="remarks" class="form-control" placeholder="Remarks" value="<?= $m->remarks ?>" required>
                                    </div> -->
                                    <div class="form-group">
                                        <label>Stock</label>
                                        <input type="text" name="stock" class="form-control" placeholder="Stock" value="<?= $m->stock ?>" required>
                                    </div>
                                    <!-- <div class="form-group">
                                        <label>Image</label>
                                        <input type="file" name="img" class="form-control-file"> <br>
                                        <img src="<?= base_url('assets/imgproduct/') . $m->img ?> ?>" width="200px">
                                    </div> -->
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