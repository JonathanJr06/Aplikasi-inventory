<footer class="main-footer">
  <div class="pull-right hidden-xs">
    <b>Version</b> 1.0.0
  </div>
  <strong>Copyright &copy; <?= date('Y') ?> <a href="https://shopee.co.id/jagodigital" target="blank">Jagodigital</a>.</strong> All rights
  reserved.
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Create the tabs -->
  <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
    <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
    <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
  </ul>
  <!-- Tab panes -->
  <div class="tab-content">
    <!-- Home tab content -->
    <div class="tab-pane" id="control-sidebar-home-tab">
      <h3 class="control-sidebar-heading">Recent Activity</h3>
      <ul class="control-sidebar-menu">
        <li>
          <a href="javascript:void(0)">
            <i class="menu-icon fa fa-birthday-cake bg-red"></i>

            <div class="menu-info">
              <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

              <p>Will be 23 on April 24th</p>
            </div>
          </a>
        </li>
        <li>
          <a href="javascript:void(0)">
            <i class="menu-icon fa fa-user bg-yellow"></i>

            <div class="menu-info">
              <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

              <p>New phone +1(800)555-1234</p>
            </div>
          </a>
        </li>
        <li>
          <a href="javascript:void(0)">
            <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

            <div class="menu-info">
              <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

              <p>nora@example.com</p>
            </div>
          </a>
        </li>
        <li>
          <a href="javascript:void(0)">
            <i class="menu-icon fa fa-file-code-o bg-green"></i>

            <div class="menu-info">
              <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

              <p>Execution time 5 seconds</p>
            </div>
          </a>
        </li>
      </ul>
      <!-- /.control-sidebar-menu -->

      <h3 class="control-sidebar-heading">Tasks Progress</h3>
      <ul class="control-sidebar-menu">
        <li>
          <a href="javascript:void(0)">
            <h4 class="control-sidebar-subheading">
              Custom Template Design
              <span class="label label-danger pull-right">70%</span>
            </h4>

            <div class="progress progress-xxs">
              <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
            </div>
          </a>
        </li>
        <li>
          <a href="javascript:void(0)">
            <h4 class="control-sidebar-subheading">
              Update Resume
              <span class="label label-success pull-right">95%</span>
            </h4>

            <div class="progress progress-xxs">
              <div class="progress-bar progress-bar-success" style="width: 95%"></div>
            </div>
          </a>
        </li>
        <li>
          <a href="javascript:void(0)">
            <h4 class="control-sidebar-subheading">
              Laravel Integration
              <span class="label label-warning pull-right">50%</span>
            </h4>

            <div class="progress progress-xxs">
              <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
            </div>
          </a>
        </li>
        <li>
          <a href="javascript:void(0)">
            <h4 class="control-sidebar-subheading">
              Back End Framework
              <span class="label label-primary pull-right">68%</span>
            </h4>

            <div class="progress progress-xxs">
              <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
            </div>
          </a>
        </li>
      </ul>
      <!-- /.control-sidebar-menu -->

    </div>
    <!-- /.tab-pane -->
    <!-- Stats tab content -->
    <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
    <!-- /.tab-pane -->
    <!-- Settings tab content -->
    <div class="tab-pane" id="control-sidebar-settings-tab">
      <form method="post">
        <h3 class="control-sidebar-heading">General Settings</h3>

        <div class="form-group">
          <label class="control-sidebar-subheading">
            Report panel usage
            <input type="checkbox" class="pull-right" checked>
          </label>

          <p>
            Some information about this general settings option
          </p>
        </div>
        <!-- /.form-group -->

        <div class="form-group">
          <label class="control-sidebar-subheading">
            Allow mail redirect
            <input type="checkbox" class="pull-right" checked>
          </label>

          <p>
            Other sets of options are available
          </p>
        </div>
        <!-- /.form-group -->

        <div class="form-group">
          <label class="control-sidebar-subheading">
            Expose author name in posts
            <input type="checkbox" class="pull-right" checked>
          </label>

          <p>
            Allow the user to show his name in blog posts
          </p>
        </div>
        <!-- /.form-group -->

        <h3 class="control-sidebar-heading">Chat Settings</h3>

        <div class="form-group">
          <label class="control-sidebar-subheading">
            Show me as online
            <input type="checkbox" class="pull-right" checked>
          </label>
        </div>
        <!-- /.form-group -->

        <div class="form-group">
          <label class="control-sidebar-subheading">
            Turn off notifications
            <input type="checkbox" class="pull-right">
          </label>
        </div>
        <!-- /.form-group -->

        <div class="form-group">
          <label class="control-sidebar-subheading">
            Delete chat history
            <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
          </label>
        </div>
        <!-- /.form-group -->
      </form>
    </div>
    <!-- /.tab-pane -->
  </div>
</aside>
<!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- Sweet Alert -->
<script src="<?= base_url('assets') ?>/bower_components/sweetalert/sweetalert.min.js"></script>
<!-- jQuery 3 -->
<script src="<?= base_url('assets') ?>/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?= base_url('assets') ?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?= base_url('assets') ?>/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?= base_url('assets') ?>/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets') ?>/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url('assets') ?>/dist/js/demo.js"></script>
<!-- PACE -->
<script src="<?= base_url('assets') ?>/bower_components/pace/pace.min.js"></script>
<!-- Select2 -->
<script src="<?= base_url('assets') ?>/bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- Data Table -->
<script src="<?= base_url('assets') ?>/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets') ?>/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?= base_url('assets') ?>/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- CK Editor -->
<script src="<?= base_url('assets') ?>/bower_components/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
  var d = new Date();
  var hours = d.getHours();
  var minutes = d.getMinutes();
  var seconds = d.getSeconds();
  var hari = d.getDay();
  var namaHari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
  hariIni = namaHari[hari];
  var tanggal = ("0" + d.getDate()).slice(-2);
  var month = new Array();
  month[0] = "Januari";
  month[1] = "Februari";
  month[2] = "Maret";
  month[3] = "April";
  month[4] = "Mei";
  month[5] = "Juni";
  month[6] = "Juli";
  month[7] = "Agustus";
  month[8] = "September";
  month[9] = "Oktober";
  month[10] = "Nopember";
  month[11] = "Desember";
  var bulan = month[d.getMonth()];
  var tahun = d.getFullYear();
  var date = Date.now(),
    second = 1000;

  function pad(num) {
    return ('0' + num).slice(-2);
  }

  function updateClock() {
    var clockEl = document.getElementById('clock'),
      dateObj;
    date += second;
    dateObj = new Date(date);
    clockEl.innerHTML = '' + hariIni + ',  ' + tanggal + ' ' + bulan + ' ' + tahun + ' ' + pad(dateObj.getHours()) + ':' + pad(dateObj.getMinutes()) + ':' + pad(dateObj.getSeconds());
  }
  setInterval(updateClock, second);
</script>
<script>
  //Konfirmasi
  $('.tombol-yakin').on('click', function(e) {
    e.preventDefault();
    const href = $(this).attr('href');
    const isiData = $(this).data('isidata');
    swal({
      title: 'Apakah anda yakin?',
      text: isiData,
      icon: 'warning',
      buttons: true,
      dangerMode: true,
    }).then((willDelete) => {
      if (willDelete) {
        document.location.href = href;
      }
    });
  });

  // Data Table
  $(document).ready(function() {
    $('#dataTable').DataTable();
  });

  // Data Table
  $(document).ready(function() {
    $('.dataTable').DataTable();
  });

  // Notifikasi Success
  const flashData = $('.flash-data').data('flashdata');
  if (flashData) {
    swal({
      title: "Selamat!",
      text: flashData,
      icon: "success",
    });
  }

  // Notifikasi Error
  const flashDaraError = $('.flash-data-error').data('flashdataerror');
  if (flashDaraError) {
    swal({
      title: "Maaf!",
      text: flashDaraError,
      icon: "error",
    });
  }

  // Efek Loading
  $(document).ajaxStart(function() {
    Pace.restart()
  })

  $(function() {
    //Initialize Select2 Elements
    $('.select2').select2()
  })

  //Editor
  $(function() {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  })

  var rupiah1 = document.getElementById("rupiah1");
  rupiah1.addEventListener("keyup", function(e) {
    rupiah1.value = convertRupiah(this.value);
  });

  function convertRupiah(angka, prefix) {
    var number_string = angka.replace(/[^,\d]/g, "").toString(),
      split = number_string.split(","),
      sisa = number_string.length % 3,
      rupiah = number_string.substr(0, sisa),
      ribuan = number_string.substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
      separator = sisa ? "." : "";
      rupiah += separator + ribuan.join(".");
    }

    rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
    return prefix == undefined ? rupiah : rupiah ? prefix + rupiah : "";
  }

  // Sow Password
  $(document).ready(function() {
    $('#checkbox').click(function() {
      if ($(this).is(':checked')) {
        $('#password').attr('type', 'text');
      } else {
        $('#password').attr('type', 'password');
      }
    });
  });
</script>

<script>
  $(document).ready(function() {
    var i = 1;
    $('#add').click(function() {
      i++;
      $('#dynamic_field').append('<div class="modal-body"><div class="row"><div class="col-md-10"><div class="form-group"><input type="text" name="date" class="form-control" placeholder="Category" required></div></div></form>');
    });
    $(document).on('click', '.btn_remove', function() {
      var button_id = $(this).attr("id");
      $('#input' + button_id + '').remove();
    });
    $('#submit').click(function() {
      $.ajax({
        url: "name.php",
        method: "POST",
        data: $('#add_name').serialize(),
        success: function(data) {
          alert(data);
          $('#add_name')[0].reset();
        }
      });
    });
  });
</script>
<script language="javascript">
  function tambahHobi() {
    var idf = document.getElementById("idf").value;
    var stre;
    stre = "<p id='srow" + idf + "'><input type='text' size='40' name='product[]' placeholder='Nama Product' /> <input type='text' size='30' name='jumlah' placeholder='Jumlah' /> <a href='#' style=\"color:#3399FD;\" onclick='hapusElemen(\"#srow" + idf + "\"); return false;'>Hapus</a></p>";
    $("#divHobi").append(stre);
    idf = (idf - 1) + 2;
    document.getElementById("idf").value = idf;
  }

  function hapusElemen(idf) {
    $(idf).remove();
  }
</script>

<!-- Button Add More 

 $(document).ready(function() {
    $(".add-more").click(function() {
      var html = $(".copy").html();
      $(".after").after(html);
    });

    // saat tombol remove dklik control group akan dihapus 
    $("body").on("click", ".remove", function() {
      $(this).parents(".control-group").remove();
    });
  });
<script>
  function inputdata() {
    var id_description = document.getElementById('id_description').value;
    var jumlah = document.getElementById('jumlah').value;

    var table = document.getElementsByTagName('dataTable')[0];

    var baris = table.insertRow(table.rows.length / 0);

    var kol1 = baris.insertCell(0);
    var kol2 = baris.insertCell(1);

    kol1.innerHTML = id_description;
    kol2.innerHTML = jumlah;
  }
</script>
-->
<script type="text/javascript">

</script>
</body>

</html>