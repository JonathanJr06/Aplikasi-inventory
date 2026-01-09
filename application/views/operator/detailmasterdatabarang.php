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

            <div class="col-md-8">
                <div class="box">
                    <div class="box-header">
                        <h4 class="box-title">Detail Master Data Barang</h4>
                        <!--
                        <?php foreach ($masterdatabarang->result_array() as $m) {
                        ?>
                            <button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#editData<?= $m['id'] ?>">
                                <div class="fa fa-edit"></div> Edit
                            </button>
                        <?php } ?>
                        -->
                        <button class="btn btn-primary btn-sm pull-right" onclick="history.back(-1)">
                            <div class="fa fa-arrow-left"></div> Kembali
                        </button>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <?php foreach ($masterdatabarang->result_array() as $mdb) { ?>
                                    <tr>
                                        <td>Part Number</td>
                                        <td>:</td>
                                        <td><?= $mdb['part_number'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Description</td>
                                        <td>:</td>
                                        <td><?= $mdb['description'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Category</td>
                                        <td>:</td>
                                        <td>
                                            <?php
                                            $this->db->where('id', $mdb['id_category']);
                                            foreach ($this->db->get('tb_category')->result() as $dCatgory) {
                                                echo $dCatgory->category;
                                            }
                                            ?>
                                        </td>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Satuan</td>
                                        <td>:</td>
                                        <td>
                                            <?php
                                            $this->db->where('id', $mdb['id_uom']);
                                            foreach ($this->db->get('tb_uom')->result() as $dUom) {
                                                echo $dUom->nama_satuan;
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Move Type</td>
                                        <td>:</td>
                                        <td><?= $mdb['move_type'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Price</td>
                                        <td>:</td>
                                        <td><?= $mdb['price'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Remarks</td>
                                        <td>:</td>
                                        <td><?= $mdb['remarks'] ?></td>
                                    </tr>

                                <?php } ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box">
                    <div class="box-header">
                        <h4 class="box-title">Image</h4>

                    </div>
                    <div class="box-body">
                        <img src="<?= base_url('assets/imgproduct/') . $mdb['img'] ?>" width="200px">
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>