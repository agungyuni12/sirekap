<?php 
include '../config/config.php';

$idrekap = $_POST['idrekap3'];
$kegiatan = $_POST['kegiatan'];
$honor = $_POST['honor'];

$sql = mysqli_query($conn,"UPDATE rekap SET kegiatan = '$kegiatan',honor = '$honor' WHERE id = '$idrekap'");


?>
