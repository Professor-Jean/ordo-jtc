<?php
  ob_start();
  /**
  *Funcionalidade: este arquivo possui a página principal da área dos administradores
  *Data de criação: 17/10/2016
  */
  include "../../security/authentication/jtc_permission_authentication.php";
  include "../../security/database/jtc_connection_database.php";
  include "../../addons/php/jtc_messageRepository_php.php";
  include "../../addons/php/jtc_validations_php.php";
  include "../../addons/php/jtc_operationsdb_php.php";
  include "../../addons/php/jtc_helpers_php.php";
date_default_timezone_set("America/Sao_Paulo");
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>JTC</title>
    <!-- estilos css -->
    <link rel="stylesheet" href="../../layout/css/jtc_reset_css.css">
    <link rel="stylesheet" href="../../layout/css/jtc_main_css.css">
    <link rel="stylesheet" href="../../layout/css/datatables.css"><!-- estilo das tabelas -->
    <!-- ícones -->
    <link rel="stylesheet" href="../../addons/css/font-awesome-4.6.3/css/font-awesome.min.css">
    <!-- scripts -->
    <script>
      var base_url = "http://<?php echo $_SERVER['SERVER_ADDR']; ?>/ordo-jtc/";
    </script>
    <script src="../../addons/js/jquery.js"></script>
    <script src="../../addons/js/jquery-ui.js"></script>
    <script src="../../addons/js/datatables/datatables.min.js"></script>
    <script src="../../addons/js/jtc_main_js.js"></script>
    <script src="../../addons/js/jtc_ajax_js.js"></script>
    <script src="../../addons/js/Chart.min.js"></script>
    <script src="../../addons/js/jquery.cookie.js"></script>
    <script>
      $(function(){
        $(".datepicker").datepicker({
          changeMonth: true,
          changeYear: true,
        });
      });
    </script>
  </head>
  <noscript id="noscript">
    <h1>O JavaScript é necessário para a utilização deste Software!</h1>
    <a href="http://enable-javascript.com/pt/">Como ativar o JavaScript</a>
  </noscript>
  <body>
    <main id="content">
      <nav id="nav">
        <a href="jtc_main_admin.php"><h4>JTC</h4></a>
        <div id="user">
          <span><?php echo $_SESSION["username"];?></span>
          <a href="?folder=admin/&file=jtc_fminsupd_admin&ext=php&updid=<?php echo $_SESSION["id"];?>"><i class="fa fa-cog" aria-hidden="true"></i></a>
          <a href="../../security/authentication/jtc_logout_authentication.php"><i class="fa fa-sign-out" aria-hidden="true"></i></a>
        </div>
        <div id="accordion">
          <a class="tab">Registros</a>
          <div>
            <a href="?folder=admin/&file=jtc_fminsupd_admin&ext=php">Registro de Administrador</a>
            <a href="?folder=product/&file=jtc_fminsupd_product&ext=php">Registro de Produto</a>
            <a href="?folder=details/&file=jtc_fminsupd_details&ext=php">Registro de Detalhes de Produto</a>
            <a href="?folder=manufacturers/&file=jtc_fminsupd_manufacturers&ext=php">Registro de Fabricantes</a>
            <a href="?folder=state_city/&file=jtc_fminsupd_state_city&ext=php">Registro de Cidade & Estado</a>
            <a href="?folder=seller/&file=jtc_fminsupd_seller&ext=php">Registro de Vendedor</a>
            <a href="?folder=check/&file=jtc_fminsupd_check&ext=php">Registro de Cheques</a>
          </div>
          <a class="tab">Movimentações de Produtos</a>
          <div>
            <a href="?folder=entry_inventory/&file=jtc_fmins_entry_inventory&ext=php">Entrada de Produtos em Estoque</a>
            <a href="?folder=passthrough_merchandise/&file=jtc_fmins_passthrough_merchandise&ext=php">Repasse de Mercadorias para Vendedores</a>
            <a href="?folder=passthrough_presents/&file=jtc_fmins_passthrough_presents&ext=php">Repasse de Brindes para Vendedores</a>
            <a href="?folder=concert/&file=jtc_fmins_product_for_concert&ext=php">Repasse de Produto para Conserto</a>
          </div>
          <a class="tab">Consultas</a>
          <div>
            <a href="?folder=consults/&file=jtc_products_consults&ext=php">Consulta de Produtos</a>
            <a href="?folder=consults/&file=jtc_checks_consults&ext=php">Consulta de Cheques</a>
            <a href="?folder=consults/&file=jtc_inventory_consults&ext=php">Consulta de Estoque</a>
            <a href="?folder=consults/&file=jtc_manufacturers_consults&ext=php">Consulta de Fabricantes</a>
            <a href="?folder=consults/&file=jtc_devolutions_consults&ext=php">Consulta de Devoluções</a>
            <a href="?folder=consults/&file=jtc_repair_consults&ext=php">Consulta de Repasse de Conserto</a>
          </div>
          <a class="tab">Históricos</a>
          <div>
            <a href="?folder=consults/&file=jtc_historic_present_consults&ext=php">Histórico de Brindes</a>
            <a href="?folder=consults/&file=jtc_historic_entries_inventory&ext=php">Histórico de Entradas de Produtos em Estoque</a>
            <a href="?folder=consults/&file=jtc_historic_defective_product&ext=php">Histórico de Repasses de Produtos Defeituosos</a>
            <a href="?folder=consults/&file=jtc_historic_merchandise&ext=php">Histórico de Repasses de Mercadoria</a>
          </div>
        </div>
      </nav>
      <article id="article">
        <?php
        //carregamento dinâmico
        if(isset($_GET['folder'])&&isset($_GET['file'])&&isset($_GET['ext'])){
          if(!include $_GET['folder'].$_GET['file'].".".$_GET['ext']){
            echo "<h1>Página não encontrada</h1>";
          }
        }else{
          include "jtc_info_admin.php";
        }
        ?>
      </article>
      <div class="modal_mask" id="modal_confirm">
        <div class="center-absolute">
          <h1>Deletar</h1>
          <p></p>
          <span class="buttons_modal">
            <button onclick="close_modal('modal_confirm')">Cancelar</button>
            <button><a id="link_delete">Deletar</a></button>
          </span>
        </div>
      </div>

      <div class="modal_mask" id="modal_list">
        <div class="center-absolute">
          <h1 id="modal_title"></h1>
          <p>
          </p>
          <span class="buttons_modal">
            <button onclick="close_modal('modal_list')">Cancelar</button>
            <button type="button" onclick="select_input()">Selecionar</button>
          </span>
        </div>
      </div>

      <div class="modal_mask" id="modal_repairs">
        <div class="center-absolute">
          <h1 id="modal_title">Reparos</h1>
          <table>
            <thead>
              <tr>
                <th>Código</th>
                <th>Data</th>
                <th>Horário</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $sql_select_repairs = "SELECT id, date, hour FROM repairs WHERE entries_id IS NULL";
              ?>
            </tbody>
          </table>
          <span class="buttons_modal">
            <button onclick="close_modal('modal_repairs')">Cancelar</button>
            <button type="button" onclick="select_input()">Selecionar</button>
          </span>
        </div>
      </div>

    </main>
  </body>
</html>
