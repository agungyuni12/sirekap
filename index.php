<?php
include 'config/config.php';

session_start();

if (isset($_SESSION['username'])) {
	header('location: dashboard/index.php');
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
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.29/dist/sweetalert2.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a class="h1"><b>SIREKAP BPS DOMPU</b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Login</p>

      <form action="" method="post">
        <div class="input-group mb-3">
          <input class="form-control" name="usermail" id="usermail" placeholder="Email atau Username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" id="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" name="login" id="login" class="btn btn-primary btn-block">Masuk</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <!-- /.social-auth-links -->
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.29/dist/sweetalert2.min.js"></script>
<?php

if (isset($_POST['login'])) {
	$usermail = $_POST['usermail'];;
	$password = md5($_POST['password']);

	$sql = mysqli_query($conn,"SELECT * FROM user WHERE username = '$usermail' OR email = '$usermail' AND password = '$password'");
	if ($sql!= false && $sql->num_rows > 0) {
		$row = $sql->fetch_assoc();
		$_SESSION ['nama'] = $row['nama'];
		$_SESSION ['username'] = $row['username'];
		$_SESSION ['email'] = $row['email'];
		?>
			<script>
			Swal.fire({
				icon:"success",
				title:"Berhasil",
				text:"Selamat anda berhasil login"
			}).then(function() {
				window.location = "dashboard/index.php";

			})
			</script>
		<?php

	} else {
    ?>
    <script>
    Swal.fire({
      icon:"error",
      title:"Gagal login",
      text:"Silahkan masukan ulang username password yang benar"
    }).then(function() {
      window.location = "index.php";

    })
    </script>
  <?php
  }
}

?>

</body>
</html>
