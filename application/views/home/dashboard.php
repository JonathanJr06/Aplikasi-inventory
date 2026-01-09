<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Dashboard
            <small>Control Panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('index.php/admin/dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Home</li>
        </ol>
    </section>
    <?php
    date_default_timezone_set('Asia/Jakarta');
    ?>
    <section class="content">
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>
                            <?php
                            echo $this->db->query('SELECT id FROM tb_master_data_barang')->num_rows();
                            ?>
                        </h3>

                        <p>Total Stock Barang</p>
                    </div>
                    <div class="icon">
                        <div class="fa fa-pie-chart"></div>
                    </div>
                    <a href="" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-blue">
                    <div class="inner">
                        <h3>
                            <?php
                            echo $this->db->query('SELECT id FROM tb_receiving')->num_rows();
                            ?>
                        </h3>
                        <p>Total Barang Masuk</p>
                    </div>
                    <div class="icon">
                        <div class="fa fa-bar-chart"></div>
                    </div>
                    <a href="#" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-purple">
                    <div class="inner">
                        <h3>
                            <?php
                            echo $this->db->query('SELECT id FROM tb_issuing')->num_rows();
                            ?>
                        </h3>
                        <p>Total Barang Keluar</p>
                    </div>
                    <div class="icon">
                        <div class="fa fa-truck"></div>
                    </div>
                    <a href="#" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>
                            <?php
                            echo $this->db->query('SELECT id FROM tb_category')->num_rows();
                            ?>
                        </h3>
                        <p>Total Kategori Barang</p>
                    </div>
                    <div class="icon">
                        <div class="fa fa-shopping-bag"></div>
                    </div>
                    <a href="#" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>
                            <?php
                            echo $this->db->query('SELECT id FROM tb_request')->num_rows();
                            ?>
                        </h3>
                        <p>Total Request Barang</p>
                    </div>
                    <div class="icon">
                        <div class="fa fa-diamond"></div>
                    </div>
                    <a href="#" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

        </div>
    </section>
</div>