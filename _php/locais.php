<?php
$sql=("SELECT * FROM tblocais");
$result=mysqli_query($con,$sql);
if(!empty($array = mysqli_fetch_assoc($result))){
    $result=mysqli_query($con,$sql);
    while($array = mysqli_fetch_assoc($result)){
        $local_post[] = array(
        'IDLOCAL' => $array['IDLOCAL'],
        'LOCAL' => $array['LOCAL'],
        );
        $texto = $array['LOCAL'];
    }
}
else{
$local_post[] = array(
    'IDLOCAL' => '',
    'LOCAL' => 'Nenhum Resultado',
    );
}

$json_encode = json_encode($local_post);
echo $json_encode;

?>