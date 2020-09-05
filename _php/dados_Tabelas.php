<?php
include_once("conexao.php");


//....................Função para gerar novo ID das tabelas.....................//

function SOMA_ID($id, $tabela){
    if($tabela == 'tblocais'){
        $final = '';
        $ps = explode('Q',$id);
        $soma = $ps[1]+1;
            for ($i=0; $i < 4-strlen($soma); $i++) { 
            $final = $final.'0';
            }
        return "REQ".$final.$soma;
        }
    else if($tabela == 'tbtipos'){
            $final = '';
            $ps = explode('O',$id);
            $soma = $ps[1]+1;
                for ($i=0; $i < 5-strlen($soma); $i++) { 
                $final = $final.'0';
                }
            return "TPO".$final.$soma;
        }
    else if($tabela == 'tbsubtipos'){
            $final = '';
            $ps = explode('O',$id);
            $soma = $ps[1]+1;
                for ($i=0; $i < 5-strlen($soma); $i++) { 
                $final = $final.'0';
                }
            return "STPO".$final.$soma;
        }
}
//....................Fim da Função .....................//




//..................Gera novo id das tabelas..................//

$sql1=("SELECT IDLOCAL FROM tblocais ORDER BY IDLOCAL DESC LIMIT 1");
$result1=mysqli_query($con,$sql1);
$array1 = mysqli_fetch_array($result1);
    if(isset($array1['IDLOCAL'])){
        $novo_id_local = SOMA_ID($array1['IDLOCAL'], 'tblocais');
    }
    else{
        $novo_id_local = 'REQ0001';
    }

$sql2=("SELECT IDTIPO FROM tbtipos ORDER BY IDTIPO DESC LIMIT 1");
$result2=mysqli_query($con,$sql2);
$array2 = mysqli_fetch_array($result2);
    if(isset($array2['IDTIPO'])){
        $novo_id_tipo = SOMA_ID($array2['IDTIPO'], 'tbtipos');
    }
    else{
        $novo_id_tipo = 'TPO00001';
    }

$sql3=("SELECT IDSUBTIPO FROM tbsubtipos ORDER BY IDSUBTIPO DESC LIMIT 1");
$result3=mysqli_query($con,$sql3);
$array3 = mysqli_fetch_array($result3);
    if(isset($array3['IDSUBTIPO'])){
        $novo_id_subtipo = SOMA_ID($array3['IDSUBTIPO'], 'tbsubtipos');
    }
    else{
        $novo_id_subtipo = 'STPO00001';
    }

//..................Fim id das tabelas..................//



//..................Carrega uma Div com os dados de cada tabela..................//
$option_Local = "<option value=''>Selecione um Local</option>";
$sql4=("SELECT * FROM tblocais ORDER BY IDLOCAL");
$result4=mysqli_query($con,$sql4);
if(!empty($array4 = mysqli_fetch_assoc($result4))){
    $result4=mysqli_query($con,$sql4);
    while($array4 = mysqli_fetch_assoc($result4)){
        $option_Local = $option_Local."
        <option value='".$array4['IDLOCAL']."'>".$array4['LOCAL']."</option>";
    }
}
else{
    $option_Local = "";
}


$option_Tipo = "<option value=''>Selecione um Tipo</option>";
$sql5=("SELECT * FROM tbtipos ORDER BY IDTIPO");
$result5=mysqli_query($con,$sql5);
if(!empty($array5 = mysqli_fetch_assoc($result5))){
    $result5=mysqli_query($con,$sql5);
    while($array5 = mysqli_fetch_assoc($result5)){
        $option_Tipo = $option_Tipo."
        <option value='".$array5['IDTIPO']."'>".utf8_encode($array5['TIPO'])."</option>";
    }
}
else{
    $option_Tipo = "";
}


$option_Subtipo = "<option value=''>Selecione um Subtipo</option>";
$sql6=("SELECT * FROM tbsubtipos ORDER BY IDSUBTIPO");
$result6=mysqli_query($con,$sql6);
if(!empty($array6 = mysqli_fetch_assoc($result6))){
    $result6=mysqli_query($con,$sql6);
    while($array6 = mysqli_fetch_assoc($result6)){
        $option_Subtipo = $option_Subtipo."
        <option value='".$array6['IDSUBTIPO']."'>".utf8_encode($array6['SUBTIPO'])."</option>";
    }
}
else{
    $option_Subtipo = "";
}

$div_Local = "
<div id='div_local' class='col-10 col-lg-6 janelas_addnb'>
    <div class='row'>
        <h3 class='col-12 text-center'>Remover Locais</h3>
        <div class='col-12 col-lg-12 div_Campos'>
            <label>Local</label>
            <br>
            <select id='gerir_Local'>
                $option_Local
            </select>
            <input type='Button' id='Remove' class='inputs' name='Remove' value='Remover Local'>
        </div>
        <br>
        <h3 class='col-12 text-center'>Criar Locais</h3>
        <div class='col-12 col-lg-4 div_Campos'>
            <label for='novo_ID'>Novo ID</label>
            <br>
            <input type='text' id='novo_ID' name='novo_ID' value='$novo_id_local' readonly='true'>
        </div>
        <div class='col-12 col-lg-8 div_Campos'>
            <label for='novo_ID'>Novo Local</label>
            <br>
            <input type='text' id='novo_LOCAL' name='novo_LOCAL'>
            <input type='Button' id='add_novo_local' class='inputs' name='add_novo_local' value='Adicionar'>
        </div>
    </div>
</div>

    <script>
        $('#Remove').click(function(){
            remover('#gerir_Local', 'Local', '#selecionar_Tabela');
        });

        $('#add_novo_local').click(function(){
            adiciona('#novo_ID', '#novo_LOCAL', '', '', 'Local', '#selecionar_Tabela');
        });
    </script>
";


$div_Tipo = "
<div id='div_tipo' class='col-10 col-lg-8 janelas_addnb'>
    <div class='row'>
    <h3 class='col-12 text-center'>Remover Tipos</h3>
        <div class='col-12 col-lg-3 div_Campos'>
            <label>Local</label>
            <br>
            <select id='gerir_Local'>
                $option_Local
            </select>
        </div>
        <div class='col-12 col-lg-6 div_Campos'>
            <label>Tipo</label>
            <br>
            <label class='carregando'>Carregando, aguarde...</label>
            <select id='gerir_Tipo'>
                <option value=''>Selecione um tipo</option>
            </select>
            <input type='Button' id='Remove' class='inputs' name='Remove' value='Remover Tipo'>
        </div>

        <div class='col-12'><br><br></div>
        <h3 class='col-12 text-center'>Criar Tipos</h3>

        <div class='col-12 col-lg-3 div_Campos'>
            <label>Local</label>
            <br>
            <select id='gerir_Local2'>
                $option_Local
            </select>
        </div>
        
        <div class='col-12 col-lg-3 div_Campos'>
            <label for='novo_ID'>Novo ID</label>
            <br>
            <input type='text' id='novo_ID' name='novo_ID' value='$novo_id_tipo' readonly='true'>
        </div>

        <div class='col-12 col-lg-3 div_Campos'>
            <label for='novo_TIPO'>Novo Tipo</label>
            <br>
            <input type='text' id='novo_TIPO' name='novo_TIPO'>
        </div>



        <div class='col-12 col-lg-4 div_Campos'>
            <label>Setor correspondente</label>
            <br>
            <select id='gerir_Setor'>
                <option value=''>Selecione um setor</option>
                <option value='Administração'>Administração</option>
                <option value='Manutenção'>Manutenção</option>
                <option value='Tecnologias'>Tecnologias</option>
                <option value='Atendimento'>Atendimento</option>
            </select>
            <input type='Button' id='add_novo_tipo' class='inputs' name='add_novo_tipo' value='Adicionar'>
        </div>

    </div>
</div>


    <script>
        $('#gerir_Local').change(function(){
            carregatipo(this, '#gerir_Tipo', '.carregando');
        });

        $('#Remove').click(function(){
            remover('#gerir_Tipo', 'Tipo', '#selecionar_Tabela');
        });

        $('#add_novo_tipo').click(function(){
            adiciona('#novo_ID', '#novo_TIPO', '#gerir_Local2', '#gerir_Setor', 'Tipo', '#selecionar_Tabela');
        });
    </script>
";


$div_Subtipo = "
<div id='div_tipo' class='col-10 janelas_addnb'>
    <div class='row'>
        <h3 class='col-12 text-center'>Remover Subtipos</h3>
        <div class='col-12 col-lg-3 div_Campos'>
            <label>Local</label>
            <br>
            <select id='gerir_Local'>
                $option_Local
            </select>
        </div>
        <div class='col-12 col-lg-2 div_Campos'>
            <label>Tipo</label>
            <br>
            <label class='carregando'>Carregando, aguarde...</label>
            <select id='gerir_Tipo'>
                <option value=''>Selecione um tipo</option>
            </select>
        </div>
        <div class='col-12 col-lg-6 div_Campos'>
            <label>Subtipo</label>
            <br>
            <label class='carregando2'>Carregando, aguarde...</label>
            <select id='gerir_Subtipo'>
                <option value=''>Selecione um subtipo</option>
            </select>
            <input type='Button' id='Remove' name='Remove' value='Remover'>
        </div>
        
        <div class='col-12'><br><br></div>
        <h3 class='col-12 text-center'>Criar Subtipos</h3>

        <div class='col-12 col-lg-3 div_Campos'>
            <label>Local</label>
            <br>
            <select id='gerir_Local2'>
                $option_Local
            </select>
        </div>
        <div class='col-12 col-lg-2 div_Campos'>
            <label>Tipo</label>
            <br>
            <label class='carregando3'>Carregando, aguarde...</label>
            <select id='gerir_Tipo2'>
                <option value=''>Selecione um tipo</option>
            </select>
        </div>
        <div class='col-12 col-lg-2 div_Campos'>
            <label>Novo ID</label>
            <br>
            <input type='text' id='novo_ID' name='novo_ID' value='$novo_id_subtipo' readonly='true'>
        </div>

        <div class='col-12 col-lg-3 div_Campos'>
            <label for='novo_Subtipo'>Novo Subtipo</label>
            <br>
            <input type='text' id='novo_Subtipo' name='novo_Subtipo'>
        </div>

        <div class='col-12 col-lg-6 div_Campos'>
            <label>Setor correspondente</label>
            <br>
            <select id='gerir_Setor'>
                <option value=''>Selecione um setor</option>
                <option value='Administração'>Administração</option>
                <option value='Manutenção'>Manutenção</option>
                <option value='Tecnologias'>Tecnologias</option>
                <option value='Atendimento'>Atendimento</option>
            </select>
            <input type='Button' id='add_novo_subtipo' class='inputs' name='add_novo_subtipo' value='Adicionar'>
        </div>
    </div>
</div>

    <script>
        $('#gerir_Local').change(function(){
            carregatipo(this, '#gerir_Tipo', '.carregando');
        });

        $('#gerir_Tipo').change(function(){
            carregasubtipo(this, '#gerir_Subtipo', '.carregando2');
        });

        $('#gerir_Local2').change(function(){
            carregatipo(this, '#gerir_Tipo2', '.carregando3');
        });

        $('#Remove').click(function(){
            remover('#gerir_Subtipo', 'Subtipo', '#selecionar_Tabela');
        });

        $('#add_novo_subtipo').click(function(){
            adiciona('#novo_ID', '#novo_Subtipo', '#gerir_Tipo2', '#gerir_Setor', 'Subtipo', '#selecionar_Tabela');
        });

    </script>

";
//..................Fim Carrega dados de cada tabela..................//


?>