<?php

include_once "../../../security/authentication/jtc_permission_authentication.php";
include_once "../../../security/database/jtc_connection_database.php";


/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simply to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */

// DB table to use
$table = 'manufacturers';

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
  array( 'db' => 'name', 'dt' => 'name' ),
  array( 'db' => 'cnpj',  'dt' => 'cnpj' ),
  array( 'db' => 'email',   'dt' => 'email' ),
  array( 'db' => 'phone',     'dt' => 'phone' ),
  array(
    'db'        => 'name',
    'dt'        => 'name',
    'formatter' => function( $d, $row ) {
      return date( 'jS M y', strtotime($d));
    }
  ),
  array(
    'db'        => 'phone',
    'dt'        => 'phone',
    'formatter' => function( $d, $row ) {
      return '$'.number_format($d);
    }
  )
);

$sql_details = array(
  'user' => 'root',
  'pass' => 'root',
  'db'   => 'jtc_database',
  'host' => '127.0.0.1'
);


/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */

require( '../class.ssp.php' );

echo json_encode(
  SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);



//  $sql_select_manufacturers = "SELECT name, cnpj, email, phone FROM manufacturers";
//  $sql_select_manufacturers_prepare = $dbconnection->prepare($sql_select_manufacturers);
//  $sql_select_manufacturers_prepare->execute();
//
//  $info = array(
//    "draw"=> 1,
//    "recordsTotal"=> 57,
//    "recordsFiltered"=> 57,
//  );
//  while($sql_select_manufacturers_data = $sql_select_manufacturers_prepare->fetch()){
//    $info["data"][] = array(
//      $sql_select_manufacturers_data["name"],
//      $sql_select_manufacturers_data["cnpj"],
//      $sql_select_manufacturers_data["email"],
//      $sql_select_manufacturers_data["phone"],
//    );
//  }
//  echo json_encode($info);
;