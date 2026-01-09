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
        <div class="box">
            <div class="box-header">
                <h4 class="box-title">Cari Pelanggan</h4>
            </div>
            <form class="form-horizontal" action="<?= base_url('index.php/admin/pembayaran/cari/') ?>" method="POST">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nama Pelanggan</label>

                        <div class="col-sm-10">
                            <select name="idPelanggan" class="select2" style="width: 100%" required>
                                <option value="" disabled selected> -- Pilih Pelanggan -- </option>
                                <?php foreach ($pelanggan->result() as $dPlgn) { ?>
                                    <option value="<?= $dPlgn->id ?>"><?= $dPlgn->nama . ' - Rp. ' . number_format($dPlgn->nominal,0,',','.') ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right">
                        <div class="fa fa-search"></div> Search
                    </button>
                </div>
            </form>
        </div>
        <div class="box">
            <div class="box-header">
                <h4 class="box-title">Riwayat Pembayaran</h4>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover" id="dataTable">
                        <thead>
                            <tr>
                                <th width="10px">#</th>
                                <th>Tanggal</th>
                                <th>Admin</th>
                                <th>Pelanggan</th>
                                <th>Nominal</th>
                                <th>Terdaftar</th>
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
                                    <td>
                                        <?php
                                            $this->db->where('id', $row['idPelanggan']);
                                            foreach ($this->db->get('tb_pelanggan')->result() as $dPel) {
                                                echo $dPel->nama;
                                            }
                                        ?>
                                    </td>
                                    <td>Rp. <?= number_format($row['nominal'],0,',','.') ?></td>
                                    <td><?= date('d F Y H:i:s', strtotime($row['terdaftar'])) ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>