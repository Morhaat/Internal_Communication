<?php
include_once("conexao.php");

$id_local = $_GET['id_local'];

$sql=("SELECT * FROM tbtipos WHERE IDLOCAL = '$id_local'");
$result=mysqli_query($con,$sql);
        if(!empty($array = mysqli_fetch_assoc($result))){
            $result=mysqli_query($con,$sql);
            $tipo_post[] = array(
                'IDTIPO' => '',
                'TIPO' => 'Selecione um tipo',
            );
            while($array = mysqli_fetch_assoc($result)){
                $tipo_post[] = array(
                    'IDTIPO' => $array['IDTIPO'],
                    'TIPO' => $array['TIPO'],
                    'SETOR' => $array['SETOR'],
                );
            }
        }
        else{
            $tipo_post[] = array(
                'IDTIPO' => '',
                'TIPO' => 'Nenhum Resultado',
            );
        }

$json_encode = json_encode($tipo_post);
echo $json_encode;

?>