<template>
  <div class="main-banner wow fadeIn" data-wow-duration="1s" data-wow-delay="0.5s"></div>
  <div id="detail" class="services section d-flex justify-content-center">
    <div class="container m-5 p-3">
      <div :id="'katalog-item-' + data.id">
        <div class="service-item first-service">
          <div class="row">
            <div class="col-5">
              <div class="katalog-item-img">
                <img :src="'http://localhost/holes/kobe-brany/files/products/' + data.image"/>
              </div>
            </div>
            <div class="col-1">
              <div class="d-flex flex-column">
                <div class="pb-3">
                  <div class="katalog-item-img">
                    <img :src="'http://localhost/holes/kobe-brany/files/products/' + data.image"/>
                  </div>
                </div>
                <div class="pb-3">
                  <div class="katalog-item-img">
                    <img :src="'http://localhost/holes/kobe-brany/files/products/' + data.image"/>
                  </div>
                </div>
                <div class="pb-3">
                  <div class="katalog-item-img">
                    <img :src="'http://localhost/holes/kobe-brany/files/products/' + data.image"/>
                  </div>
                </div>
                <div class="pb-3">
                  <div class="katalog-item-img">
                    <img :src="'http://localhost/holes/kobe-brany/files/products/' + data.image"/>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-6">
              <h2>{{ data.name }}</h2>
              <h3 class="mt-3">{{ data.price }} €</h3>
              <p>{{ data.description }}</p>
              <button 
                @click="addToCart(data.id)"
                class="btn btn-primary"
              >Pridať do košíka</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <register-com></register-com>
  <footer-com></footer-com>
</template>

<script>
import footer from './Footer.vue';
import register from './Register.vue';

var f = Object();

export default {
  data() {
    return {
      data: {}
    }
  },
  components: {
    'register-com': register,
    'footer-com': footer
  },
  methods: {
    addToCart(productId) {
      axios.post('Admin/index.php?action=web_pridaj_produkt_do_kosika', {
        idProduct: productId
      }).then((res) => {
          if (res.data.status != 'fail') {
            swal({
              title: "Produkt bol pridaný do košíka",
              type: "success",
              showCancelButton: true,
              cancelButtonClass: "btn btn-primary mt-4",
              confirmButtonClass: "btn btn-secondary mt-4",
              confirmButtonText: "Do košíka",
              cancelButtonText: "Prokačovať v nákupe",
              closeOnConfirm: false,
              closeOnCancel: false,
            },
            function(isConfirm) {
              if (isConfirm) {
                window.location.href = 'kosik';
              } else {
                swal.close()
              }
            }
          )
        }
      })
    }
  },
  beforeMount() {
    f = new Functions();

    var idDetail = f.getUrlParam('id');

    if (typeof idDetail == "undefined") {
      idDetail = this.$route.params.itemId;
    }

    f.addToUrl('id', idDetail);

    axios.get('Admin/index.php?action=web_get_detail', {
      params: {
        id: idDetail
      }
    }).then((res) => {
      this.data = res.data['data'];
    })
  }
}
</script>
