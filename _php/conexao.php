<?php

$servidor = '127.0.0.1';
$usuario = 'root';
$senhas = '';
$banco = 'dbinternalcommunication';

$con=mysqli_connect("$servidor","$usuario","$senhas","$banco");
// Check connection
if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>