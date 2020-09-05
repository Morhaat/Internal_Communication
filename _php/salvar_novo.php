<?php 
include_once("gera_novo_id.php");
include_once("conexao.php");
date_default_timezone_set('America/Sao_Paulo');


$idreq = $ultima;
$id_local = $_POST['local'];
$id_tipo = $_POST['tipo'];
$id_subtipo = $_POST['subtipo'];
$areareq = $_POST['area_Solicitada'];
$user_solicita = $_POST['user_Solicita'];
$data = date ("Y-m-d");
$titulo = $_POST['titulo'];
$mensagem = $_POST['textMensagem'];
$data2 = date('d/m/Y',strtotime($data));
$horas = date ("H:i:s");


function manda_arquivo($arquivo){
    if ( isset( $_FILES[ $arquivo ][ 'name' ] ) && $_FILES[ $arquivo ][ 'error' ] == 0 ) {     
        $arquivo_tmp = $_FILES[ $arquivo ][ 'tmp_name' ];
        $nome = $_FILES[ $arquivo ][ 'name' ];
     
        // Pega a extensão
        $extensao = pathinfo ( $nome, PATHINFO_EXTENSION );
     
        // Converte a extensão para minúsculo
        $extensao = strtolower ( $extensao );
     
        // Somente imagens, .jpg;.jpeg;.gif;.png
        // Aqui eu enfileiro as extensões permitidas e separo por ';'
        // Isso serve apenas para eu poder pesquisar dentro desta String
        if ( strstr ( '.jpg;.jpeg', $extensao ) ) {
            // Cria um nome único para esta imagem
            // Evita que duplique as imagens no servidor.
            // Evita nomes com acentos, espaços e caracteres não alfanuméricos
            $novoNome = uniqid ( time () ) . '.' . $extensao;
     
            // Concatena a pasta com o nome
            $destino = '../_uploads/' . $novoNome;
     
            // tenta mover o arquivo para o destino
            if ( @move_uploaded_file ( $arquivo_tmp, $destino ) ) {
                return $destino;
            }
            else
                echo "<script charset='UTF-8' language='javascript' type='text/javascript'>alert('O anexo não pôde ser enviado!');</script>";
        }
        else
            echo "<script charset='UTF-8' language='javascript' type='text/javascript'>alert('Formato incompatível de anexo!');</script>";
    }
    else
        return '';
}



if($id_local == ''| $id_local == null){
    echo"<script charset='UTF-8' language='javascript' type='text/javascript'>alert('O Campo *Local* precisa ser selecionado');window.location.href='novo.php'</script>";
}
else if($id_tipo =='' | $id_tipo == null){
    echo"<script charset='UTF-8' language='javascript' type='text/javascript'>alert('O Campo *Tipo* precisa ser selecionado');window.location.href='novo.php'</script>";    
}
else if($id_subtipo == '' | $id_subtipo == null){
    echo"<script charset='UTF-8' language='javascript' type='text/javascript'>alert('O Campo *Subtipo* precisa ser selecionado');window.location.href='novo.php'</script>";
}
else{
    $arquivo1 = manda_arquivo('arquivo1');
    $arquivo2 = manda_arquivo('arquivo2');
    $arquivo3 = manda_arquivo('arquivo3');
    $arquivo4 = manda_arquivo('arquivo4');
    $arquivo5 = manda_arquivo('arquivo5');

    session_start();
    $_SESSION['idreq'] = $idreq;

    $sql=("SELECT * FROM tblocais WHERE IDLOCAL = '$id_local'");
    $result=mysqli_query($con,$sql);
    $array = mysqli_fetch_array($result);
    $local = $array['LOCAL'];

    $sql=("SELECT * FROM tbtipos WHERE IDTIPO = '$id_tipo'");
    $result=mysqli_query($con,$sql);
    $array = mysqli_fetch_array($result);
    $tipo = $array['TIPO'];

    if($id_subtipo != 'N/A'){
        $sql=("SELECT * FROM tbsubtipos WHERE IDSUBTIPO = '$id_subtipo'");
        $result=mysqli_query($con,$sql);
        $array = mysqli_fetch_array($result);
        $subtipo = $array['SUBTIPO'];
    }
    else{
        $subtipo = 'N/A';
    }
    $mensagem = $mensagem."\n\n"."Solicitação criada em ".$data2." às ".$horas." por ".$user_solicita.".\n\n";
    $query = "INSERT INTO tbsolicitacoes (IDREQ, IDLOCAL, LOCAL,IDTIPO, TIPO, IDSUBTIPO, SUBTIPO, TITULO, DESCRICAO, STATUS, AREA, REQUISITANTE, DATAREQ, DATAMOD, DATAENC, EDITOR, ANEXO1, ANEXO2, ANEXO3, ANEXO4, ANEXO5) VALUES ('$idreq', 
    '$id_local', '$local', '$id_tipo','$tipo', '$id_subtipo', '$subtipo', '$titulo','$mensagem', 'NOVO', '$areareq', '$user_solicita', '$data', '0000-00-00', '0000-00-00', '', '$arquivo1', '$arquivo2', '$arquivo3', '$arquivo4', '$arquivo5')";

    $insert = mysqli_query($con, $query);

    if($insert){
        echo"<script charset='UTF-8' language='javascript' type='text/javascript'>alert('Solicitação criada com sucesso!.');window.location.href='minhas_Solicitacoes.php?lista=novo'</script>";
    }else{
        echo"<script charset='UTF-8' language='javascript' type='text/javascript'>alert('Não foi possível criar esta solicitação!');window.location.href='novo.php'</script>";
    }

}
?>