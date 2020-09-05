<?php
date_default_timezone_set('America/Sao_Paulo');
include_once("conexao.php");

$atual = MD5($_POST['atual']);
$nova = MD5($_POST['nova']);

session_start();
$login = $_SESSION['usuario'];
$email = $_SESSION['email'];

$sql=("SELECT * FROM tbusuarios WHERE USUARIO = '$login' AND SENHA = '$atual'");
$result=mysqli_query($con,$sql);
$array = mysqli_fetch_assoc($result);
$senha = $array['SENHA'];

 if ($senha == null || $senha == ''){
  echo"<script language='javascript' type='text/javascript'>alert('Usuário e/ou Senha incorretos');
  window.location.href='usuario.php';</script>"; 
 }
 else if ($atual == null || $atual == '') {
  echo"<script language='javascript' type='text/javascript'>alert('Preencha os campos corretamente');
  window.location.href='usuario.php';</script>";
 }
 else if ($nova == null || $nova == '') {
  echo"<script language='javascript' type='text/javascript'>alert('Preencha os campos corretamente');
  window.location.href='usuario.php';</script>";
 }
 else{
  $query ="UPDATE tbusuarios SET SENHA = '$nova' WHERE USUARIO = '$login'";
  $edit = mysqli_query($con,$query);
   if ($edit) {
     $hora = date('h:i', time());
     $data = date('d/m');
     $msg = 'Sua senha foi alterada no dia '.$data.' às '.$hora.', caso não tenha requisitado a alteração da mesma entre em contato com o adm do site';
     $msg = wordwrap($msg,70);
     $from = 'Internal_Communication';
     if (mail($email, 'Alteracao de senha', $msg, $from)) {
      $_SESSION = array();
      echo"<script language='javascript' type='text/javascript'>alert('Senha alterada com sucesso');
      window.location.href='../index.html';</script>";
     }
     else{
      $_SESSION = array();
      echo"<script language='javascript' type='text/javascript'>alert('Senha alterada com sucesso, porém nao conseguimos lhe enviar o email de alerta!');
      window.location.href='../index.html';</script>";
     }
   }
 }

?>