<?php 
include '../config/config.php';

$username2 = $_POST['username2'];
$namamitra = $_POST['namamitra'];
$nmitra = explode("/",$namamitra);
$kegiatan = $_POST['kegiatan'];
$bulan = $_POST['bulan'];
$tahun = $_POST['tahun'];
$volume = $_POST['volume'];
$satuan = $_POST['satuan'];
$slain = $_POST['slain'];
$hsatuan = $_POST['hsatuan'];
$honor = $_POST['honor'];

if ($satuan == "Lainnya"){
    $sql = mysqli_query($conn,"INSERT INTO rekap(`username`, `idsobat`, `namamitra`, `kegiatan`, `bulan`, `tahun`,`volume`,`satuan`,`hsatuan`,`honor`) VALUES ('$username2', '$nmitra[0]', '$nmitra[1]', '$kegiatan', '$bulan', '$tahun','$volume','$slain','$hsatuan', '$honor')");
} else {
    $sql = mysqli_query($conn,"INSERT INTO rekap(`username`, `idsobat`, `namamitra`, `kegiatan`, `bulan`, `tahun`,`volume`,`satuan`,`hsatuan`,`honor`) VALUES ('$username2', '$nmitra[0]', '$nmitra[1]', '$kegiatan', '$bulan', '$tahun','$volume','$satuan','$hsatuan', '$honor')");
}


?>
