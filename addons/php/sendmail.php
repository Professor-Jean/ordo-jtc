<?php
  require_once("class.mymail.php");

  $mymail = new MyMail();

  $mymail->setTo(array($_POST['you']));

  $mymail->setFrom("jean.capote@edu.sc.senai.br");

  $mymail->setSubject($_POST['subject']);

  $mymail->setMessage($_POST['message']);

  $mymail->setReplies(array('jean.capote@edu.sc.senai.br', 'jeankpot@gmail.com', 'wanderkpot@gmail.com'));

  $mymail->setCC(array('wanderkpot@gmail.com'));

  $mymail->setBCC(array('jean.capote@edu.sc.senai.br'));

  if($mymail->sendMail()===true){
    echo "E-mail enviado com sucesso!";
  }else{
    echo "Problema ao enviar o e-mail.";
  }
  echo "Testando envio de e-mail...";
 ?>
