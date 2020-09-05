<?php
include_once("conexao.php");


$nome  = $_POST['nome'];
$email = $_POST['email'];
$login = $_POST['usuario'];
$senha = MD5($_POST['senha']);
$acesso = $_POST['acesso'];
$setor = $_POST['setor'];

$sql=("SELECT * FROM tbusuarios WHERE USUARIO = '$login'");
$result=mysqli_query($con,$sql);
$array = mysqli_fetch_array($result);
$logarray = $array['USUARIO'];

if($login == "" || $login == null){
    echo"<script charset='UTF-8' language='javascript' type='text/javascript'>alert('O campo login deve ser preenchido');window.location.href='#';</script>";

}else{
    if($logarray == $login){

        echo"<script charset='UTF-8' language='javascript' type='text/javascript'>alert('Esse usuario já existe');window.location.href='#';</script>";
        die();

    }else{

        $query = "INSERT INTO tbusuarios (NOME, EMAIL, USUARIO, SENHA, ACESSO, SETOR) VALUES ('$nome', '$email', '$login', '$senha','$acesso', '$setor')";

        $insert = mysqli_query($con, $query);

        if($insert){
            echo"<script charset='UTF-8' language='javascript' type='text/javascript'>alert('Usuário cadastrado com sucesso!.');window.location.href='usuario.php'</script>";
        }else{
            echo"<script charset='UTF-8' language='javascript' type='text/javascript'>alert('Não foi possível cadastrar este usuário');window.location.href='usuario.php'</script>";
        }
    }
}
?>