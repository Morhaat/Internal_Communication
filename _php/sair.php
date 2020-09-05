<?php
date_default_timezone_set('America/Sao_Paulo');

session_start();
$_SESSION = array();

if (empty($_SESSION['nome'])) {
    return header('location: ../login.html');
}
?>