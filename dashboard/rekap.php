<?php
include '../config/config.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../index.php");
}

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
              <form method="post">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- textarea -->
                      <div class="form-group">
                        <label>Bulan</label>
                        <select class="form-control" name="bulan" id = "bulan" required>
                          <option value="">Bulan</option>
                          <option value="Januari">Januari</option>
                          <option value="Februari">Februari</option>
                          <option value="Maret">Maret</option>
                          <option value="April">April</option>
                          <option value="Mei">Mei</option>
                          <option value="Juni">Juni</option>
                          <option value="Juli">Juli</option>
                          <option value="Agustus">Agustus</option>
                          <option value="September">September</option>
                          <option value="Oktober">Oktober</option>
                          <option value="November">November</option>
                          <option value="Desember">Desember</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Tahun</label>
                        <select class="form-control" name="tahun" id = "tahun" required>
                        <option value="">Tahun</option>
                        <?php
                          $sql = mysqli_query($conn,"SELECT DISTINCT tahun FROM rekap");
                          if ($sql!= false && $sql->num_rows > 0) {
                            while($row = $sql->fetch_assoc()) {
                            $tahun = $row['tahun'];
                            ?>
                              <option value="<?=$tahun;?>"><?=$tahun;?></option>
                            <?php
                            }
                          } 
                        ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary" name="cari" id="cari">Cari</button>
                    </div>
                  </div>
                </div>

              </form>
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Sobat ID</th>
                    <th>Nama Mitra</th>
                    <th>Bulan</th>
                    <th>Tahun</th>
                    <th>Total Honor</th>

                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    if(isset($_POST['cari'])){
                      $bulan = $_POST['bulan'];
                      $tahun = $_POST['tahun'];
                      $id = 1;
                      $sql1 = mysqli_query($conn,"SELECT SUM(honor) as total,idsobat,namamitra,bulan,tahun FROM rekap WHERE bulan = '$bulan' AND tahun = '$tahun' GROUP BY idsobat ORDER BY namamitra");
                      if ($sql1!= false && $sql1->num_rows > 0) {
                        while($row = $sql1->fetch_assoc()) {
                          $idsobat = $row['idsobat'];
                          $namamitra = $row['namamitra'];
                          $bulan = $row['bulan'];
                          $tahun = $row['tahun'];
                          $total = $row['total'];
                          if($total > 3346000){
                          ?>
                          <tr class="table-warning" style='cursor: pointer; cursor: hand;' onclick="window.location='detail.php?idsobat=<?=$idsobat;?>&bulan=<?=$bulan;?>&tahun=<?=$tahun;?>';">
                            <td><?=$id++;?></td>
                            <td><?=$idsobat;?></td>
                            <td><?=$namamitra;?></td>
                            <td><?=$bulan;?></td>
                            <td><?=$tahun;?></td>
                            <td><?=$total;?> (<?=$total-3346000;?>)</td>
                          </tr>
                          <?php
                          } else{
                            ?>
                          <tr style='cursor: pointer; cursor: hand;' onclick="window.location='detail.php?idsobat=<?=$idsobat;?>&bulan=<?=$bulan;?>&tahun=<?=$tahun;?>';">
                            <td><?=$id++;?></td>
                            <td><?=$idsobat;?></td>
                            <td><?=$namamitra;?></td>
                            <td><?=$bulan;?></td>
                            <td><?=$tahun;?></td>
                            <td><?=$total;?></td>
                          </tr>
                            <?php
                          }
                        }
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
<script src="../plugins/jquery/jquery.min.js"></script>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.29/dist/sweetalert2.min.js"></script>

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
