function leftPos(ref){
    var valor = ref.offsetLeft;
    while((ref = ref.offsetParent) != null)valor += ref.offsetLeft;
    return valor;
   }

   var elemento = document.getElementById("menuSmhidden");
    var clicks = document.getElementById("btnMenu");
    var vff = -250;
        clicks.onclick = function (){
            if(leftPos(elemento) == vff){
                document.getElementById("menuSmhidden").setAttribute("id", "menuSm");
            }
            else{
                document.getElementById("menuSm").setAttribute("id", "menuSmhidden");  
            }
        }

        var save_setor_tipo = [];
        var save_setor_subtipo = [];

        $('#id_local').change(function(){
            if($('#id_local').val() != ''){
                    $('#tipo').hide();
                    $('.carregando').show();
                    $(function(){
                    $.getJSON("../_php/loadtipo.php?search= ", {id_local:$('#id_local').val(), ajax:'true'}, function(j){                     
                        var option = '';
                        save_setor_tipo = j;
                        for (var i = 0; i < j.length; i++) {
                            option += '<option value="'+j[i].IDTIPO+'">'+j[i].TIPO+'</option>';
                        }      
                        $('#tipo').html(option).show();
                        $('.carregando').hide();
                    });
                });
                }
            else{
                    $('#tipo').html('<option value = "">Selecione um tipo</option>');
                } 
        });


        $('#tipo').change(function(){
            if($('#tipo').val() != ''){
                $('#subtipo').hide();
                $('.carregando2').show();
                $(function(){
                $.getJSON("../_php/loadsubtipo.php?search= ", {id_tipo:$('#tipo').val(), ajax:'true'}, function(j){                     
                    var option = '';
                    save_setor_subtipo = j;
                    for (var i = 0; i < j.length; i++) {
                        option += '<option value="'+j[i].IDSUBTIPO+'">'+j[i].SUBTIPO+'</option>';
                    }      
                    $('#subtipo').html(option).show();
                    $('.carregando2').hide();
                });
            });
                for (var k = 0; k < save_setor_tipo.length; k++) {
                    if($('#tipo').val() == save_setor_tipo[k].IDTIPO){
                        $('#area_Solicitada').val(save_setor_tipo[k].SETOR);
                    }
                }
            }
        else{
                $('#subtipo').html('<option value = "">Selecione um subtipo</option>');
            }
        });


        $('#subtipo').change(function(){
            if($(this).val()!= ''){
                for (var k = 0; k < save_setor_subtipo.length; k++) {
                    if($('#subtipo').val() == save_setor_subtipo[k].IDSUBTIPO){
                        $('#area_Solicitada').val(save_setor_subtipo[k].SETOR);
                    }
                }
            }
            else{
                for (var k = 0; k < save_setor_tipo.length; k++) {
                    if($('#tipo').val() == save_setor_tipo[k].IDTIPO){
                        $('#area_Solicitada').val(save_setor_tipo[k].SETOR);
                    }
                } 
            }
        })



        //Tamanho da tela para o rodapé
function topPos(ref){
    var valor = ref.offsetTop;
    while((ref = ref.offsetParent) != null)valor += ref.offsetTop;
        return valor;
    }





//alert(document.body.offsetHeight);
//alert(document.body.scrollHeight);
//alert(document.body.clientHeight); 
//alert(windowHeight);
//alert(window.screen.height); 
//alert(topo.offsetTop);

var windowHeight = window.innerHeight;
var topo = document.getElementById("rodape3");

if(document.body.offsetHeight < windowHeight){
    var posicao = windowHeight-document.body.offsetHeight;
   topo.style.marginTop = posicao+'px';
}
else{
    if(topo.style.offsetTop < windowHeight){
        topo.style.marginTop = document.body.offsetHeight+'px';
    }
}




//..........................inicio Gerenciar tabelas.................................//

$(document).ready(function(){
    $('#selecionar_Tabela').change(function(){
        $.get("retorna_Div.php", {selecao:$('#selecionar_Tabela').val()}, function(data){
            $('#tabela_Selecionada').html(data);
        });
    });
});


function carregatipo(local, tipo, carregando){ 
    if($(local).val() != ''){
            $(tipo).hide();
            $(carregando).show();
            $(function(){
            $.getJSON('../_php/loadtipo.php?search= ', {id_local:$(local).val(), ajax:'true'}, function(j){                     
                var option = '';
                save_setor_tipo = j;
                for (var i = 0; i < j.length; i++) {
                    option += '<option value="'+j[i].IDTIPO+'">'+j[i].TIPO+'</option>';
                }      
                $(tipo).html(option).show();
                $(carregando).hide();
            });
        });
        }
    else{
            $(tipo).html('<option value = "">Selecione um tipo</option>');
        }
    }


function carregasubtipo(tipo, subtipo, carregando){ 
    if($(tipo).val() != ''){
            $(subtipo).hide();
            $(carregando).show();
            $(function(){
                $.getJSON("../_php/loadsubtipo.php?search= ", {id_tipo:$(tipo).val(), ajax:'true'}, function(j){                     
                    var option = '';
                    save_setor_subtipo = j;
                    for (var i = 0; i < j.length; i++) {
                        option += '<option value="'+j[i].IDSUBTIPO+'">'+j[i].SUBTIPO+'</option>';
                    }      
                    $(subtipo).html(option).show();
                    $('.carregando2').hide();
                });
            });
        }
    else{
            $(subtipo).html('<option value = "">Selecione um subtipo</option>');
        }
    }


    function remover(select, modelo, janela){
        if(modelo != ''){
            if(select !=''){
                $.get("../_php/remove_Item.php?search= ", {selecao:modelo, id:$(select).val(), ajax:'true'}, function(data){
                    $('#retorno_exec').html(data);
                    $(janela).change();
                });
            }
        }
    }

    function adiciona(id1, name1, id2, nmsetor, modelo, janela){
        if(modelo != ''){
            if(id1!=''){
                if(id2!=''){
                    $.get("../_php/adiciona_Item.php", {selecao:modelo, idprinc:$(id1).val(), nmprinc:$(name1).val(), idsec:$(id2).val(), nmsetor:$(nmsetor).val(), ajax:'true'}, function(data){
                        $('#retorno_exec').html(data);
                        $(janela).change();
                    });
                }
                else{
                    $.get("../_php/adiciona_Item.php", {selecao:modelo, idprinc:$(id1).val(), nmprinc:$(name1).val(), nmsetor:$(nmsetor).val(), ajax:'true'}, function(data){
                        $('#retorno_exec').html(data);
                        $(janela).change();
                    });
                }
            }
        }
        $(janela).change();
    }


        $('#fechar_req').click(function(){
            if ($(window).width() % 2 == 0){
                alert($(window).width());
            }
            else{
                var valor = $(window).width()-1;
                valor = valor/2-170;
                $('#popup_Fecha').css('margin-left', valor);
            }
            $('#popup_Fecha').show();
            $('#popup_Fecha').css('margin-top', self.scrollY);
        });

        $(document).ready(function(){
            $(Window).scroll(function(){
                $('#popup_Fecha').css('margin-top', self.scrollY);
            });
        });

        $(document).ready(function(){
            $('#click_nao').click(function(){
                $('#popup_Fecha').hide();
            });
        });
        $(document).ready(function(){
            $('#click_sim').click(function(){
                $('#popup_Fecha').hide();
            });
        });