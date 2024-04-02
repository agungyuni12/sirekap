<?php 
include '../config/config.php';

$idrekap = $_POST['idrekap4'];

$sql = mysqli_query($conn,"DELETE FROM rekap WHERE id = '$idrekap'");

?>
