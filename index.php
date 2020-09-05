<?php 

session_start();
if (empty($_SESSION['nome'])) {
    return header('location: login.html');
}
else{
    return header('location: _php/inicio.php');
}


?>