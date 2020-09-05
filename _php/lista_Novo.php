<?php
include_once("conexao.php");

if(isset($_SESSION['idreq'])){
    $idreq = $_SESSION['idreq'];  
    $sql=("SELECT * FROM tbsolicitacoes WHERE IDREQ = '$idreq'");
    $result=mysqli_query($con,$sql);
        if(!empty($array = mysqli_fetch_array($result))){
            $result=mysqli_query($con,$sql);
            while ($array = mysqli_fetch_array($result)) {
                $newdados[] = array(
                    'IDREQ' => $array['IDREQ'],
                    'LOCAL' => $array['LOCAL'],
                    'TIPO' => $array['TIPO'],
                    'SUBTIPO' => $array['SUBTIPO'],
                    'TITULO' => $array['TITULO'],
                    'DESCRICAO' => $array['DESCRICAO'],
                    'STATUS' => $array['STATUS'],
                    'AREA' => $array['AREA'],
                );
            }
        }
}


?>