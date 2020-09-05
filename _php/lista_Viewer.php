<?php
include_once("conexao.php");

if(isset($_SESSION['ID_REQ'])){
    $idreq = $_SESSION['ID_REQ'];  
    $sql=("SELECT * FROM tbsolicitacoes WHERE IDREQ = '$idreq'");
    $result=mysqli_query($con,$sql);
        if(!empty($array = mysqli_fetch_array($result))){
            $result=mysqli_query($con,$sql);
            while ($array = mysqli_fetch_array($result)) {
                $viewer_Dados[] = array(
                    'IDREQ' => $array['IDREQ'],
                    'LOCAL' => $array['LOCAL'],
                    'TIPO' => $array['TIPO'],
                    'SUBTIPO' => $array['SUBTIPO'],
                    'TITULO' => $array['TITULO'],
                    'DESCRICAO' => $array['DESCRICAO'],
                    'STATUS' => $array['STATUS'],
                    'AREA' => $array['AREA'],
                    'REQUISITANTE'=> $array['REQUISITANTE'],
                    'DATAREQ' => $array['DATAREQ'],
                    'DATAENC' => $array['DATAENC'],
                    'DATAMOD' => $array['DATAMOD'],
                    'EDITOR' => $array['EDITOR'],
                    'ANEXO1' => $array['ANEXO1'],
                    'ANEXO2' => $array['ANEXO2'],
                    'ANEXO3' => $array['ANEXO3'],
                    'ANEXO4' => $array['ANEXO4'],
                    'ANEXO5' => $array['ANEXO5'],
                );
            }
        }
}


?>