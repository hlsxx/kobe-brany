<?php

use Component\TableLarge;
use Component\Row;

$reklamacie = new TableLarge("complaints");
$reklamacie->buttons([
  ["name" => "Dokumenty reklamácie", "link" => "reklamacie-dokumenty", "class" => "btn btn-secondary"],
]);
$reklamacie->conditions([
  "order_by" => "type, id DESC"
]);

$pridat = new Row("complaints");
$pridat->title("Reklamácie");

$dia->template("
  {$pridat->show()}
  <div class='row'>
    <div class='col-9'>
      ".$dia->card(
        $reklamacie ->show()
      )."
    </div>
    <div class='col-3'>
      <div id='accordion'>
        <div class='card'>
          <div class='card-header' id='headingOne'>
            <h5 class='mb-0'>
              <button class='btn btn-link color-primary' data-toggle='collapse' data-target='#collapseOne' aria-expanded='true' aria-controls='collapseOne'>
                <h5>Návod #1: Ako postupovať pri reklamácii</h5>
              </button>
            </h5>
          </div>
      
          <div id='collapseOne' class='collapse show' aria-labelledby='headingOne' data-parent='#accordion'>
            <div class='card-body'>
              <p>1. Vyberte existujúcu objednávku</p>
              <p>2. Určte typ: Nová (Ak ju zatiaľ neschválim) inak Schválena</p>
              <p>3. Popísať problém prečo reklamovať produkt <i>(Fotky a dokumenty sa následné nahrajú po vytvorení reklamácie)</i></p>
              <p>4. Nastaviť <b>dátum a čas</b> kedy sa reklamácia vytvorila</p>
            </div>
          </div>
        </div>
        <div class='card'>
          <div class='card-header' id='headingTwo'>
            <h5 class='mb-0'>
              <button class='btn btn-link color-primary collapsed' data-toggle='collapse' data-target='#collapseTwo' aria-expanded='false' aria-controls='collapseTwo'>
                <h5>Návod #2: Ako nahrávať súbory</h5>
              </button>
            </h5>
          </div>
          <div id='collapseTwo' class='collapse' aria-labelledby='headingTwo' data-parent='#accordion'>
            <div class='card-body'>
              Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
")->render();
