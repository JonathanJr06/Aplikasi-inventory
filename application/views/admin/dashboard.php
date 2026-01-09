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
                                echo $this->db->query('SELECT id FROM tb_pelanggan')->num_rows();
                            ?>
                        </h3>

                        <p>Total Pelanggan</p>
                    </div>
                    <div class="icon">
                        <div class="fa fa-users"></div>
                    </div>
                    <a href="<?= base_url('index.php/admin/pelanggan') ?>" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-blue">
                    <div class="inner">
                        <h3>
                            <?php
                                $pelangganAktif = $this->db->query('SELECT id FROM tb_pelanggan WHERE status="Aktif"')->num_rows();
                                echo $pelangganAktif;
                            ?>
                        </h3>

                        <p>Total Pelanggan Aktif</p>
                    </div>
                    <div class="icon">
                        <div class="fa fa-check"></div>
                    </div>
                    <a href="<?= base_url('index.php/admin/pelanggan') ?>" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>
                            <?php
                                echo $this->db->query('SELECT id FROM tb_pelanggan WHERE status="Tidak Aktif"')->num_rows();
                            ?>
                        </h3>

                        <p>Total Pelanggan Tidak Aktif</p>
                    </div>
                    <div class="icon">
                        <div class="fa fa-close"></div>
                    </div>
                    <a href="<?= base_url('index.php/admin/pelanggan') ?>" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>
                            <?php
                                echo $this->db->query('SELECT id FROM tb_user WHERE level="Administrator"')->num_rows();
                            ?>
                        </h3>

                        <p>Total Administrator</p>
                    </div>
                    <div class="icon">
                        <div class="fa fa-user"></div>
                    </div>
                    <a href="<?= base_url('index.php/admin/user') ?>" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-purple">
                    <div class="inner">
                        <h3>
                            <?php
                                $sudahBayar = $this->db->query('SELECT DISTINCT(idPelanggan) FROM tb_pembayaran WHERE MONTH(tanggal)="'.date('m').'" AND YEAR(tanggal)="'.date('Y').'"')->num_rows();
                                echo $sudahBayar;
                            ?>
                        </h3>

                        <p>Sudah Bayar Bulan Ini</p>
                    </div>
                    <div class="icon">
                        <div class="fa fa-pencil"></div>
                    </div>
                    <a href="<?= base_url('index.php/admin/pelanggan') ?>" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>
                            <?php
                                echo $pelangganAktif - $sudahBayar;
                            ?>
                        </h3>

                        <p>Belum Bayar Bulan Ini</p>
                    </div>
                    <div class="icon">
                        <div class="fa fa-book"></div>
                    </div>
                    <a href="<?= base_url('index.php/admin/pelanggan') ?>" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-maroon">
                    <div class="inner">
                        <h3>
                            <?php
                                echo $this->db->query('SELECT id FROM tb_iprouter')->num_rows();
                            ?>
                        </h3>

                        <p>Total Data Router</p>
                    </div>
                    <div class="icon">
                        <div class="ion ion-stats-bars"></div>
                    </div>
                    <a href="<?= base_url('index.php/admin/data_router') ?>" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-teal">
                    <div class="inner">
                        <h3>
                            <?php
                                $belumBayar = $this->db->query('SELECT id FROM tb_pelanggan WHERE tgltagihan="8"')->num_rows();
                                echo $belumBayar;
                            ?>
                        </h3>

                        <p>Total Belum Bayar Bulan Kemarin</p>
                    </div>
                    <div class="icon">
                        <div class="ion ion-pie-graph"></div>
                    </div>
                    <a href="<?= base_url('index.php/admin/pelanggan') ?>" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>

        
        <div class="row">
            <!--
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header">
                        <h4 class="box-title">Pelanggan Aktif Belum Bayar Bulan Kemarin (<?= $bulanKemarin ?>)</h4>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable">
                                <thead>
                                    <tr>
                                        <th width="10px">#</th>
                                        <th>Nama</th>
                                        <th>Telp</th>
                                        <th>Alamat</th>
                                        <th>Tanggal Tagihan</th>
                                        <th>Nominal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $no = 1;
                                        foreach ($belumbayarKemarin->result_array() as $row) {
                                    ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $row['nama'] ?></td>
                                            <td><?= $row['telp'] ?></td>
                                            <td><?= $row['alamat'] ?></td>
                                            <td><?= $row['tgltagihan'] ?></td>
                                            <td>Rp. <?= number_format($row['nominal'],0,',','.') ?></td>
                                            <td>
                                                <a href="<?= base_url('index.php/admin/pembayaran/detailpembayaran/').$row['id'] ?>" class="btn btn-info btn-xs">
                                                    <div class="fa fa-eye"></div> Detail
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
            END -->
            
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h4 class="box-title">Pelanggan Aktif Belum Bayar Bulan Ini (<?= date('F Y') ?>)</h4>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable">
                                <thead>
                                    <tr>
                                        <th width="10px">#</th>
                                        <th>Nama</th>
                                        <th>Telp</th>
                                        <th>Alamat</th>
                                        <th>Tanggal Tagihan</th>
                                        <th>Nominal</th>
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
                                                <a href="<?= base_url('index.php/admin/pembayaran/detailpembayaran/').$row['id'] ?>" class="btn btn-info btn-xs">
                                                    <div class="fa fa-eye"></div> Detail
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