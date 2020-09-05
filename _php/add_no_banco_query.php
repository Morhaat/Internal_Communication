<?php 
include_once("conexao.php");



$sql=("SELECT * FROM tbsolicitacoes WHERE  = '1'");
$result=mysqli_query($con,$sql);
while($row=mysqli_fetch_object($result)) { 
    echo "<img src='getimagem.php?PicNum=$row->ANEXO1' \">"; 
}


?>