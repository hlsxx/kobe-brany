<?php

$jsonEditor = new Component\JsonEditor("dia_tables");
$dia->template(
  $dia->cardBook(
    $jsonEditor->show()
  )
)->render(); 