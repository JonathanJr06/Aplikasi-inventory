<?php
  header("Content-type: application/vnd-ms-excel");
  header("Content-Disposition: attachment; filename=Export Data Pembayaran Wifi.xls");
?>

        <table>
          <tr>
            <td colspan="7"><center><label>REKAP DATA TAHANAN</label></center></td>
          </tr>
          <tr>
            <td colspan="7">
              <?php  
              if ($tglawal == $tglakhir) {
                echo 'Tanggal Rekap : '.date('d-M-Y', strtotime($tglawal));
              } else {
                echo 'Tanggal Rekap : '.date('d-M-Y', strtotime($tglawal)).' s/d '.date('d-M-Y', strtotime($tglakhir));
              }
              ?>
            </td>
          </tr>
          <tr>
            <td colspan="7">
              <?php  
              date_default_timezone_set("Asia/Jakarta");
              echo 'Tanggal Unduh : '.date('d-M-Y H:i');
              ?>
            </td>
          </tr>
          <tr>
            <td colspan="7">Pengunduh : <?= $this->session->userdata('level') ?></td>
          </tr>
        </table>
        <table>
                        <thead>
                            <tr>
                                <th width="10px">#</th>
                                <th>Nama</th>
                                <th>telp</th>
                                <th>Alamat</th>
                                <th>Tanggal Tagihan</th>
                                <th>nominal</th>
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
                                    <td><?= $row['nama'] ?></td>
                                    <td><?= $row['telp'] ?></td>
                                    <td><?= $row['alamat'] ?></td>
                                    <td><?= date('d-M-Y', strtotime($row['tgltagihan'])) ?></td>
                                    <td>Rp. <?= number_format($row['nominal'],0,',','.') ?></td>
                                    <td><?= date('d-M-Y H:i:s', strtotime($row['terdaftar'])) ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>