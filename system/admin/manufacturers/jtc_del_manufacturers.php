<?php
  /**
  *Funcionalidade: Este arquivo deleta um fabricante.
  *Data de criação: 24/10/2014
  */

  $id = $_GET["delid"];
  $result = deletar("manufacturers", "id=".$id);
      if($result){
          $msgid = 11;
          $data = "Fabricante";
      }else{
        $msgid = 10;
        $data = "Fabricante";
      }

    header("Location: ?folder=manufacturers/&file=jtc_fminsupd_manufacturers&ext=phP&msgid=".$msgid."&data=".$data);
