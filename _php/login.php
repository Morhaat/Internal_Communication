<?php
include_once("conexao.php");

$login = $_POST['usuario'];
$senha = MD5($_POST['senha']);

$sql=("SELECT * FROM tbusuarios WHERE USUARIO = '$login' AND SENHA = '$senha'");
$result=mysqli_query($con,$sql);
$array = mysqli_fetch_assoc($result);
$logarray = $array['USUARIO'];
$senharray = $array['SENHA'];
$nome = $array['NOME'];
$acesso = $array['ACESSO'];
$setor = $array['SETOR'];
$email = $array['EMAIL'];

session_start();
$_SESSION['nome'] = $nome;
$_SESSION['usuario'] = $logarray;
$_SESSION['acesso'] = $acesso;
$_SESSION['setor'] = $setor;
$_SESSION['email'] = $email;

if($login == "" || $login == null){
    echo"<script language='javascript' type='text/javascript'>alert('O campo login deve ser preenchido');window.location.href='../index.php';</script>";

}
else{
    
    if($logarray == $login){

        if ($senharray == $senha) {
            echo"<script language='javascript' type='text/javascript'>
                  window.location.href='inicio.php'
                 </script>";
        }
        else{
            echo"<script language='javascript' type='text/javascript'>alert('Usuário e/ou senha incorretos!');window.location.href='../index.php'</script>";
        }
        die();

        }
    else{
      echo"<script language='javascript' type='text/javascript'>alert('Usuário e/ou senha incorretos!');window.location.href='../index.php'</script>";  
    }
    }
?>