//  Funcionalidade: este arquivo possui as funções javascript principais
//  Data de criação: .....
//  Obs.: ..... //Caso houver


  function confirm_delete(directory, type, data){
    $("#link_delete").attr("href", directory);
    $("#modal_confirm p").html("Deletar o(a) "+type+": "+data);
    $("#modal_confirm").show();
  }

  function close_modal(id_modal){
    $("#"+id_modal).hide();
  }

  function modal_list(list, value){
    switch(list){
      case "seller":
        ajax_seller(value);
        break;
      case "repairs":
          alert(454);
        $("#modal_repairs").show();
        break;
      default:
        alert("Lista inválida");
    }
  }
  
  function select_input() {
    var value = $("#modal_list input:checked").val();
    if(value==undefined){
      alert("Selecione uma opção");
    }else{
      $("#modal_list_input").val(value);
      $("#modal_list_button i").html(": "+value);
      close_modal("modal_list");
      alt_removals();
    }
  }

  //funções do mestre-detalhe

  function alt_code(line){
    value = $(line).val();
    select_code = $(line).parent().parent().find("select.code");
    $(line).parent().parent().find("td.sex, td.model").html("---");
    $(select_code).val();
    ajax_product(select_code, value);
  }

  function del_line(line) {
    if ($("tr.line").length > 1) {
      $(line).parent().parent().remove();
    }
  }

  function add_line(){
    line = $("tr.line:first-child").clone();
    line.find("select, input").val("");
    line.find("select.code").prop("disabled", true);
    line.find(".sex, .model").html("---");
    line.find("td").removeClass("line_error");
    line.insertAfter("tr.line:last");
  }

  function disable_size(){
    $("tr.line:last select.size").prop("disabled", true);
  }

  function alt_sex_model(select){
    value = $(select).val();
    line = $(select).parent().parent();
    ajax_model_sex(value, line);
  }

  function reset_form(){
    line = $("tr.line:first-child").clone();
    line.find("select, input").val("");
    line.find("select.code").prop("disabled", true);
    $("#modal_list_button").prop("disabled", true);
    line.find(".sex, .model").html("---");
    $("#table_products tbody").html(line);
  }

  function validate_form(){
    var code = document.getElementsByName("code[]");
    var size = document.getElementsByName("size[]");
    var quantity = document.getElementsByName("quantity[]");
    var toReturn = true;
    for(c = 0; c < code.length; c++) {
      if(code[c].value == ""){
        $(code[c]).parent().addClass("line_error");
        toReturn = false;
      }else{
        $(code[c]).parent().removeClass("line_error");
      }
      if(size[c].value == ""){
        $(size[c]).parent().addClass("line_error");
        toReturn = false;
      }else{
        $(size[c]).parent().removeClass("line_error");
      }
      if(quantity[c].value == ""){
        $(quantity[c]).parent().addClass("line_error");
        toReturn = false;
      }else{
        $(quantity[c]).parent().removeClass("line_error");
      }
      //usado em mestre-detalhe que retira produtos do estoque
      if($(quantity[c]).parent().hasClass("line_error")){
        toReturn = false;
      }
    }
    return toReturn;
  }

  var validate_quantity_value;

  function validate_quantity(input){
      quantity = $(input).parent().parent().find("input.quantity").val();
      quantity_tr = $(input).parent().parent().find("input.quantity").parent();
      code = $(input).parent().parent().find("select.code").val();
      size = $(input).parent().parent().find("select.size").val();
    if(!((code=="")||(size=="")||(quantity==""))){
      $.ajax({
          type: "POST",
          url: base_url+"addons/php/queries/jtc_quantity_queries.php",
          data: {"code": code, "size": size, "quantity": quantity}
        }).done(function(data){
          if(data==0){
            $(quantity_tr).addClass("line_error");
          }else{
            $(quantity_tr).removeClass("line_error");
          }
        });
    }else{

    }
  }

  //fim das funções do mestre-detalhe

$(document).ready(function(){

  $(".line_child").prop("hidden", false);

  $('.table_datatable').dataTable({
    autoWidth: true,
    "orderCellsTop": true,
    "language": {
      "url": "//cdn.datatables.net/plug-ins/1.10.12/i18n/Portuguese-Brasil.json"
    }
  });

  // $( "#accordion" ).accordion({
  //   heightStyle: "content",
  //   collapsible: true
  // });

  document.cookie = "cookie1=kiekiekie";


  $("#table_tabs").tabs();

  $(".radio_type").click(function(){
    if($(this).val() == 1){
      $("#modal_list_button").prop("disabled", false);
    }else{
      $("#modal_list_button").prop("disabled", true);
    }
  });

  $("#checkbox_date").click(function(){
      $("#input_date, #input_hour").prop("disabled", !$("#input_date").prop("disabled"));
  });

});

$.datepicker.regional['pt-BR'] = {
  closeText: 'Fechar',
  prevText: '&#x3c; Anterior',
  nextText: 'Próximo &#x3e;',
  currentText: 'Hoje',
  monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
  monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
  dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
  dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb'],
  dayNamesMin: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb'],
  weekHeader: 'Sm',
  dateFormat: 'dd/mm/yy',
  firstDay: 0,
  isRTL: false,
  showMonthAfterYear: false,
    yearRange: "1980:2017",
  yearSuffix: ''
};
$.datepicker.setDefaults($.datepicker.regional['pt-BR']);

$(function () {
  var icons = {
    header: "ui-icon-triangle-1-e",
    activeHeader: "ui-icon-triangle-1-s",
    headerSelected: "ui-icon-triangle-1-s"
  };
  var act = 0;
  $( "#accordion" ).accordion({
    icons: icons,
    collapsible: true,
    clearStyle: true,
    heightStyle: "content",
    autoHeight: false,
    create: function(event, ui) {
      //get index in cookie on accordion create event
      if($.cookie('saved_index') != null){
        act =  parseInt($.cookie('saved_index'));
      }
    },
    activate: function(event, ui) {
      //set cookie for current index on change event
      var active = jQuery("#accordion").accordion('option', 'active');
      $.cookie('saved_index', null);
      $.cookie('saved_index', active);
    },
    active:parseInt($.cookie('saved_index'))
  });
  $( "#toggle" ).button().toggle(function() {
      $( "#accordion" ).accordion( "option", "icons", false );
    },
    function() {
      $( "#accordion" ).accordion( "option", "icons", icons );
    });
});