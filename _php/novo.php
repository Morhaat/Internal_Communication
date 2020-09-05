<?php
date_default_timezone_set('America/Sao_Paulo');

include_once("conexao.php");
include_once("locais.php");
$option = '';

session_start();
if (empty($_SESSION['nome'])) {
    return header('location: ../login.html');
}
$user = $_SESSION['usuario'];


    if(isset($local_post)){
        for ($i=0; $i < count($local_post); $i++) { 
            $option = $option."<option value='".$local_post[$i]['IDLOCAL']."'>".utf8_encode($local_post[$i]['LOCAL'])."</option>";
        }
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
                    <a href="javascript:" id="btnMenu" class="btnMenuHamburguer">
						<i class="fas fa-bars"></i>
                    </a>
                </div>
            </div>
        </div>
    </header>
    <div id="faixa1"></div>
    
    <div id="box_Solicita" class="container">   
                <form id="solicita" action="salvar_novo.php" method="POST" enctype="multipart/form-data">
                    <div>   

                        <div id="selects">
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-6 col-lg-4 div_Campos selecao">
                                    <label>Local</label>
                                    <br>
                                    <select name="local" id="id_local">
                                        <option value="">Selecione um local</option>
                                        <?php echo $option ?>
                                    </select>
                                </div>

                                <div class="col-12 col-sm-12 col-md-6 col-lg-4 div_Campos selecao">
                                    <label>Tipo de Solicitação</label>
                                    <br>
                                    <span id="spann" class="carregando">Aguarde, carregando...</span>
                                    <select id="tipo" name="tipo">
                                        <option value=" ">Selecione um tipo</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-4 div_Campos selecao">
                                    <label>Subtipo de Solicitação</label>
                                    <br>
                                    <span id="spann" class="carregando2">Aguarde, carregando...</span>
                                    <select id="subtipo" name="subtipo">
                                <option value=" ">Selecione um Subtipo</option>
                                    </select>
                                </div>
                    
                                <div class="col-12 col-sm-12 col-md-6 col-lg-4 div_Campos">
                                    <label>Área Solicitada</label>
                                    <br>
                                    <input type="text" name="area_Solicitada" id="area_Solicitada" readonly = "true" placeholder="Dinamico">
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-4 div_Campos">
                                    <label>Solicitante</label>
                                    <br>
                                    <input type="text" name="user_Solicita" id="user_Solicita" readonly = "true" value="<?php echo $user ?>">
                                </div>
                            </div> 
                        </div> 

                        <div id="titulo_Msg">
                            <div class="row">
                                <div class="col-12 div_Campos">
                                    <label for="titulo">Título</label>
                                    <br>
                                    <input type="text" name="titulo" id="titulo" placeholder="Digite um titulo para a solicitação" maxlength ="200" title="Digite um titulo para a requisição" tabindex="1" required>   
                                </div>
                                <div id="box_Mensagem" class="col-12 div_Campos">    
                                    <label for="textMensagem">Mensagem</label><br>
                                    <textarea name="textMensagem" id="textMensagem" class="col-12 col-sm-12 col-md-12 col-lg-8" rows="10"></textarea>
                                </div>
                            </div>
                        </div>
                            <div id="div_Anexos">
                                <div class="row">        
                                    <div class="col-12 div_Campos">
                                        <div id="div_Anexo1" class="anexos">
                                            <label for="txtArquivo">Anexo 1</label>
                                            <input type="file" class="col-12" accept=".jpg" name="arquivo1" id="arquivo1">
                                        </div>
                                        <div id="div_Anexo2" class="anexos">
                                            <label for="txtArquivo">Anexo 2</label>
                                            <input type="file" class="col-12" accept=".jpg" name="arquivo2" id="arquivo2">
                                        </div>
                                        <div id="div_Anexo3" class="anexos">
                                            <label for="txtArquivo">Anexo 3</label>
                                            <input type="file" class="col-12" accept=".jpg" name="arquivo3" id="arquivo3">
                                        </div>
                                        <div id="div_Anexo4" class="anexos">
                                            <label for="txtArquivo">Anexo 4</label>
                                            <input type="file" class="col-12" accept=".jpg" name="arquivo4" id="arquivo4">
                                        </div>
                                        <div id="div_Anexo5" class="anexos">
                                            <label for="txtArquivo">Anexo 5</label>
                                            <input type="file" class="col-12" accept=".jpg" name="arquivo5" id="arquivo5">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <div id="bt_Salvar" class="col-12 col-sm-12 col-md-12 col-lg-12 div_Campos">
                            <div class="row">    
                                <input type="submit" value="  Salvar  " id="salvar">
                            </div>
                        </div>
                    </div>
                </form>
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