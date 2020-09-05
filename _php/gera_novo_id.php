<?php
include_once("conexao.php");

$sql=("SELECT IDREQ FROM tbsolicitacoes ORDER BY IDREQ DESC LIMIT 1");
$result=mysqli_query($con,$sql);
$array = mysqli_fetch_array($result);
    if(isset($array['IDREQ'])){
        $ultima = $array['IDREQ']+1;
    }
    else{
        $ultima = 563600;
    }
?>