<?php
  /**
  *Funcionalidade: Este arquivo deleta um chque.
  *Data de criação: 26/10/2014
  */

  $id = $_GET["delid"];
  $result = deletar("checks", "id=".$id);
      if($result){
          $msgid = 11;
          $data = "Cheque";
      }else{
        $msgid = 10;
        $data = "Cheque";
      }

    header("Location:?folder=check/&file=jtc_fminsupd_check&ext=phP&msgid=".$msgid."&data=".$data);
