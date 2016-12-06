
<?php
    $g_id = $_GET['id'];
    $condition = "id ='".$g_id. "'";
    $data= array(
    'status'=> 1
    );
    $result = alterar("checks", $data, "id=".$g_id);

    if($result){
        $msgid = 14;
        $data= "Cheque";
        header("Location: ?folder=consults/&file=jtc_checks_consults&ext=php&msgid=".$msgid."&data=".$data);
        die();
    }else{
        $msgid = 13;
        $data = "Cheque";
    }
    header("Location: ?folder=consults/&file=jtc_checks_consults&ext=php&updid=".$g_id."&msgid=".$msgid."&data=".$data);
?>

