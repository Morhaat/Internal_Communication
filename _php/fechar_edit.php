<?php 
include_once("conexao.php");
date_default_timezone_set('America/Sao_Paulo');

session_start();

$idreq = $_SESSION['ID_REQ'];
$datamod = date ("Y-m-d");
$datamod2 = date('d/m/Y',strtotime($datamod));
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


if(isset($_POST['textMensagem'])){

    $user = $_SESSION['usuario'];
    $_SESSION['idreq'] = $idreq; 
    $mensagem = $_POST['textMensagem']."\n\n"."Solicitação Encerrada em ".$datamod2." às ".$horas." por ".$user.".\n\n"."
    ------------------------------------------------Anterior------------------------------------------------
    \n\n".$_SESSION['descricao'];
    $query = "UPDATE `tbsolicitacoes` SET `DESCRICAO`= '$mensagem',`STATUS`= 'FECHADO',`DATAMOD`='$datamod', `DATAENC`='$datamod', `EDITOR`='$user'";
        for ($i=1; $i < 6; $i++) {
            $arquivo = manda_arquivo("arquivo$i");
            if($arquivo != ''){
                if($i == 1){
                    $query = $query.", `ANEXO1` ='$arquivo'";
                }
                else if($i == 2){
                    $query = $query.", `ANEXO2` ='$arquivo'";
                }
                else if($i == 3){
                    $query = $query.", `ANEXO3` ='$arquivo'";
                }
                else if($i == 4){
                    $query = $query.", `ANEXO4` ='$arquivo'";
                }
                else if($i == 5){
                    $query = $query.", `ANEXO5` ='$arquivo'";
                }
            }
        }
        $query =$query." WHERE `IDREQ`=$idreq";
        $update = mysqli_query($con, $query);

        if($update){
            echo"<script charset='UTF-8' language='javascript' type='text/javascript'>alert('Solicitação encerrada com sucesso!.');window.location.href='minhas_Solicitacoes.php?lista=edit&IDREQ=".$idreq."&edit_mode=false'</script>";
        }else{
            echo"<script charset='UTF-8' language='javascript' type='text/javascript'>alert('Não foi possível encerrar esta solicitação!');window.location.href='minhas_Solicitacoes.php'</script>";
        }
}
else{
    echo"<script charset='UTF-8' language='javascript' type='text/javascript'>alert('Não foi possível encerrar esta solicitação!');window.location.href='minhas_Solicitacoes.php?lista=edit&IDREQ=".$idreq."&edit_mode=true'</script>";  
}   
?>