<?php
date_default_timezone_set('America/Sao_Paulo');
function SOMA_ID($id, $tabela){
    if($tabela == 'tblocais'){
        $final = '';
        $ps = explode('Q',$id);
        $soma = $ps[1]+1;
            for ($i=0; $i < 3-strlen($soma); $i++) { 
            $final = $final.'0';
            }
        return "REQ".$final.$soma;
        }
    else if($tabela == 'tbtipos'){
            $final = '';
            $ps = explode('O',$id);
            $soma = $ps[1]+1;
                for ($i=0; $i < 3-strlen($soma); $i++) { 
                $final = $final.'0';
                }
            return "TPO".$final.$soma;
        }
    else if($tabela == 'tbsubtipos'){
            $final = '';
            $ps = explode('O',$id);
            $soma = $ps[1]+1;
                for ($i=0; $i < 3-strlen($soma); $i++) { 
                $final = $final.'0';
                }
            return "STPO".$final.$soma;
        }
}

$datamod = date ("Y-m-d");
$datamod = date('d/m/Y',strtotime($datamod));
$horas = date ("H:i:s");
session_start();
$user = $_SESSION['usuario'];


echo "Atualização realizada em ".$datamod." às ".$horas." por ".$user.".";
?>