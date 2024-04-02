<?php
include '../config/config.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../index.php");
}

$idsobat3 = isset($_GET['idsobat']) ? $_GET['idsobat'] : '';
$bulan3 = isset($_GET['bulan']) ? $_GET['bulan'] : '';
$tahun3 = isset($_GET['tahun']) ? $_GET['tahun'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Badan Pusat Statistik Kabupaten Dompu</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.29/dist/sweetalert2.min.css">
  <script src="../plugins/jquery/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.29/dist/sweetalert2.min.js"></script>
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-primary navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>

    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->

      <!-- Messages Dropdown Menu -->

      <!-- Notifications Dropdown Menu -->


    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <img src="../dist/img/bps.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">BPS DOMPU</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class="nav-item menu-open">
            <a href="index.php" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                INPUT
              </p>
            </a>
          </li>
          <li class="nav-item menu-open">
            <a href="rekap.php" class="nav-link active">
              <i class="nav-icon fas fa-table"></i>
              <p>
                REKAP
              </p>
            </a>
          </li>
          <hr>
          <li class="nav-item menu-open">
            <a href="../config/logout.php" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                LOGOUT
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>REKAP</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">REKAP</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">REKAP</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Sobat ID</th>
                    <th>Nama Mitra</th>
                    <th>Kegiatan</th>
                    <th>Honor</th>
                    <th>Aksi</th>

                  </tr>
                  </thead>
                  <tbody>
                    <?php
                      $id = 1;
                      $sql1 = mysqli_query($conn,"SELECT * FROM rekap WHERE idsobat = '$idsobat3' AND bulan = '$bulan3' AND tahun = '$tahun3'");
                      if ($sql1!= false && $sql1->num_rows > 0) {
                        while($row = $sql1->fetch_assoc()) {
                          $idsobat = $row['idsobat'];
                          $namamitra = $row['namamitra'];
                          $kegiatan = $row['kegiatan'];
                          $honor = $row['honor'];
                          $idrekap = $row['id']
                            ?>
                          <tr>
                            <td><?=$id++;?></td>
                            <td><?=$idsobat;?></td>
                            <td><?=$namamitra;?></td>
                            <td><?=$kegiatan;?></td>
                            <td><?=$honor;?></td>
                            <td>
                              <a href="" data-toggle="modal" data-target="#modal2<?=$id-1;?>">
                              <i class="fas fa-edit"></i>
                              </a>
                              <a href="" data-toggle="modal" data-target="#modal1<?=$id-1;?>">
                                <i class="fas fa-trash-alt"></i>
                              </a>
                            </td>
                          </tr>
                              <div class="modal fade" id="modal1<?=$id-1;?>">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h4 class="modal-title">Apakah anda yakin ingin menghapus?</h4>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                      <button type="button" class="btn btn-primary" data-dismiss="modal">Tidak</button>
                                      <button type="button" class="btn btn-danger">Hapus</button>
                                    </div>
                                  </div>
                                  <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                              </div>
                              <div class="modal fade" id="modal2<?=$id-1;?>">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h4 class="modal-title">Edit</h4>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <form id="editkirim<?=$id-1;?>" method="post">
                                    <div class="modal-body">
                                      <input type="hidden" name="idrekap3" id="idrekap3" value="<?=$idrekap;?>">
                                      <div class="form-group">
                                        <label for="idsobat">Sobat ID</label>
                                        <input type="text" class="form-control" id="idsobat" name="idsobat" value="<?=$idsobat;?>" readonly>
                                      </div>
                                      <div class="form-group">
                                        <label for="namamitra">Nama Mitra</label>
                                        <input type="text" class="form-control" id="namamitra" name="namamitra" value="<?=$namamitra;?>" readonly>
                                      </div>
                                      <div class="form-group">
                                        <label for="kegiatan">Kegiatan</label>
                                        <input type="text" class="form-control" id="kegiatan" name="kegiatan" value="<?=$kegiatan;?>">
                                      </div>
                                      <div class="form-group">
                                        <label for="honor">Honor</label>
                                        <input type="text" class="form-control" id="honor" name="honor" value = "<?=$honor;?>">
                                      </div>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                                      <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                    </form>
                                  </div>
                                  <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                              </div>
                              <script>
                              $(function() {
                                $('#editkirim<?=$id-1;?>').submit(function(e) {
                                  e.preventDefault();
                                  var fd = new FormData(this);
                                    $.ajax({
                                        url: 'kedit.php',
                                        type: 'post',
                                        data: fd,
                                        contentType: false,
                                        processData: false,
                                    }).done(function(resp) {
                                          Swal.fire({
                                                icon:"success",
                                                title:"Berhasil ",
                                                text:" Data berhasil disimpan",
                                              }).then(function() {
                                                          window.location = "rekap.php"
                                                          });
                                    });
                                });
                              });
                              </script>
                            <?php
                          }
                        }
                    ?>
                  </tbody>

                </table>
              </div>
            </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <strong>Copyright &copy; 2024 <a href="https://dompukab.bps.go.id">Badan Pusat Statistik Kabupaten Dompu</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->

<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../plugins/jszip/jszip.min.js"></script>
<script src="../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>
</html>
