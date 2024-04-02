<?php
include '../config/config.php';

if(isset($_POST['query'])){
    $InpText=$_POST['query'];
    $query="SELECT idsobat,nmitra FROM mitra WHERE idsobat LIKE '%$InpText%' OR nmitra LIKE '%$InpText%' OR CONCAT(idsobat,'/', nmitra) LIKE '%$InpText%'";
    $result = $conn->query($query);
    if($result->num_rows>0){
        while($row=$result->fetch_assoc()){
            echo "<a href='#' class = 'list-group-item list-group-item-action border-1'>".$row['idsobat']."/".$row['nmitra']."</a>";
        }
    }
    else {
        echo "<p class = 'list-group-item border-1'>Tidak ada baris</p>";
    }
}
?>