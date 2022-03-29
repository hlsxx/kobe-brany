<?php

$objednavkyQuery = $db->dbSelect(
  "carts_products",
  [
    "select" => "products.type as type, products.name as name, SUM(products.price) as suma",
    "join" => [
      "products" => [
        "id_product",
        "id"
      ],
      "carts" => [
        "id_cart",
        "id"
      ]
    ],
    "whereArray" => [
      ["carts.is_order", "=", 1]
    ],
    "group_by" => "type, name",
    "order_by" => "suma"
  ]
);

$objednaneProdukty = [];
$objednaneProduktyCenaSpolu = [];
$objednanePrislusenstvo = [];
$objednanePrislusenstvoCenaSpolu = [];
foreach ($objednavkyQuery as $objednavka) {
  if ($objednavka["type"] == 1) {
    array_push($objednaneProdukty, $objednavka["name"]);
    array_push($objednaneProduktyCenaSpolu, $objednavka["suma"]);
  } else {
    array_push($objednanePrislusenstvo, $objednavka["name"]);
    array_push($objednanePrislusenstvoCenaSpolu, $objednavka["suma"]);
  }
}

$produktyGraf = new Component\Chart("pie");
$produktyGraf->labels($objednaneProdukty);
$produktyGraf->data($objednaneProduktyCenaSpolu);

$prislusenstvoGraf = new Component\Chart("pie");
$prislusenstvoGraf->labels($objednanePrislusenstvo);
$prislusenstvoGraf->data($objednanePrislusenstvoCenaSpolu);

$table_products = new Component\Table("products");
$table_products->columns(['id' => 'ID', 'name' => 'Meno', 'price|$' => 'Cena'])->buttons(['edit', 'delete']);

$timer = new Component\Timer();

$test_tiket = new Component\Tiket();

$dia->template("
  <div class='row'>
    <div class='col-6'>
      <div class='card'>
        <h4 class='card-header text-center'>Tržba z produktov</h4>
        <div class='card-body'>
          {$produktyGraf->show()}
        </div>
      </div>
    </div>
    <div class='col-6'>
      <div class='card'>
        <h4 class='card-header text-center'>Tržba z príslušenstva</h4>
        <div class='card-body'>
          {$prislusenstvoGraf->show()}
        </div>
      </div>
    </div>
  </div>

  <div class='line'></div>

  <div class='row mb-5 ml-1 mr-1'>
    <div class='card'>
      <div class='card-body'>
        <h4 id='specific-markup-required-for-dismiss-on-next-click'>Specific markup required for dismiss-on-next-click</h4>
        
        <p>For proper cross-browser and cross-platform behavior, you must use the <code class='highlighter-rouge'>&lt;a&gt;</code> tag, <em>not</em> the <code class='highlighter-rouge'>&lt;button&gt;</code> tag, and you also must include a <a href='https://developer.mozilla.org/en-US/docs/Web/HTML/Global_attributes/tabindex'><code class='highlighter-rouge'>tabindex</code></a> attribute.</p>
      </div>
    </div>
  </div>

  <div class='row'>
    <div class='col-9'>
      <div class='card'>
        <div clas='card-body'>
          {$table_products->show()}
        </div>
      </div>
    </div>
    <div class='col-3'>
      {$test_tiket->show()}
    </div>
  </div>

  <div class='line'></div>

  <h2>Lorem Ipsum Dolor</h2>
  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
")->render();