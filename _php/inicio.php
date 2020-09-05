<?php
include_once("conexao.php");

date_default_timezone_set('America/Sao_Paulo');

session_start();

if (empty($_SESSION['nome'])) {
    return header('location: ../login.html');
}
$setor = $_SESSION['setor'];
$user = $_SESSION['usuario'];
$artigo = '';

//SQL para carregar os 4 ultimos registros das solicitações...
    if($setor != 'Owner'){
        $sql=("SELECT * FROM tbsolicitacoes WHERE AREA = '$setor' AND `STATUS` = 'NOVO' ORDER BY IDREQ desc LIMIT 4");
        $result=mysqli_query($con,$sql);
        if(!empty($array = mysqli_fetch_assoc($result))){
            $result=mysqli_query($con,$sql);
            while (!empty($array = mysqli_fetch_assoc($result))) {
                $ultimas_sol[] = array(
                    'IDREQ' => $array['IDREQ'],
                    'TITULO'=> $array['TITULO'],
                    'DESCRICAO'=> $array['DESCRICAO'],
                    'DATAREQ' => date('d/m/Y', strtotime($array['DATAREQ'])),
                );
            }   
                for ($i=0; $i < count($ultimas_sol); $i++) { 
                    $artigo = $artigo."
                    <div class='col-12 col-sm-6 col-md-4 col-lg-3 ultimos'>
                        <article>
                            <h2><a href='minhas_Solicitacoes.php?lista=edit&IDREQ=".$ultimas_sol[$i]['IDREQ']."&edit_mode=false'>".resume($ultimas_sol[$i]['TITULO'],12)."</a></h2>
                            <h3>".$ultimas_sol[$i]['DATAREQ']."</h3>
                            <h4>".resume($ultimas_sol[$i]['DESCRICAO'],130)."</h4>
                        </article>
                    </div>";
                }
            }
        else{
            $artigo =  "
            <article class='col-12 col-sm-6 col-md-4 col-lg-3 ultimos' >
                <h2>Não há novas Solicitações</h2>
            </article>
        ";
        }
    }
    else{
        $sql=("SELECT * FROM tbsolicitacoes WHERE `STATUS` = 'NOVO' ORDER BY IDREQ desc LIMIT 4");
        $result=mysqli_query($con,$sql);
        if(!empty($array = mysqli_fetch_assoc($result))){
            $result=mysqli_query($con,$sql);
            while (!empty($array = mysqli_fetch_assoc($result))) {
                $ultimas_sol[] = array(
                    'IDREQ' => $array['IDREQ'],
                    'TITULO'=> $array['TITULO'],
                    'DESCRICAO'=> $array['DESCRICAO'],
                    'DATAREQ' => date('d/m/Y', strtotime($array['DATAREQ'])),
                );
            }   
                for ($i=0; $i < count($ultimas_sol); $i++) { 
                    $artigo = $artigo."
                    <div class='col-12 col-sm-6 col-md-4 col-lg-3 ultimos'>
                        <article>
                            <h2><a href='minhas_Solicitacoes.php?lista=edit&IDREQ=".$ultimas_sol[$i]['IDREQ']."&edit_mode=false'>".resume($ultimas_sol[$i]['TITULO'],12)."</a></h2>
                            <h3>".$ultimas_sol[$i]['DATAREQ']."</h3>
                            <h4>".resume($ultimas_sol[$i]['DESCRICAO'],130)."</h4>
                        </article>
                    </div>";
                }
            }
        else{
            $artigo = "
                <div class='col-12 col-sm-6 col-md-4 col-lg-3 ultimos' >
                    <article>
                        <h2>Não há novas Solicitações</h2>
                    </article>
                </div>
            ";
        }
    }



        //SQL para carregar os 4 ultimos registros da tabela recados...

        $sql=("SELECT * FROM tbmural ORDER BY ID desc LIMIT 4");
        $result=mysqli_query($con,$sql);
                if(!empty($array = mysqli_fetch_array($result))){
                    $result=mysqli_query($con,$sql);
                    while (!empty($array = mysqli_fetch_array($result))) {
                        $mural[] = array(
                            'DATA' => date('d/m/Y', strtotime($array['DATARECADO'])),
                            'RECADO' => $array['RECADO'],
                            'AUTOR' => $array['AUTOR'],
                        );
                    }
                    $mural_tag = '';
                    for ($i=0; $i < count($mural); $i++) { 
                            $mural_tag = $mural_tag."
                            <div class='col-12'>
                                <h3>".$mural[$i]['DATA']."</h3><p>".nl2br($mural[$i]['RECADO'])."<br>Por ".$mural[$i]['AUTOR']."<br><br></p>
                            </div>";
                    }
                }
                else{
                    $mural_tag = "
                    <div class='col-12 text-center'>
                        <h3>Sem recados!</h3>
                    </div>";
                }


        function resume( $var, $limite ){
            // Se o texto for maior que o limite, ele corta o texto e adiciona 3 pontinhos.
            if (strlen($var) > $limite)	{
                $var = substr($var, 0, $limite);
                $var = trim($var) . "...";
            }
            return $var;
        }

        if($setor == 'Owner'){
            $btsolicita = 'Todas Solicitações';
        }
        else{
            $btsolicita = 'Solicitações de '.$setor;
        }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>InterComm</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link rel="stylesheet" href="../_css/main.css">
</head>

<body>
    <header id="cabecalho" class="col-12">
        <div class="container">
            <div class="row">
                <div id="logo" class="col-10 col-sm-10 col-md-4 col-lg-4">
                    <img src="../_img/interComm_logo_mini.png" alt="Logotipo página" class="img-fluid">
                </div>

                <div id="menu" class="d-none d-md-block col-md-8 col-lg-8">
                    <nav>
                        <ul>
                            <li><a href="inicio.php">Início</a></li>
                            <li><a href="novo.php">Novo</a></li>
                            <li><a href="usuario.php">Usuário</a></li>
                            <li><a href="sair.php">Sair</a></li>
                        </ul>
                 </nav>
                </div>
                <div>
                    <nav id="menuSmhidden" class="menuSmm">
                        <ul>
                            <li><a href="inicio.php"> Início </a></li>
                            <li><a href="novo.php">  Novo  </a></li>
                            <li><a href="usuario.php">Usuário </a></li>
                            <li><a href="sair.php">Sair</a></li>
                        </ul>
                    </nav>
                </div>
                <div id="hamburguer" class="col-2 d-md-none">
                    <a href="javascript:;" id="btnMenu" class="btnMenuHamburguer">
						<i class="fas fa-bars"></i>
                    </a>
                </div>
            </div>
        </div>
    </header>
    <div id="faixa1"></div>
    
        <?php if($setor == 'Tecnologias'){ 
                echo "<div id='tables_Manager'>
                        <div class='container'>
                            <div class='row'>
                                <div class='col-12 col-sm-8 col-md-10 col-lg-12'>
                                    <div class='row'>
                                        <a id='link1' class='col-12 col-sm-6 col-md-4 col-lg-3 left_' href='add_no_banco.php'>Gerenciar Tabelas</a>   
                                        <a id='link2' class='col-12 col-sm-6 col-md-4 col-lg-3 left_' href='recados.php'>Criar novo recado</a>
                                        <a id='link3' class='col-12 col-sm-6 col-md-4 col-lg-3 left_' href='minhas_Solicitacoes.php'>$btsolicita</a>
                                        <a id='link4' class='col-12 col-sm-6 col-md-4 col-lg-3 left_' href='minhas_Solicitacoes.php?criadas_por=true'>Minhas Solicitações</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>";
                }
                else{
                    echo "<div id='tables_Manager'>
                    <div class='container'>
                        <div class='row'>
                            <div class='col-12 col-sm-8 col-md-10 col-lg-12'>
                                <div class='row'>   
                                    <a id='link2' class='col-6 col-sm-6 col-md-4 col-lg-3 left_' href='recados.php'>Criar novo recado</a>
                                    <a id='link3' class='col-12 col-sm-6 col-md-4 col-lg-3 left_' href='minhas_Solicitacoes.php'>$btsolicita</a>
                                    <a id='link4' class='col-12 col-sm-6 col-md-4 col-lg-3 left_' href='minhas_Solicitacoes.php?criadas_por=true'>Minhas Solicitações</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>";      
                }

           ?>

    <div id="artigos" class="container">
        <div class="row">
                <?php echo $artigo; ?>
        </div>
    </div>

    <div id="mural" class="container">
        <div class="row">
            <h2 class="col-12 text-center">Mural de recados</h2>
            <?php echo $mural_tag; ?>
        </div>
    </div>

    <footer id="rodape3">

        <div id="faixa2"></div>

        <div id="faixa3">
            <br>
            <p>Douglas Barreto Oliveira - 2019 - Marília-SP - barreto_oliv@hotmail.com</p>
        </div>
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="../_js/main.js"></script>
</body>