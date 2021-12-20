<?php

$produkty = new Components\TableLarge("products");

// Vyber iba produktu s typom 1 cize custom produkt
$produkty->conditions([
  'where' => [
    'type' => 1
  ]
]);

$produkty->buttons([
  ["name" => "Príslušenstvo", "link" => "prislusenstvo"]
]);

$dia->template(
  $dia->cardBook(
    "<div class='card'>
      ".$produkty->show()."
    </div>"
  )
)->render();