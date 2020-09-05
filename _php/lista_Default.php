<?php
include_once("conexao.php");

$setor = $_SESSION['setor'];
$user = $_SESSION['usuario'];

if(isset($_SESSION['CRIADAS_POR'])){
    $create = $_SESSION['CRIADAS_POR'];
    $sql=("SELECT * FROM tbsolicitacoes WHERE REQUISITANTE = '$create'");
    $result=mysqli_query($con,$sql);
        if(!empty($array = mysqli_fetch_array($result))){
            $result=mysqli_query($con,$sql);
            while ($array = mysqli_fetch_array($result)) {
                $dados_create[] = array(
                    'IDREQ' => $array['IDREQ'],
                    'TITULO' => $array['TITULO'],
                    'STATUS' => $array['STATUS'],
                    'DATAREQ' => $array['DATAREQ'],
                    'DATAMOD' => $array['DATAMOD'],
                    'DATAENC' => $array['DATAENC'],
                );
            }
        }
}
else{
    if($setor == 'Owner'){
        $sql=("SELECT * FROM tbsolicitacoes");
        $result=mysqli_query($con,$sql);
            if(!empty($array = mysqli_fetch_array($result))){
                $result=mysqli_query($con,$sql);
                while ($array = mysqli_fetch_array($result)) {
                    $dados[] = array(
                        'IDREQ' => $array['IDREQ'],
                        'TITULO' => $array['TITULO'],
                        'STATUS' => $array['STATUS'],
                        'DATAREQ' => $array['DATAREQ'],
                        'DATAMOD' => $array['DATAMOD'],
                        'DATAENC' => $array['DATAENC'],
                    );
                }
            }
    }
    else{
    $sql=("SELECT * FROM tbsolicitacoes WHERE AREA = '$setor'");
    $result=mysqli_query($con,$sql);
        if(!empty($array = mysqli_fetch_array($result))){
            $result=mysqli_query($con,$sql);
            while ($array = mysqli_fetch_array($result)) {
                $dados[] = array(
                    'IDREQ' => $array['IDREQ'],
                    'TITULO' => $array['TITULO'],
                    'STATUS' => $array['STATUS'],
                    'DATAREQ' => $array['DATAREQ'],
                    'DATAMOD' => $array['DATAMOD'],
                    'DATAENC' => $array['DATAENC'],
                );
            }
        }
    }
}
unset($_SESSION['CRIADAS_POR']);
?>