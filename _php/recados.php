<?php
session_start();

if (empty($_SESSION['nome']) ) {
    return header('location: ../login.html');
}

?>


<!DOCTYPE html>
<html lang="en">
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

    <div class="container">
        <form id="enviaMural" action="salvarRecados.php" method="POST" class="col-12 col-lg-8">
            <div class="row">
                <h3>Mural de Recados</h3>
                <textarea id="recado" name="recado" class="col-12" rows="10">recados</textarea>
                <div id="preenche" class="col-8 col-lg-10"></div>
                <div id="bt" class="col-4 col-lg-2">
                    <input type="Submit" id="salvaRecado" name="salvaRecado" value="Enviar">
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
    <script>

    </script>

</body>
</html>