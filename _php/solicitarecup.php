<?php
date_default_timezone_set('America/Sao_Paulo');
include_once("conexao.php");


$login = $_POST['usuario'];
$para = $_POST['email'];
$partsenha1 = date('dm');
$partsenha2 = date('his');
$autosenha = $partsenha1 + $partsenha2;
$assunto = 'Recuperacao de senha';
$msg = 'Olá! Utilize esta senha na tela de alteração de senha no campo "senha atual": ' . $autosenha;
$msg = wordwrap($msg,70);
$from = 'Internnal_Communication';

$sql=("SELECT * FROM tbusuarios WHERE USUARIO = '$login' AND EMAIL = '$para'");
$result=mysqli_query($con,$sql);
$array = mysqli_fetch_assoc($result);
$logarray = $array['USUARIO'];
$email = $array['EMAIL'];


if ($email == null || $email == '') {
  echo"<script language='javascript' type='text/javascript'>alert('não encontramos seu email em nossos cadastros, por favor digite os dados corretamente ou entre em contato com o adm do site!');
  window.location.href='../recupera.html';</script>";
}
else{
 $autosenha = MD5($autosenha);
 $query = "UPDATE tbusuarios SET SENHA = '$autosenha' WHERE USUARIO = '$login' AND EMAIL = '$email'";
 $edit = mysqli_query($con, $query);

if ($edit){
  if (mail($para, $assunto, $msg, $from)) {
    echo"<script language='javascript' type='text/javascript'>alert('Informações de recuperação enviado para o email cadastrado!');
   window.location.href='../index.html';</script>";  
    }
  else{
   echo"<script language='javascript' type='text/javascript'>alert('Ops... tivemos problemas em enviar a senha de recuperação, caso o problema persista entre em contato com o adm do site');
   window.location.href='../recupera.html';</script>";
   }
  }
}
?>