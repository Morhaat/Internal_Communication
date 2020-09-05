<?php 
include_once("conexao.php");

$selecao = $_GET['selecao'];
$id_select = $_GET['id'];
switch ($selecao) {
    case 'Local':
        $deletados='';
        $sql=("SELECT * FROM tblocais WHERE IDLOCAL = '$id_select'");
        $result=mysqli_query($con,$sql);
        $array = mysqli_fetch_array($result);
        $idlocal = $array['IDLOCAL'];
        $local = $array['LOCAL'];
            if($idlocal != ''){
                $query = ("DELETE FROM tblocais WHERE IDLOCAL = '$id_select'");
                $delete = mysqli_query($con, $query);
                    if($delete){
                        $sql2=("SELECT * FROM tbtipos WHERE IDLOCAL = '$id_select'");
                        $result2=mysqli_query($con,$sql2);
                        if(!empty($array2 = mysqli_fetch_assoc($result2))){
                            $result2=mysqli_query($con,$sql2);
                                while($array2 = mysqli_fetch_assoc($result2)){
                                    $id_tipo = $array2['IDTIPO'];
                                    $deletados = $deletados."{ TIPO: ".$array2['TIPO']." => <br> [   SUBTIPOS => ";
                                    $sql3=("SELECT * FROM tbsubtipos WHERE IDTIPO = '$id_tipo'");
                                    $result3=mysqli_query($con,$sql3);
                                        if(!empty($array3 = mysqli_fetch_assoc($result3))){
                                            $result3=mysqli_query($con,$sql3);
                                            while($array3 = mysqli_fetch_assoc($result3)){
                                                $deletados = $deletados.$array3['SUBTIPO'].";";
                                                $id_subtipo = $array3['IDSUBTIPO'];
                                                $query3 = ("DELETE FROM tbsubtipos WHERE IDSUBTIPO = '$id_subtipo'");
                                                $delete3 = mysqli_query($con, $query3);
                                            }
                                        }
                                    $deletados = $deletados."]<br>.................................................................}<br>";
                                }
                            }
                        $query2 = ("DELETE FROM tbtipos WHERE IDLOCAL = '$id_select'");
                        $delete2 = mysqli_query($con, $query2);
                        echo "
                        <div class='col-12 col-lg-6 janelas_addnb'>
                            <h3>Operação efetuada com sucesso!</h3>
                            <p>Você acabou de realizar a função delete no item:<br>
                            IDLOCAL: $idlocal;<br>
                            LOCAL: $local;<br>
                            $deletados</p>
                        </div>";
                    }
                    else{
                        echo "
                        <div class='col-12 col-lg-6 janelas_addnb'>
                            <h3>Algo deu errado!</h3>
                            <p>Você tentou realizar a função delete, mas algo não saiu como o esperado...</p>
                        </div>";
                    }

            }
            else{
                echo "
                <div class='col-12 col-lg-6 janelas_addnb'>
                    <h3>Algo deu errado!</h3>
                    <p>É necessário selecionar um local válido para esta ação!</p>
                </div>";   
            }
        break;
    case 'Tipo':
    $deletados='';
    $sql=("SELECT * FROM tbtipos WHERE IDTIPO = '$id_select'");
    $result=mysqli_query($con,$sql);
    $array = mysqli_fetch_array($result);
    $idtipo = $array['IDTIPO'];
    $tipo = $array['TIPO'];
        if($idtipo != ''){
            $query = ("DELETE FROM tbtipos WHERE IDTIPO = '$id_select'");
            $delete = mysqli_query($con, $query);
                if($delete){
                    $deletados = $deletados."{ SUBTIPOS: ";
                    $sql2=("SELECT * FROM tbsubtipos WHERE IDTIPO = '$id_select'");
                    $result2=mysqli_query($con,$sql2);
                    if(!empty($array2 = mysqli_fetch_assoc($result2))){
                        $result2=mysqli_query($con,$sql2);
                            while($array2 = mysqli_fetch_assoc($result2)){
                                $deletados = $deletados.$array2['SUBTIPO']."; ";
                                $subtipo = $array2['IDSUBTIPO'];
                                $query2 = ("DELETE FROM tbsubtipos WHERE IDSUBTIPO = '$subtipo'");
                                $delete2 = mysqli_query($con, $query2);
                            }
                        }
                    $deletados = $deletados.".................................................................}<br>";
                    echo "
                    <div class='col-12 col-lg-6 janelas_addnb'>
                        <h3>Operação efetuada com sucesso!</h3>
                        <p>Você acabou de realizar a função delete no item:<br>
                        IDTIPO: $idtipo;<br>
                        TIPO: $tipo;<br>
                        $deletados</p>
                    </div>";
                }
                else{
                    echo "
                    <div class='col-12 col-lg-6 janelas_addnb'>
                        <h3>Algo deu errado!</h3>
                        <p>Você tentou realizar a função delete, mas algo não saiu como o esperado...</p>
                    </div>";
                }

        }
        else{
            echo "
            <div class='col-12 col-lg-6 janelas_addnb'>
                <h3>Algo deu errado!</h3>
                <p>É necessário selecionar um tipo válido para esta ação!</p>
            </div>";   
        }
        break;
    case 'Subtipo':
    $sql=("SELECT * FROM tbsubtipos WHERE IDSUBTIPO = '$id_select'");
    $result=mysqli_query($con,$sql);
    $array = mysqli_fetch_array($result);
    $idsubtipo = $array['IDSUBTIPO'];
    $subtipo = $array['SUBTIPO'];
        if($idsubtipo != ''){
            $query = ("DELETE FROM tbsubtipos WHERE IDSUBTIPO = '$id_select'");
            $delete = mysqli_query($con, $query);
                if($delete){
                    echo "
                    <div class='col-12 col-lg-6 janelas_addnb'>
                        <h3>Operação efetuada com sucesso!</h3>
                        <p>Você acabou de realizar a função delete no item:<br>
                        IDUBTIPO: $idsubtipo;<br>
                        SUBTIPO: $subtipo;</p>
                    </div>";
                }
                else{
                    echo "
                    <div class='col-12 col-lg-6 janelas_addnb'>
                        <h3>Algo deu errado!</h3>
                        <p>Você tentou realizar a função delete, mas algo não saiu como o esperado...</p>
                    </div>";
                }

        }
        else{
            echo "
            <div class='col-12 col-lg-6 janelas_addnb'>
                <h3>Algo deu errado!</h3>
                <p>É necessário selecionar um subtipo válido para esta ação!</p>
            </div>";   
        }
        break;
    
    default:
        echo "Esse dispositivo irá se auto-explodir em 3, 2, 1....";
        break;
}
?>