<template>
  <div class="main-banner wow fadeIn" data-wow-duration="1s" data-wow-delay="0.5s"></div>
  <div id="kosik" class="services" style="z-index:9999999">
    <div class="section container mt-5 p-5">
      <div v-if="Object.keys(data).length > 0">
        <table class="table">
          <tbody>
            <tr v-for="item in data" :key="item.id">
              <td>{{ item.name }}</td>
              <td>{{ item.price_without_vat }}€</td>
              <td>{{ item.vat }}%</td>
              <td>{{ item.price }}€</td>
              <td>
                <button 
                  @click="deleteItem(item.idCartProduct)"
                  class="btn btn-danger"
                >
                  <i class="fas fa-times"></i>
                </button>
              </td>
            </tr>
          </tbody>
        </table>

        <div class="row">
          <div class="col-6">
            <div class="box-item">
              <h4>
                <a href="#">400</a>
              </h4>
              <p>Spolu</p>
            </div>
          </div>
          <div class="col-6">
            <router-link :to="{name: 'Objednavka'}">
              <div class="gradient-button"><a href="#">Prejsť k objednávke</a></div>
            </router-link>
          </div>
        </div>
      </div>
      <div v-else class="mt-5 text-center">
        <h1>Váš nákupný košík je prázdny</h1>
        <img 
          src="http://localhost/holes/kobe-brany/files/empty-cart.png" 
          alt="prazdny_kosik"
          style="height:250px;width:365px"
        >
      </div>
    </div>
  </div>
  <register-com></register-com>
  <footer-com></footer-com>
</template>

<script>
import footer from './Footer.vue';
import register from './Register.vue';

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
    deleteItem(idCartProduct) {
      axios.post('Admin/index.php?action=dia_delete', {
        tableName: "carts_products",
        id: idCartProduct
      }).then(() => {
        this.loadData();
      })
    },  
    loadData() {
      axios.get('Admin/index.php?action=web_kosik')
      .then((res) => {
        if (res.data.status != 'fail') {
          this.data = res.data['data'];
        }
      })
    },
  },
  beforeMount() {
    this.loadData();
  }
}
</script>
