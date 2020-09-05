<?php 
date_default_timezone_set('America/Sao_Paulo');
include_once("conexao.php");
session_start();

$autor = $_SESSION['nome'];
$data = date ("Y-m-d");
$recado = $_POST['recado'];

$insert = "INSERT INTO `tbmural` (`DATARECADO`, `RECADO`, `AUTOR`) VALUES ('$data', '$recado', '$autor')";
$query = mysqli_query($con, $insert);
if($insert){
    echo "<script> alert('Novo recado adicionado!');window.location.href='inicio.php'</script>";
}
else{
    echo "<script> alert('Erro ao adicionar novo recado!');window.location.href='recados.php'</script>";
}
?>