<?php
include_once("conexao.php");

$query = "INSERT INTO `tbsolicitacoes`(`IDREQ`, `IDLOCAL`, `LOCAL`, `IDTIPO`, `TIPO`, `IDSUBTIPO`, `SUBTIPO`, `TITULO`, `DESCRICAO`, `STATUS`, `AREA`, `REQUISITANTE`, `DATAREQ`, `DATAMOD`, `DATAENC`, `EDITOR`, `ANEXO1`, `ANEXO2`, `ANEXO3`, `ANEXO4`, `ANEXO5`) VALUES('563600','REQ001','Bomboniere','TPO001','Impressoras','N/A','N/A','Teste insert','Testando o insert que está dando erro no host','NOVO','Tecnologias','dboliveira','2019-02-23','','','','','','','','')";
    
    $insert = mysqli_query($con,$query);

    if($insert){
        echo"<script charset='UTF-8' language='javascript' type='text/javascript'>alert('Solicitação criada com sucesso!.');window.location.href='minhas_Solicitacoes.php?lista=novo'</script>";
    }else{
        echo"<script charset='UTF-8' language='javascript' type='text/javascript'>alert('Não sei porque não está indo!');window.location.href='novo.php'</script>";
    }




?>