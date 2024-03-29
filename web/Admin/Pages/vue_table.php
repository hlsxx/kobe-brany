<?php

  //Ukazka vstavanej komponenty TABLE v DIE
  //Volanie:
  //$nejaky_nazov = new Table\Component("sem_nazov_tabulky");
  /*
    $nejaky_nazov
    ->columns(['id' => 'ID', 'first_name' => 'Meno', 'email' => 'Email'])
    ->columnStyle(['id' => 'color:red;font-size:33px'])
    ->rowStyle(['id' => ['5', 'background:red']])
    ->buttons(['edit', 'delete'])
    ->formInputs(['id', 'first_name'])
  ;
  */
  $table_products = new Component\Table("products");
  $table_products->columns(['id' => 'ID', 'name' => 'Meno', 'price|$' => 'Cena'])->buttons(['edit', 'delete']);
  $table_products->render();

  $table_users = new Component\Table("users");
  $table_users
    ->columns(['id' => 'ID', 'first_name' => 'Meno', 'email' => 'Email'])
    ->columnStyle(['id' => 'color:red;font-size:33px'])
    ->rowStyle(['id' => ['5', 'background:red']])
    ->buttons(['edit', 'delete'])
    ->formInputs(['id', 'first_name'])
  ;
  $table_users->render();

  $alert = (new \Component\Alert("Totto je test alert"))->render();

  $table_products = new Component\Table("products");
  $table_products->columns(['id' => 'ID', 'name' => 'Meno', 'price|$' => 'Cena'])->render();


