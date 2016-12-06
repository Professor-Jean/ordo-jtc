<?php
include "../../../security/authentication/jtc_permission_authentication.php";
include "../../../security/database/jtc_connection_database.php";
include "../jtc_helpers_php.php";

$table = 'entries';

// Table's primary key
$primaryKey = 'id';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier - in this case object
// parameter names
$columns = array(
  array(
    'db' => 'id',
    'dt' => 'DT_RowId',
    'formatter' => function( $d, $row ) {
      // Technically a DOM id cannot start with an integer, so we prefix
      // a string. This can also be useful if you have multiple tables
      // to ensure that the id is unique with a different prefix
      return 'row_'.$d;
    }
  ),
  array( 'db' => 'id',              'dt' => 'id' ),
  array( 'db' => 'sellers_id',      'dt' => 'sellers_id' ),
  array( 'db' => 'date',            'dt' => 'date' ),
  array( 'db' => 'hour',            'dt' => 'hour' ),
  array( 'db' => 'type',            'dt' => 'type' ),
  /*array(
      'db'        => 'start_date',
      'dt'        => 'start_date',
      'formatter' => function( $d, $row ) {
          return date( 'jS M y', strtotime($d));
      }
  ),
  array(
      'db'        => 'salary',
      'dt'        => 'salary',
      'formatter' => function( $d, $row ) {
          return '$'.number_format($d);
      }
  )*/
);

$sql_details = array(
  'user' => 'root',
  'pass' => 'root',
  'db'   => 'jtc_database',
  'host' => 'localhost',
);


/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
require("../class.ssp.php");

$json = SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns );
$c = 0;
$type = array(
  0 => "Produto Novo",
  1 => "Devolução",
  2 => "Reposição",
);
while($data = @$json["data"][$c]){
    if($json["data"][$c]["sellers_id"]==""){
        $json["data"][$c]["sellers_id"] = "---";
    }else{
        $sql_select_sellers = "SELECT name FROM sellers WHERE id=".$json["data"][$c]["sellers_id"];
        $sql_select_sellers_prepare = $dbconnection->prepare($sql_select_sellers);
        $sql_select_sellers_prepare->execute();
        $sellers_name = $sql_select_sellers_prepare->fetch();
        $json["data"][$c]["sellers_id"] = $sellers_name["name"];
    }
    $json["data"][$c]["type"] = $type[$json["data"][$c]["type"]];
    $json["data"][$c]["date"] = date_converter($json["data"][$c]["date"], "-");
    $json["data"][$c]["hour"] = substr($json["data"][$c]["hour"], 0, -3);
    $c++;
}

echo json_encode($json);
?>
