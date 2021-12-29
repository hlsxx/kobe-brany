<?php

for ($i=1;$i<=100;$i++) {
  $db->insert_array([
    'table' => 'products',
    'table_data' => [
      'id' => $i,
      'image' => "product_" . rand(1, 3) . ".png",
      'name' => 'Product_' . $i,	
      'description' => 'Popis', 	
      'price' => rand(0,1000),
      'available' => rand(0,1),
      'count' => rand(0,15),
      'type' => rand(1,2)
    ]
  ]);
}