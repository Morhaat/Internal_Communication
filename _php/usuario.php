<?php
date_default_timezone_set('America/Sao_Paulo');
include_once("conexao.php");

session_start();


if (empty($_SESSION['nome'])) {
    return header('location: ../login.html');
}
else if ($_SESSION['setor'] <> 'Tecnologias') {
    if ($_SESSION['acesso'] == 'OWNER') {
        $idform = "usuarioon";
        $idform2 = "edusuario";
    }
    else{
        $idform = "usuariooff";
        $idform2 = "edusuario2";
    }
}
else if ($_SESSION['setor'] == 'Tecnologias') {
    $idform = "usuarioon";
    $idform2 = "edusuario";
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
    <script src="../_js/main.js"></script>
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

    <div id="createusuario" class="container">
        <div class="row">
                <div id="form1" class="col-12 col-sm-12 col-md-6 col-lg-6 forms">
                    <form id= "meuform" action="cadastro.php" method="POST" enctype="multipart/form-data">
                        
                        <h2>Solicitação de novo usuario</h2>
                        <p>
                            <label for="nome">Nome</label>
                            <br>
                            <input type="text" name="nome" id="nome" placeholder="Digite o nome do usuário" title="Digite o nome" tabindex="1" required>
                        </p>
                        <p>
                            <label for="email">email</label>
                            <br>
                            <input type="text" name="email" id="email" placeholder="Digite o email do usuário" title="Digite o email" tabindex="2" required>
                        </p>
                        <p>
                            <label for="usuario">Usuário</label>
                            <br>
                            <input type="text" name="usuario" id="usuario" placeholder="Digite um usuario" title="Digite um usuario" tabindex="3" required>
                        </p>
                        <p>
                            <label for="senha" >Senha</label>
                            <br>
                            <input type="password" name="senha" id="senha" tabindex="4">
                         </p>
                         <p>
                            <label for="acesso">Acesso</label>
                            <br>
                            <select name="acesso" id="acesso" tabindex = "5">
                                <option value="">Selecione um nível de acesso</option>
                                <option value="Owner">Owner</option>
                                <option value="Manager">Manager</option>
                                <option value="User">User</option>
                            </select>
                        </p>
                        <p>
                            <label for="setor">Setor</label>
                            <br>
                            <select name="setor" id="setor" tabindex = "6">
                                <option value="">Selecione um setor</option>
                                <option value="Owner">Owner</option>
                                <option value="Administracao">Administracao</option>
                                <option value="Manutencao">Manutencao</option>
                                <option value="Tecnologias">Tecnologias</option>
                                <option value="Atendimento">Atendimento</option>
                            </select>
                        </p>
                        <p>
                            <input type="submit" value="  Solicitar  " id="gerar" tabindex="7">
                        </p>
                    </form>
                </div>


                <div id="form2" class="col-12 col-sm-12 col-md-6 col-lg-6 forms">
                    <form id= "meuform2" action="altera.php" method="POST" enctype="multipart/form-data">

                        <h2>Alterar senha</h2>
                        <p>
                            <label for="usuario">Usuário</label>
                            <br>
                            <input type="text" name="usuario" id="usuario" placeholder="Digite um usuario" title="Digite um usuario" tabindex="1" value = "<?php echo $_SESSION['usuario'] ?>" readonly = "true">
                        </p>
                        <p>
                            <label for="atual" >Senha atual</label>
                            <br>
                            <input type="password" name="atual" id="atual" tabindex="2">
                        </p>
                        <p>
                            <label for="nova" >Nova senha</label>
                            <br>
                            <input type="password" name="nova" id="nova" tabindex="3">
                        </p>
                        <p>
                            <input type="submit" value="  Alterar  " id="gerar" tabindex="4">
                        </p>
                    </form>
                    </div>
            </div>
        </div>

        <footer id="rodape3">

            <div id="faixa2"></div>

            <div id="faixa3">
                <br>
                <p>Douglas Barreto Oliveira - 2019 - Marília-SP - barreto_oliv@hotmail.com</p>
            </div>

        </footer>

    <script type="text/javascript">
        var idform = "<?php echo $idform;?>";
        var idform2 = "<?php echo $idform2;?>";

        document.getElementById('meuform').setAttribute('id', idform);
        document.getElementById('meuform2').setAttribute('id', idform2);

        if (idform2 == "edusuario2") {
            document.getElementById('form1').setAttribute('class', 'col-1');         
            document.getElementById('form2').setAttribute('class', 'col-11 forms');         
        }
    </script>
    <script src="../_js/main.js"></script>
</body>
</html>