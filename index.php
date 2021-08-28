<?php
  session_start();
  ob_start();
  require_once('Core/boot.php');

  // Elasticsearch
  if ($dia->config['web']['elasticsearch']) {
    require 'vendor/autoload.php';

    $client = Elasticsearch\ClientBuilder::create()
      ->setHosts(['localhost:9200'])
      ->build()
    ;
  }
  
  $dia->autoload();

  $db = new \Core\Classes\DB();
  $ui = new \Core\Classes\UI();
  $vue = new \Core\Classes\Vue();

  if (!isset($_GET['json_action'])) {

    // HEAD
    $dia->daj_zahlavie();

    // HLAVICKA 
    if ($dia->installed) $dia->daj_hlavicku();

    if ($dia->installed) {
      echo "<div id='app'>";
      // OBSAH
      $page = (isset($_GET['page']) && $_GET['page'] != '') ? $_GET['page'] : $dia->web_home();

      foreach ($dia->pages as $podstranka) {
        if ($podstranka != '' && $podstranka == $page) {
          include "web/{$dia->config['web']['pages']}/{$page}.php";
        }
      }
    
    } else {
      include "Core/public/web/pages/install.php";
    }

    // VUE LOADER START
  ?>
    <script>
    const options = {
      moduleCache: {
        vue: Vue
      },
      async getFile(url) {

        const res = await fetch(url);
        if ( !res.ok )
          throw Object.assign(new Error(res.statusText + ' ' + url), { res });
        return await res.text();
      },
      addStyle(textContent) {

        const style = Object.assign(document.createElement('style'), { textContent });
        const ref = document.head.getElementsByTagName('style')[0] || null;
        document.head.insertBefore(style, ref);
      },
    }

    const { loadModule } = window['vue3-sfc-loader'];

    const app_loader = Vue.createApp({
      components: {
        'dia-alert': Vue.defineAsyncComponent( () => loadModule('./Core/vue/components/Alert.vue', options)),
        'dia-form': Vue.defineAsyncComponent( () => loadModule('./Core/vue/components/Form.vue', options)),
        'dia-table': Vue.defineAsyncComponent( () => loadModule('./Core/vue/components/Table.vue', options)),
        'dia-jumbotron': Vue.defineAsyncComponent( () => loadModule('./Core/vue/components/Jumbotron.vue', options)),
        'dia-elasticsearch': Vue.defineAsyncComponent( () => loadModule('./Core/vue/components/Elasticsearch.vue', options)),
        'dia-custom': Vue.defineAsyncComponent( () => loadModule('./Core/vue/components/Custom.vue', options)),
        <?php
          if (isset($GLOBALS['web_vue_components'])) {
            foreach ($GLOBALS['web_vue_components'] as $com) {
              echo "'$com': Vue.defineAsyncComponent( () => loadModule('./web/components/$com.vue', options)),";
            }
          }
        ?>
      },
      template: `<?php 
        if (isset($GLOBALS['dia_vue_components'])) {
          foreach ($GLOBALS['dia_vue_components'] as $com) {
            $com->render();
          }
        }
        /*if (isset($GLOBALS['vue_components'])) {
          foreach ($GLOBALS['vue_components'] as $com) {
            if (isset($$com['params'])) {
              $html_params = "";
              $arrays = "";
              foreach ($$com['params'] as $key => $val) {
                if (is_array($val)) {
                  $arrays .= "$key: " . json_encode($$com['params'][$key]) . ", ";
                } else {
                  $html_params .= "$key: \"{$$com['params'][$key]}\", ";
                }
              }
              echo "<$com :params='{
                $html_params
                $arrays
              }'/>";
            } else if(in_array($com, $dia->components)){
              echo "<$com/>";
            } else {
              echo $com;
            }
          }
        }*/
     ?>`
    });

    app_loader.mount('#app');

    </script>

  <?php

    // ZAPATICKA
    $dia->daj_zapaticku();

    echo "</div>";
    
    // PATICKA
    $dia->daj_paticku();

    // HLADA AKCIE
    $dia->action_find();

  } else {
    // HLADA AKCIE JSON
    $dia->json_action_find();
  }
  ob_end_flush();
?>