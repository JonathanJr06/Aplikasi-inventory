<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title><?= $title ?></title>

        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
    <div class="container">
      <center><h3>REKAP DATA PEMBAYARAN WIFI</h3></center>
        <table>
          <tr>
            <td width="100px">Tanggal Rekap</td>
            <td>:</td>
            <td>
              <?php
              if ($tglawal == $tglakhir) {
                  echo date('d-M-Y', strtotime($tglawal));
              } else {
                echo date('d-M-Y', strtotime($tglawal)).'s/d'.date('d-M-Y', strtotime($tglakhir));
              }
              ?>
            </td>
          </tr>
          <tr>
              <td>Diunduh Pada</td>
              <td>:</td>
              <td>
                  <?php  
                  date_default_timezone_set("Asia/Jakarta");
                  echo date('d-M-Y H:i:s');
                  ?>
              </td>
          </tr>
        </table>
        <table class="table table-bordered table-striped table-hover" id="dataTable">
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
    </div>
        
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </body>
</html>