<?php
date_default_timezone_set('America/Sao_Paulo');
session_start();


if(isset($_GET['criadas_por'])){
    if($_GET['criadas_por']=='true'){
        $_SESSION['CRIADAS_POR'] = $_SESSION['usuario'];
    }
}

function resume( $var, $limite ){
    // Se o texto for maior que o limite, ele corta o texto e adiciona 3 pontinhos.
    if (strlen($var) > $limite)	{
        $var = substr($var, 0, $limite);
        $var = trim($var) . "...";
    }
    return $var;
}


if(isset($_GET['lista'])){
    if($_GET['lista'] == 'novo'){ 
        $sublinks = $_GET['lista'];
        $arquivo = 'lista_Novo.php';
    }
    else if($_GET['lista'] == 'edit'){
        $sublinks = $_GET['lista'];
        $arquivo = 'lista_Edit.php';
        $_SESSION['ID_REQ'] = $_GET['IDREQ'];
        $edit_mode = $_GET['edit_mode'];
    }
    else if($_GET['lista'] == 'viewer'){
        $sublinks = 'edit';
        $arquivo = 'lista_Viewer.php';
        $_SESSION['ID_REQ'] = $_GET['IDREQ'];
        $edit_mode = $_GET['edit_mode']; 
    }
    else if($_GET['lista'] == 'fecha'){
        $sublinks = $_GET['lista'];
        $arquivo = 'lista_Edit.php';
        $_SESSION['ID_REQ'] = $_GET['IDREQ'];
        $edit_mode = $_GET['edit_mode'];
    }
}
else{
    $sublinks = '';
    $arquivo = 'lista_Default.php';
    $_SESSION['EDIT_MODE'] = 'false';
}

include_once($arquivo);

    if(isset($_GET['IDREQ'])){
        $requisicao = $_GET['IDREQ'];
    }
    else{
        $requisicao = '';
    }


if(isset($edit_mode)){
    if($edit_mode == 'true'){
        $posicao = "self.scrollTo(0,document.getElementById('box_Titulo').offsetTop)";
     }
     else{
        $posicao = '';
     }
}
else{
    $posicao = '';
}


if (empty($_SESSION['nome'])) {
    return header('location: ../index.html');
}

$divs ='';
$linhas ='';
$botao_sim = '';

if(isset($dados)){
    for ($i=0; $i < count($dados) ; $i++) {
        if($dados[$i]['DATAENC'] != '0000-00-00'){
            $dataenc = date('d-m-Y',strtotime($dados[$i]['DATAENC']));
        }
        else{
            $dataenc = '--';
        }
        if($dados[$i]['DATAMOD'] != '0000-00-00'){
            $datamod = date('d-m-Y',strtotime($dados[$i]['DATAMOD']));
        }
        else{
            $datamod = '--';
        }
        $linhas =$linhas."<tr><td><a href='minhas_Solicitacoes.php?lista=edit&IDREQ=".$dados[$i]['IDREQ']."&edit_mode=false'>".$dados[$i]['IDREQ']."</a></td><td>".resume($dados[$i]['TITULO'], 40)."</td><td>".$dados[$i]['STATUS']."</td><td>".date('d-m-Y',strtotime($dados[$i]['DATAREQ']))."</td><td>".$datamod."</td><td>".$dataenc."</td></tr>";
    }
        $divs ="<table>
                    <tr><td>ID Solicitação</td><td>Título</td><td>Status</td><td>Data criação</td><td>Data atualização</td><td>Data fechamento</td></tr>".
                    $linhas."
                </table>";
}


if(isset($dados_create)){
    for ($i=0; $i < count($dados_create) ; $i++) {
        if($dados_create[$i]['DATAENC'] != '0000-00-00'){
            $dataenc = date('d-m-Y',strtotime($dados_create[$i]['DATAENC']));
        }
        else{
            $dataenc = '--';
        }
        if($dados_create[$i]['DATAMOD'] != '0000-00-00'){
            $datamod = date('d-m-Y',strtotime($dados_create[$i]['DATAMOD']));
        }
        else{
            $datamod = '--';
        }
        $linhas =$linhas."<tr><td><a href='minhas_Solicitacoes.php?lista=viewer&IDREQ=".$dados_create[$i]['IDREQ']."&edit_mode=false'>".$dados_create[$i]['IDREQ']."</a></td><td>".resume($dados_create[$i]['TITULO'], 40)."</td><td>".$dados_create[$i]['STATUS']."</td><td>".date('d-m-Y',strtotime($dados_create[$i]['DATAREQ']))."</td><td>".$datamod."</td><td>".$dataenc."</td></tr>";
    }
        $divs ="<table>
                    <tr><td>ID Solicitação</td><td>Título</td><td>Status</td><td>Data criação</td><td>Data atualização</td><td>Data fechamento</td></tr>".
                    $linhas."
                </table>";
}

if(isset($newdados)){
    for ($i=0; $i < count($newdados); $i++) { 
        $linhas = $linhas."<tr><td><a href='minhas_Solicitacoes.php?lista=edit&IDREQ=".$newdados[$i]['IDREQ']."&edit_mode=false'>".$newdados[$i]['IDREQ']."</a></td><td>".$newdados[$i]['LOCAL']."</td><td>".$newdados[$i]['TIPO']."</td><td>".$newdados[$i]['SUBTIPO']."</td><td>".resume($newdados[$i]['TITULO'], 40)."</td><td>".$newdados[$i]['STATUS']."</td><td>".$newdados[$i]['AREA']."</td></tr>";
        $descricao = nl2br($newdados[$i]['DESCRICAO']);
    }
    $divs ="<table>
    <tr><td>ID Solicitação</td><td>Local</td><td>Tipo</td><td>SubTipo</td><td>Titulo</td><td>Status</td><td>Área</td></tr>".
    $linhas."
    </table>"."<br><div id='desc'><p>Descrição<br>".$descricao."</p></div>";
}

    if(isset($editdados)){
        $idreq_ = $editdados[0]['IDREQ'];
        $local_ = $editdados[0]['LOCAL'];
        $tipo_ = $editdados[0]['TIPO'];
        $subtipo_ = $editdados[0]['SUBTIPO'];
        $titulo_ ="<input type='text' name='titulo' id='titulo' value='".$editdados[0]['TITULO']."' readonly='true'>" ;
            if($editdados[0]['STATUS'] == 'FECHADO'){
                $mensagem_ = "<textarea name='textMensagem' id='textMensagem' class='col-12 col-sm-12 col-md-12 col-lg-8' rows='10' readonly='true'>".$editdados[0]['DESCRICAO']."</textarea>";
                $data_status = "<div class='col-12 col-sm-12 col-md-6 col-lg-4 div_Campos'>
                                    <label><strong>Data fechamento</strong></label>
                                    <br>
                                    ".date('d-m-Y',strtotime($editdados[0]['DATAENC']))."
                                </div>

                                <div class='col-12 col-sm-12 col-md-6 col-lg-4 div_Campos'>
                                    <label><strong>Responsável</strong></label>
                                    <br>
                                    ".$editdados[0]['EDITOR']."
                                </div>";
                                $btsalvar = '';
            }
            else if($editdados[0]['STATUS'] == 'ATUALIZADO'){
                $data_status = "<div class='col-12 col-sm-12 col-md-6 col-lg-4 div_Campos'>
                                    <label><strong>Data modificação</strong></label>
                                    <br>
                                    ".date('d-m-Y',strtotime($editdados[0]['DATAMOD']))."
                                </div>

                                <div class='col-12 col-sm-12 col-md-6 col-lg-4 div_Campos'>
                                    <label><strong>Responsável</strong></label>
                                    <br>
                                    ".$editdados[0]['EDITOR']."
                                </div>";
                                if($edit_mode == 'false'){
                                    $mensagem_ = "
                                    <input type='button' value='  Editar solicitação  ' id='editar_req' onclick=window.location.href='minhas_Solicitacoes.php?lista=edit&IDREQ=".$editdados[0]['IDREQ']."&edit_mode=true'>
                                    <input type='button' value='  Encerrar solicitação  ' id='fechar_req' onclick=''>
                                    <br>
                                    <textarea name='textMensagem' id='textMensagem' class='col-12 col-sm-12 col-md-12 col-lg-8' rows='10' readonly='true'>".$editdados[0]['DESCRICAO']."</textarea>";
                                    $dataenc_ = "--/--/----";
                                    $btsalvar = "
                                    <div class='row'>    
                                        <input type='submit' value='  Salvar  ' id='salvar' disabled>
                                    </div>";
                                    $botao_sim = "<input type='Button' id='click_sim' name='click_sim' value=' Sim, encerrar! ' onclick=window.location.href='minhas_Solicitacoes.php?lista=fecha&IDREQ=".$editdados[0]['IDREQ']."&edit_mode=true'>";
                                }
                                else{
                                    $_SESSION['descricao'] = $editdados[0]['DESCRICAO'];
                                    $_SESSION['EDIT_MODE'] = 'true';
                                    $mensagem_ = "<textarea name='textMensagem' id='textMensagem' class='col-12 col-sm-12 col-md-12 col-lg-8' rows='10'></textarea>";
                                    $dataenc_ = "--/--/----";
                                    $btsalvar = "
                                    <div class='row'>    
                                        <input type='submit' value='  Salvar  ' id='salvar'>
                                    </div>";
                                }
            }
            else{
                $data_status = '';
                if($edit_mode == 'false'){
                    $mensagem_ = "
                    <input type='button' value='  Editar solicitação  ' id='editar_req' onclick=window.location.href='minhas_Solicitacoes.php?lista=edit&IDREQ=".$editdados[0]['IDREQ']."&edit_mode=true'>
                    <input type='button' value='  Encerrar solicitação  ' id='fechar_req' onclick=''>
                    <br>
                    <textarea name='textMensagem' id='textMensagem' class='col-12 col-sm-12 col-md-12 col-lg-8' rows='10' readonly='true'>".$editdados[0]['DESCRICAO']."</textarea>";
                    $dataenc_ = "--/--/----";
                    $btsalvar = "
                    <div class='row'>    
                        <input type='submit' value='  Salvar  ' id='salvar' disabled>
                    </div>";
                    $botao_sim = "<input type='Button' id='click_sim' name='click_sim' value=' Sim, encerrar! ' onclick=window.location.href='minhas_Solicitacoes.php?lista=fecha&IDREQ=".$editdados[0]['IDREQ']."&edit_mode=true'>";
                }
                else{
                    $_SESSION['descricao'] = $editdados[0]['DESCRICAO'];
                    $_SESSION['EDIT_MODE'] = 'true';
                    $mensagem_ = "<textarea name='textMensagem' id='textMensagem' class='col-12 col-sm-12 col-md-12 col-lg-8' rows='10'></textarea>";
                    $dataenc_ = "--/--/----";
                    $btsalvar = "
                    <div class='row'>    
                        <input type='submit' value='  Salvar  ' id='salvar'>
                    </div>";
                }
            }
        $status_ = $editdados[0]['STATUS'];
        $area_ = $editdados[0]['AREA'];
        $user_ = $editdados[0]['REQUISITANTE'];
        $datareq_ = date('d-m-Y',strtotime($editdados[0]['DATAREQ']));

            for ($i=1; $i < 6; $i++) { 
                if($editdados[0]['ANEXO'.$i] == ''){
                    $img[$i] = "<div id='div_Anexo".$i."' class='col-12 col-lg-4 edit_Anexos'>
                                    <label for='txtArquivo'><strong>Anexo ".$i."</strong></label>
                                    <br>
                                    <input type='file' class='col-12' accept='.jpg' name='arquivo".$i."' id='arquivo".$i."'>
                                </div>";
                }
                else{
                    $img[$i] = "<div id='div_Anexo".$i."' class='col-12 col-lg-4 edit_Anexos'>
                                    <label for='txtArquivo'><strong>Anexo ".$i."</strong></label>
                                    <br>
                                    <a href='".$editdados[0]['ANEXO'.$i]."'><img src='".$editdados[0]['ANEXO'.$i]."' alt='Anexo ".$i."' class='all_Img_Anexos'></a>
                                </div>";
                }
            }
            $img1_ = $img[1];
            $img2_ = $img[2];
            $img3_ = $img[3];
            $img4_ = $img[4];
            $img5_ = $img[5];
    }


    if(isset($viewer_Dados)){
        $idreq_ = $viewer_Dados[0]['IDREQ'];
        $local_ = $viewer_Dados[0]['LOCAL'];
        $tipo_ = $viewer_Dados[0]['TIPO'];
        $subtipo_ = $viewer_Dados[0]['SUBTIPO'];
        $titulo_ ="<input type='text' name='titulo' id='titulo' value='".$viewer_Dados[0]['TITULO']."' readonly='true'>" ;
            if($viewer_Dados[0]['STATUS'] == 'FECHADO'){
                $mensagem_ = "<textarea name='textMensagem' id='textMensagem' class='col-12 col-sm-12 col-md-12 col-lg-8' rows='10' readonly='true'>".$viewer_Dados[0]['DESCRICAO']."</textarea>";
                $data_status = "<div class='col-12 col-sm-12 col-md-6 col-lg-4 div_Campos'>
                                    <label><strong>Data fechamento</strong></label>
                                    <br>
                                    ".date('d-m-Y',strtotime($viewer_Dados[0]['DATAENC']))."
                                </div>

                                <div class='col-12 col-sm-12 col-md-6 col-lg-4 div_Campos'>
                                    <label><strong>Responsável</strong></label>
                                    <br>
                                    ".$viewer_Dados[0]['EDITOR']."
                                </div>";
                                $btsalvar = '';
            }
            else if($viewer_Dados[0]['STATUS'] == 'ATUALIZADO'){
                $data_status = "<div class='col-12 col-sm-12 col-md-6 col-lg-4 div_Campos'>
                                    <label><strong>Data modificação</strong></label>
                                    <br>
                                    ".date('d-m-Y',strtotime($viewer_Dados[0]['DATAMOD']))."
                                </div>

                                <div class='col-12 col-sm-12 col-md-6 col-lg-4 div_Campos'>
                                    <label><strong>Responsável</strong></label>
                                    <br>
                                    ".$viewer_Dados[0]['EDITOR']."
                                </div>";
                                if($edit_mode == 'false'){
                                    $mensagem_ = "
                                    <input type='button' value='  Editar solicitação  ' id='editar_req' onclick=window.location.href='minhas_Solicitacoes.php?lista=edit&IDREQ=".$viewer_Dados[0]['IDREQ']."&edit_mode=true'>
                                    <br>
                                    <textarea name='textMensagem' id='textMensagem' class='col-12 col-sm-12 col-md-12 col-lg-8' rows='10' readonly='true'>".$viewer_Dados[0]['DESCRICAO']."</textarea>";
                                    $dataenc_ = "--/--/----";
                                    $btsalvar = "
                                    <div class='row'>    
                                        <input type='submit' value='  Salvar  ' id='salvar' disabled>
                                    </div>";
                                }
                                else{
                                    $_SESSION['descricao'] = $viewer_Dados[0]['DESCRICAO'];
                                    $_SESSION['EDIT_MODE'] = 'true';
                                    $mensagem_ = "<textarea name='textMensagem' id='textMensagem' class='col-12 col-sm-12 col-md-12 col-lg-8' rows='10'></textarea>";
                                    $dataenc_ = "--/--/----";
                                    $btsalvar = "
                                    <div class='row'>    
                                        <input type='submit' value='  Salvar  ' id='salvar'>
                                    </div>";
                                }
            }
            else{
                $data_status = '';
                if($edit_mode == 'false'){
                    $mensagem_ = "
                    <input type='button' value='  Editar solicitação  ' id='editar_req' onclick=window.location.href='minhas_Solicitacoes.php?lista=edit&IDREQ=".$viewer_Dados[0]['IDREQ']."&edit_mode=true'>
                    <br>
                    <textarea name='textMensagem' id='textMensagem' class='col-12 col-sm-12 col-md-12 col-lg-8' rows='10' readonly='true'>".$viewer_Dados[0]['DESCRICAO']."</textarea>";
                    $dataenc_ = "--/--/----";
                    $btsalvar = "
                    <div class='row'>    
                        <input type='submit' value='  Salvar  ' id='salvar' disabled>
                    </div>";
                }
                else{
                    $_SESSION['descricao'] = $viewer_Dados[0]['DESCRICAO'];
                    $_SESSION['EDIT_MODE'] = 'true';
                    $mensagem_ = "<textarea name='textMensagem' id='textMensagem' class='col-12 col-sm-12 col-md-12 col-lg-8' rows='10'></textarea>";
                    $dataenc_ = "--/--/----";
                    $btsalvar = "
                    <div class='row'>    
                        <input type='submit' value='  Salvar  ' id='salvar'>
                    </div>";
                }
            }
        $status_ = $viewer_Dados[0]['STATUS'];
        $area_ = $viewer_Dados[0]['AREA'];
        $user_ = $viewer_Dados[0]['REQUISITANTE'];
        $datareq_ = date('d-m-Y',strtotime($viewer_Dados[0]['DATAREQ']));

            for ($i=1; $i < 6; $i++) { 
                if($viewer_Dados[0]['ANEXO'.$i] == ''){
                    $img[$i] = "<div id='div_Anexo".$i."' class='col-12 col-lg-4 edit_Anexos'>
                                    <label for='txtArquivo'><strong>Anexo ".$i."</strong></label>
                                    <br>
                                    <label>Vazio</label>
                                </div>";
                }
                else{
                    $img[$i] = "<div id='div_Anexo".$i."' class='col-12 col-lg-4 edit_Anexos'>
                                    <label for='txtArquivo'><strong>Anexo ".$i."</strong></label>
                                    <br>
                                    <a href='".$viewer_Dados[0]['ANEXO'.$i]."'><img src='".$viewer_Dados[0]['ANEXO'.$i]."' alt='Anexo ".$i."' class='all_Img_Anexos'></a>
                                </div>";
                }
            }
            $img1_ = $img[1];
            $img2_ = $img[2];
            $img3_ = $img[3];
            $img4_ = $img[4];
            $img5_ = $img[5];
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
<body onload=<?php echo $posicao;?>>
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
                    <a href="javascript:" id="btnMenu" class="btnMenuHamburguer">
						<i class="fas fa-bars"></i>
                    </a>
                </div>
            </div>
        </div>
    </header>
    <div id="faixa1"></div>

    <div id="popup_Fecha">
        <h4>Esta ação irá encerrar definitivamente esta solicitação!</h4>
        <p>Deseja realmente finalizá-la?</p>
        <br>
        <?php echo $botao_sim; ?>
        <input type='Button' id='click_nao' name='click_nao' value=' Não, mudei de idéia! '>
    </div>

<div id="sublinks" class="container">
    <?php
        switch ($sublinks) {
            case 'novo':
                echo (
                    "<div class='row'>  
                        <div id='nova_Req' class='col-12 tabelas'>
                            $divs
                        </div>
                    </div>"
                );
                break;
            case 'edit':
            echo "
            <a href='minhas_Solicitacoes.php'>Voltar</a>
            <form id='solicita' action='salvar_edit.php' method='POST' enctype='multipart/form-data'>
                    <div>   

                        <div id='selects'>
                            <div class='row'>
                                <div class='col-12 col-sm-12 col-md-6 col-lg-4 div_Campos selecao'>
                                    <label><strong>ID Solicitação</strong></label>
                                    <br>
                                    $idreq_
                                </div>

                                <div class='col-12 col-sm-12 col-md-6 col-lg-4 div_Campos selecao'>
                                    <label><strong>Local</strong></label>
                                    <br>
                                    $local_
                                </div>

                                <div class='col-12 col-sm-12 col-md-6 col-lg-4 div_Campos selecao'>
                                    <label><strong>Tipo de Solicitação</strong></label>
                                    <br>
                                    $tipo_
                                </div>
                                <div class='col-12 col-sm-12 col-md-6 col-lg-4 div_Campos selecao'>
                                    <label><strong>Subtipo de Solicitação</strong></label>
                                    <br>
                                    $subtipo_
                                </div>
                    
                                <div class='col-12 col-sm-12 col-md-6 col-lg-4 div_Campos'>
                                    <label><strong>Área Solicitada</strong></label>
                                    <br>
                                    $area_
                                </div>
                                <div class='col-12 col-sm-12 col-md-6 col-lg-4 div_Campos'>
                                    <label><strong>Solicitante</strong></label>
                                    <br>
                                    $user_
                                </div>

                                <div class='col-12 col-sm-12 col-md-6 col-lg-4 div_Campos'>
                                    <label><strong>Status</strong></label>
                                    <br>
                                    $status_
                                </div>

                                <div class='col-12 col-sm-12 col-md-6 col-lg-4 div_Campos'>
                                    <label><strong>Data solicitação</strong></label>
                                    <br>
                                    $datareq_
                                </div>

                                $data_status

                            </div> 
                        </div> 

                        <div id='titulo_Msg'>
                            <div class='row'>
                                <div id='box_Titulo' class='col-12 div_Campos'>
                                    <label for='titulo'><strong>Título</strong></label>
                                    <br>
                                    $titulo_   
                                </div>
                                <div id='box_Mensagem' class='col-12 div_Campos'>    
                                    <label for='textMensagem'><strong>Descricao</strong></label><br>
                                    $mensagem_
                                </div>
                            </div>
                        </div>
                            <div id='div_Anexos'>
                                <div class='row'>        
                                    <div class='col-12 div_Campos'>
                                        <div class='row'>
                                            $img1_
                                            $img2_
                                            $img3_
                                            $img4_
                                            $img5_                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <div id='bt_Salvar' class='col-12 col-sm-12 col-md-12 col-lg-12 div_Campos'>
                            $btsalvar
                        </div>
                    </div>
                </form>
            ";
                break;
            
            case 'fecha':
            echo "
            <a href='minhas_Solicitacoes.php'>Voltar</a>
            <form id='solicita' action='fechar_edit.php' method='POST' enctype='multipart/form-data'>
                    <div>   

                        <div id='selects'>
                            <div class='row'>
                                <div class='col-12 col-sm-12 col-md-6 col-lg-4 div_Campos selecao'>
                                    <label><strong>ID Solicitação</strong></label>
                                    <br>
                                    $idreq_
                                </div>

                                <div class='col-12 col-sm-12 col-md-6 col-lg-4 div_Campos selecao'>
                                    <label><strong>Local</strong></label>
                                    <br>
                                    $local_
                                </div>

                                <div class='col-12 col-sm-12 col-md-6 col-lg-4 div_Campos selecao'>
                                    <label><strong>Tipo de Solicitação</strong></label>
                                    <br>
                                    $tipo_
                                </div>
                                <div class='col-12 col-sm-12 col-md-6 col-lg-4 div_Campos selecao'>
                                    <label><strong>Subtipo de Solicitação</strong></label>
                                    <br>
                                    $subtipo_
                                </div>
                    
                                <div class='col-12 col-sm-12 col-md-6 col-lg-4 div_Campos'>
                                    <label><strong>Área Solicitada</strong></label>
                                    <br>
                                    $area_
                                </div>
                                <div class='col-12 col-sm-12 col-md-6 col-lg-4 div_Campos'>
                                    <label><strong>Solicitante</strong></label>
                                    <br>
                                    $user_
                                </div>

                                <div class='col-12 col-sm-12 col-md-6 col-lg-4 div_Campos'>
                                    <label><strong>Status</strong></label>
                                    <br>
                                    $status_
                                </div>

                                <div class='col-12 col-sm-12 col-md-6 col-lg-4 div_Campos'>
                                    <label><strong>Data solicitação</strong></label>
                                    <br>
                                    $datareq_
                                </div>

                                $data_status

                            </div> 
                        </div> 

                        <div id='titulo_Msg'>
                            <div class='row'>
                                <div id='box_Titulo' class='col-12 div_Campos'>
                                    <label for='titulo'><strong>#Título</strong></label>
                                    <br>
                                    $titulo_   
                                </div>
                                <div id='box_Mensagem' class='col-12 div_Campos'>    
                                    <label for='textMensagem'><strong>Descricao</strong></label><br>
                                    $mensagem_
                                </div>
                            </div>
                        </div>
                            <div id='div_Anexos'>
                                <div class='row'>        
                                    <div class='col-12 div_Campos'>
                                        <div class='row'>
                                            $img1_
                                            $img2_
                                            $img3_
                                            $img4_
                                            $img5_                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <div id='bt_Salvar' class='col-12 col-sm-12 col-md-12 col-lg-12 div_Campos'>
                            $btsalvar
                        </div>
                    </div>
                </form>
            ";
                break;
            
            default:
            echo (
                "<div class='row'>  
                    <div id='nova_Req' class='col-12 tabelas'>
                        $divs
                    </div>
                </div>"
            );
                break;
        }
    ?>
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
</html>