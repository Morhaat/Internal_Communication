<?php
include_once("dados_Tabelas.php");


$selecao = $_GET['selecao'];

    switch ($selecao) {
        case 'tblocais':
            echo $div_Local;
            break;
        case 'tbtipos':
            echo $div_Tipo;
            break;
        case 'tbsubtipos':
            echo $div_Subtipo;
            break;
        
        default:
            $retorno = "";
            break;
    }
?>