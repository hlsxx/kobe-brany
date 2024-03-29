<?php

$idProduct = \Core\Controllers\WebController::getParam('id');
//$idProductAccessory = \Core\Controllers\WebController::getParam('id_form');

// Ak je id_form dosadeni cez JS tak $_GET je prazdny.
// V tomto pripade sa dosadi cez JS code pomocou {%%}
$idProductAccessory = "{%id_form%}";

$prislusenstvo = new Component\TableLarge("products_accessories");
$prislusenstvo->emptyDataMessage("Žiadne príšlušenstvo pre produkt");
$prislusenstvo->conditions([
  "select" => "products.*",
  "where" => [
    "id_product" => $idProduct
  ],
  "join" => [
    "products" => [
      "id_product_accessory",
      "id"
    ]
    ],
    "order_by" => "products_accessories.id"
]);
$prislusenstvo->fileDir("products");

$prislusenstvo->buttons([
  [
    "name" => "Odstrániť z príslušenstva", 
    "customLink" => "index.php?action=prislusenstvo_odstran_produkt&table_name=products_accessories&id_accessory={$idProductAccessory}&id_product={$idProduct}"
  ]
]);

$prislusenstvo->showDeleteButton(false);
$prislusenstvo->showSaveButton(false);

$prislusenstvo->tableButtons([
  [
    "name" => "Pridať produkt do príslušenstva", 
    "link" => "prislusenstvo_pridat",
    "linkId" => "id",
    "itemData" => ["id" => $idProduct]
  ]
]);

$dia->template(
  $dia->cardBook(
    $prislusenstvo->show()
  )
)->render();
