
 // Funcionalidade: este arquivo é utilizado para criar as funções ajax
 // Data de criação: 28/10/2016


function alt_removals(){
    value = $("#modal_list_input").val();
    $.ajax({
        type: "POST",
        url: base_url+"addons/php/queries/jtc_removals_queries.php",
        data: {"seller_id": value}
    }).done(function(data){
        if(data==""){
            $("tbody.removals").html('<tr><td colspan="4">Esse vendedor não possui saídas!</td></tr>');
        }else{
            $("tbody.removals").html(data);
        }
    });
}

function alt_size(code){
    value = $(code).val();
    line = $(code).parent().parent();
    $.ajax({
        type: "POST",
        url: base_url+"addons/php/queries/jtc_size_queries.php",
        data: {"products_id": value}
    }).done(function(data){
        $(line).find("select.size").html("<option value='' hidden>Tamanho</option>");
        if(data==""){
            $(line).find("select.size").prop("disabled", true);
            $(line).find("select.size").val("");
        }else{
            $(line).find("select.size").prop("disabled", false);
            $(line).find("select.size").append(data);
        }
    });
    $(code).parent().parent().find("input.quantity").parent().removeClass("line_error");
}

function alt_size_for_code(code){
    $(code).parent().parent().find("select.size").html("<option value='' hidden>Tamanho</option>");
    $(code).parent().parent().find("select.size").prop("disabled", true);
}

function ajax_city(state){//retorna as cidades relacionadas ao estado informado
    $.ajax({
        type: "POST",
        url: base_url+"addons/php/queries/jtc_city_queries.php",
        data: {"state_id": state},
    }).done(function(data){
        if(data==0){
            $("#city").prop("disabled", true);
            $("#city").html("<option hidden='' value=''>Nenhuma cidade cadastrada</option>>");
        }else{
            $("#city").prop("disabled", false);
            $("#city").html("<option hidden='' value=''>Selecione uma cidade</option>>");
            $("#city").append(data);
        }
    });
}

function ajax_seller(value){
    if(value==undefined){
        value = -1;
    }
    $.ajax({
        type: "POST",
        url: base_url+"addons/php/queries/jtc_seller_queries.php",
        data: {"id": value}
    }).done(function(data){
        $("#modal_list p").html(data);
        $("#modal_list #modal_title").html("Vendedores");
        $("#modal_list").show();
    });
}

function ajax_product(select_code,value){
    $.ajax({
        type: "POST",
        url: base_url+"addons/php/queries/jtc_product_queries.php",
        data: {"id": value}
    }).done(function (data){
        if(data=="0"){
            $(select_code).prop("disabled", true);
            $(select_code).html("<option hidden value=''>Código</option>");
        }else{
            $(select_code).val("");
            $(select_code).html("<option hidden value=''>Código</option>");
            $(select_code).append(data);
            $(select_code).prop("disabled", false);
        }
    });
}

function ajax_model_sex(value, line){
    $.ajax({
        type: "POST",
        url: base_url+"addons/php/queries/jtc_model_sex_queries.php",
        dataType: 'json',
        data: {"id": value}
    }).done(function (data){
        if(data.sex==0){
            $(line).find("td.sex").html("Feminino");
        }else if(data.sex==1){
            $(line).find("td.sex").html("Masculino");
        }else{
            $(line).find("td.sex").html("Unissex");
        }
        $(line).find("td.model").html(data.model);
    });
}

function ajax_alt_size(select){
    var value = $(select).val();
    $.ajax({
        type: "post",
        url: base_url+"addons/php/queries/jtc_sizes_queries.php",
        data: {"id": value}
    }).done(function (data){
        $(select).parent().parent().find("select.size").html("<option value='' hidden>Tamanho</option>");
        $(select).parent().parent().find("select.size").append(data);
        $(select).parent().parent().find("select.size").prop("disabled", false);
        if(data == ""){
            $(select).parent().parent().find("select.size").prop("disabled", true);
        }
    });
}


$(document).ready(function(){
    $("#state").change(function(){//ativa a função ajax_city() quando o select for alterado
        ajax_city($(this).val());
    });
});