<?php

  $nadpis = $dia->html("
    <div style='text-align:center'>
      <h1 style='color:grey'>Test</h1>
    </div>
  ");

  $tests = new Component\TableList("tests");
  $tests->actionButton([
    "name" => "Otvor",
    "class" => "btn btn-success",
    "params" => [
      "tableName" => "user_tests",
      "action" => "TableList",
      "conditions" => [
        "select" => "first_name, last_name",
        "join" => [
          "users" => [
            "user_id",
            "id"
          ]
        ],
        "where" => [
          "test_id" => '$id'
        ],
        "group_by" => "user_id",
      ]
    ]
  ]);

  $renderId = 3;

  $list = new Component\TableList("users");

  $list->actionButton([
    "name" => "ActionButton",
    "class" => "btn btn-danger",
    "params" => [
      "tableName" => "user_tests",
      "column" => "user_id"
    ]
  ]);

  $xx = "<div style=\"background:red\">XXX</div>";
  /*$list->addColumn([
    "open" => "<button @click.native=\"emitComponent()\" class=\"btn btn-primary\">Otvor test</button>",
    "close" => "<button onclick=\"alert()\" class=\"btn btn-warning\">EDIT</button>"
  ]);*/

  $list_user_test = new Component\TableList("user_tests");
  $list_user_test->hide("
    <div style=\"text-align:center;margin-top:25px\">
      <h1 style=\"color:grey\">Vyberte uzivatela</h1>
    </div>
  ");

  $list_user_test->actionButton([
    "name" => "Zobraz",
    "class" => "btn btn-danger",
    "params" => [
      "tableName" => "user_tests",
      "action" => "Dropzone",
      "conditions" => [
        "where" => [
          "user_id" => '$id',
        ]
      ]
    ]
  ]);

  $dropzone = new Component\Dropzone("user_tests");
  $dropzone->conditions([
    "where" => [
      'user_id' => 1,
      'test_id' => 1
    ]
  ]);

  $dia->template(
    $dia->cardBook("
      {$nadpis->render()}
      <!--<button @click='forcex()'>Re-rendruj komponentu</button>-->
      <div class='row'>
        <div class='col-6' style='padding-left:100px;padding-right:100px'>
          <div id='test'>
            {$tests->show()}
          </div>
          <div id='dropzone'>
            {$dropzone->show()}
          </div>
        </div>
        <div class='col-6'>
          {$list_user_test->show()}
        </div>
      </div>
    ")
  )->render();

  $dia->setScript("
    function lol() {
      $('#test').hide();
      $('#dropzone').fadeIn();
    }

    function backToTable() {
      $('#test').fadeIn();
      $('#dropzone').hide();
    }
  ");

  $vue->setMethods("
    forcex() {
      this.componentKey += 1; 
    }
  ");

  $vue->setData([
    'id' => 2,
    'xx' => 'Jozef',
    'items' => [
      'x' => 1
    ],
    'componentKey' => $renderId
  ]);
