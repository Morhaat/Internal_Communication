<?php
include_once("conexao.php");
$selecao = $_GET['selecao'];


switch ($selecao) {
    case 'Local':
        if(isset($_GET['idprinc'])){
            if(!empty($_GET['nmprinc'])){
                $id = $_GET['idprinc'];
                $name = $_GET['nmprinc'];
                $sql = "INSERT INTO `tblocais`(`IDLOCAL`, `LOCAL`) VALUES ('$id', '$name')";
                $insert = mysqli_query($con, $sql);
                if($insert){
                    echo "
                    <div class='col-12 col-lg-6 janelas_addnb'>
                        <h3>Operação realizada com sucesso!</h3>
                        <p>Você executou a ação insert com os dados:<br>
                        IDLocal: $id;<br>
                        Local: $name;</p>
                    </div>";
                }
                else{
                    echo "
                    <div class='col-12 col-lg-6 janelas_addnb'>
                        <h3>Algo deu errado!</h3>
                        <p>Você executou e ação insert, mas algo não aconteceu como esperava...</p>
                    </div>";
                }
            }
            else{
                echo "
                <div class='col-12 col-lg-6 janelas_addnb'>
                    <h3>Algo deu errado!</h3>
                    <p>Você precisa digitar um nome para o novo local.</p>
                </div>";
            }
        }
        else{
            echo "
            <div class='col-12 col-lg-6 janelas_addnb'>
                <h3>Algo deu errado!</h3>
                <p>Dados inválidos.</p>
            </div>";
        }
        break;
    case 'Tipo':
    if(isset($_GET['idprinc'])){
        if(!empty($_GET['nmprinc'])){
            if(!empty($_GET['idsec'])){
                $idsec = $_GET['idsec'];
                $sql= "SELECT * FROM tblocais WHERE IDLOCAL = '$idsec'";
                $result = mysqli_query($con,$sql);
                if(!empty($array = mysqli_fetch_assoc($result))){
                    $nome_local = $array['LOCAL'];
                }
                if(!empty($_GET['nmsetor'])){
                    $setor = $_GET['nmsetor'];
                    $id = $_GET['idprinc'];
                    $name = $_GET['nmprinc'];
                    $sql = "INSERT INTO `tbtipos`(`IDTIPO`, `TIPO`, `IDLOCAL`, `SETOR`) VALUES ('$id', '$name', '$idsec', '$setor')";
                    $insert = mysqli_query($con, $sql);
                    if($insert){
                        echo "
                        <div class='col-12 col-lg-6 janelas_addnb'>
                            <h3>Operação realizada com sucesso!</h3>
                            <p>Você executou a ação insert com os dados:<br>
                            IDLocal: $idsec;<br>
                            Local: $nome_local;<br>
                            IDTipo: $id;<br>
                            Tipo: $name;<br>
                            Setor responsável: $setor;</p>
                        </div>";
                    }
                    else{
                        echo "
                        <div class='col-12 col-lg-6 janelas_addnb'>
                            <h3>Algo deu errado!</h3>
                            <p>Você executou e ação insert, mas algo não aconteceu como esperava...</p>
                        </div>";
                    }
                }
                else{
                    echo "
                    <div class='col-12 col-lg-6 janelas_addnb'>
                        <h3>Algo deu errado!</h3>
                        <p>Você precisa selecionar o setor correspondente à este tipo de Solicitação</p>
                    </div>";
                }
            }
            else{
                echo "
                    <div class='col-12 col-lg-6 janelas_addnb'>
                        <h3>Algo deu errado!</h3>
                        <p>Você precisa selecionar o Local correspondente à este tipo de Solicitação</p>
                    </div>";
            }
        }
        else{
            echo "
            <div class='col-12 col-lg-6 janelas_addnb'>
                <h3>Algo deu errado!</h3>
                <p>Você precisa digitar um nome para o novo tipo.</p>
            </div>";
        }
    }
    else{
        echo "
        <div class='col-12 col-lg-6 janelas_addnb'>
            <h3>Algo deu errado!</h3>
            <p>Dados inválidos.</p>
        </div>";
    }
        break;
    case 'Subtipo':
    if(isset($_GET['idprinc'])){
        if(!empty($_GET['nmprinc'])){
            if(!empty($_GET['idsec'])){
                $idsec = $_GET['idsec'];
                $sql= "SELECT * FROM tbtipos WHERE IDTIPO = '$idsec'";
                $result = mysqli_query($con,$sql);
                if(!empty($array = mysqli_fetch_assoc($result))){
                    $nome_local = $array['TIPO'];
                }
                if(!empty($_GET['nmsetor'])){
                    $setor = $_GET['nmsetor'];
                    $id = $_GET['idprinc'];
                    $name = $_GET['nmprinc'];
                    $sql = "INSERT INTO `tbsubtipos`(`IDSUBTIPO`, `SUBTIPO`, `IDTIPO`, `SETOR`) VALUES ('$id','$name', '$idsec', '$setor' )";
                    $insert = mysqli_query($con, $sql);
                    if($insert){
                        echo "
                        <div class='col-12 col-lg-6 janelas_addnb'>
                            <h3>Operação realizada com sucesso!</h3>
                            <p>Você executou a ação insert com os dados:<br>
                            IDTIPO: $idsec;<br>
                            TIPO: $nome_local;<br>
                            IDSUBTIPO: $id;<br>
                            SUBTIPO: $name;<br>
                            Setor responsável: $setor;</p>
                        </div>";
                    }
                    else{
                        echo "
                        <div class='col-12 col-lg-6 janelas_addnb'>
                            <h3>Algo deu errado!</h3>
                            <p>Você executou e ação insert, mas algo não como esperava...</p>
                        </div>";
                    }
                }
                else{
                    echo "
                    <div class='col-12 col-lg-6 janelas_addnb'>
                        <h3>Algo deu errado!</h3>
                        <p>Você precisa selecionar o setor correspondente à este tipo de solicitação</p>
                    </div>";
                }
            }
            else{
                echo "
                <div class='col-12 col-lg-6 janelas_addnb'>
                    <h3>Algo deu errado!</h3>
                    <p>Você precisa selecionar o Tipo correspondente à este Subtipo de solicitação</p>
                </div>";
            }
        }
        else{
            echo "
            <div class='col-12 col-lg-6 janelas_addnb'>
                <h3>Algo deu errado!</h3>
                <p>Você precisa digitar um nome para o novo subtipo.</p>
            </div>";
        }
    }
    else{
        echo "
        <div class='col-12 col-lg-6 janelas_addnb'>
            <h3>Algo deu errado!</h3>
            <p>Dados inválidos.</p>
        </div>";
    }
        break;
    
    default:
        # code...
        break;
}

?>