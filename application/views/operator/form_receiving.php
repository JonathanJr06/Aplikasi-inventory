<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <?= $title ?>
            <small><?= $subtitle ?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('index.php/operator/dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><?= $title ?></li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-10">
                <div class="box">
                    <div class="box-header">
                        <h4 class="box-title">Product</h4>
                        <button class="btn btn-primary btn-sm pull-right" onclick="history.back(-1)">
                            <div class="fa fa-arrow-left"></div> Back
                        </button>
                    </div>
                    <form action="<?= base_url('index.php/operator/receiving/form_receiving/') ?>" name="form1" method="POST" enctype="multipart/form-data">

                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">Barang</label>
                                <div class="col-sm-10">
                                    <input id="idf" value="1" type="hidden" />
                                    <select name="id_description" id="id_description" class="form-control select2" style="width: 100%" required>
                                        <option value="" disabled selected>Chosee Product</option>
                                        <?php foreach ($master_data_barang->result() as $product) { ?>
                                            <option value="<?= $product->id ?>"><?= $product->description ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" id="exampleFormControlInput1" class="col-sm-2 control-label text">Jumlah</label>
                                <div class="col-sm-10">
                                    <input type="text" name="jumlah" class="form-control" id="jumlah" placeholder="Jumlah">
                                </div>
                            </div>
                            <button type="button" onclick="tambahHobi(); return false;">Tambah Rincian Hobi</button>
                            <div id="divHobi"></div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary btn-sm pull-right">
                                <div class="fa fa-plus"></div> Save
                            </button>
                        </div>
                    </form>

                </div>
            </div>
            <!--
            <div class="col-md-7">
                <div class="box">
                    <div class="box-header">
                        <h4 class="box-title">Receiving Detail</h4>
                        <button class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#tambahData">
                            <div class="fa fa-plus"></div> Tambah Data
                        </button>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>id desc</th>
                                        <th>j</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            -->
        </div>
    </section>
</div>