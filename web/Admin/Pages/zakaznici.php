<?php

use \Components\TableLarge;
use \Components\Row;

$zakaznici = new TableLarge("customers");

$pridat = new Row("customers");

$dia->template("
  {$pridat->show()}
  ".$dia->card($zakaznici->show())."
")->render();
