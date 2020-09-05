<?php
include_once("conexao.php");

$id_tipo = $_REQUEST['id_tipo'];

$sql=("SELECT * FROM tbsubtipos WHERE IDTIPO = '$id_tipo'");
$result=mysqli_query($con,$sql);
        if(!empty($array = mysqli_fetch_assoc($result))){
            $result=mysqli_query($con,$sql);
            $tipo_post[] = array(
                'IDSUBTIPO' => '',
                'SUBTIPO' => 'Selecione um subtipo',
            );
            while($array = mysqli_fetch_assoc($result)){
                $tipo_post[] = array(
                    'IDSUBTIPO' => $array['IDSUBTIPO'],
                    'SUBTIPO' => $array['SUBTIPO'],
                    'SETOR' => $array['SETOR'],
                );
            }
        }
        else{
            $tipo_post[] = array(
                'IDSUBTIPO' => 'N/A',
                'SUBTIPO' => 'Nenhum Resultado',
            );
        }

$json_encode = json_encode($tipo_post);
echo $json_encode;

?>