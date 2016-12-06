<?php
/**
 *Funcionalidade: este arquivo é destinado à histórico de entrada de produtos em estoque.
 *Data de criação: 01/11/2016
 */
?>
<h1 id="title-page">Histórico de Entradas de Produtos em Estoque</h1>

<script>


  $(document).ready(function() {
    var dt = $('#x').DataTable( {
      autoWidth: true,
      "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.12/i18n/Portuguese-Brasil.json"
      },
      "processing": true,
      "ajax": base_url+"addons/php/queries/jtc_entries_queries.php",
      "columns": [
        {
          "class":          "details-control",
          "orderable":      false,
          "data":           null,
          "defaultContent": '<i class="fa fa-caret-right" aria-hidden="true"></i>'
        },
        { "data": "id" },
        { "data": "date" },
        { "data": "hour" },
        { "data": "type" },
        { "data": "sellers_id" }
      ],
      "order": [[1, 'asc']]
    } );

    // Array to track the ids of the details displayed rows
    var detailRows = [];

    $('#x tbody').on( 'click', 'tr td.details-control', function () {
      $(this).html('<i class="fa fa-caret-down" aria-hidden="true"></i>');
      var tr = $(this).closest('tr');
      var row = dt.row( tr );
      var idx = $.inArray( tr.attr('id'), detailRows );
      registerid = tr.attr('id').replace('row_','');
      if ( row.child.isShown() ) {
        $(this).html('<i class="fa fa-caret-right" aria-hidden="true"></i>');
        tr.removeClass( 'details' );
        row.child.hide();

        // Remove from the 'open' array
        detailRows.splice( idx, 1 );
      } else {
        $.ajax({
          type: "POST",
          url: base_url+"addons/php/queries/jtc_entries_products_queries.php",
          data: {"id": registerid},
          dataType: "html"
        }).done(function (data){
          tr.addClass( 'details' );
          row.child( data ).show();
          // Add to the 'open' array
          if ( idx === -1 ) {
            detailRows.push( tr.attr('id') );
          }
        });
      }
    } );

    // On each draw, loop over the `detailRows` array and show any child rows
    dt.on( 'draw', function () {
      $.each( detailRows, function ( i, id ) {
        $('#'+id+' td.details-control').trigger( 'click' );
      } );
    } );
  } );
</script>


<table id="x">
  <thead>
  <tr>
    <th></th>
    <th>ID</th>
    <th>Data</th>
    <th>Horário</th>
    <th>Tipo</th>
    <th>Vendedor</th>
  </tr>
  </thead>
  <tbody>
  </tbody>
</table>
