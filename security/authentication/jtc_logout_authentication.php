<?php
  /**
  *Funcionalidade: este arquivo realiza a funcionalidade de logout
  *Data de criação: 17/10/2016
  */
  session_start();
  session_destroy();
  header("location: ../../index.php");
