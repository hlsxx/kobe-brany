<template>
  <div :id="'katalog-item-' + item.id" class="item-hover col-lg-3 mb-4">
    <router-link :to="{ name: 'Detail', params: { itemId: item.id } }">
      <div class="service-item first-service" :class="stateClass(item)">
        <div class="katalog-item-img">
          <img :src="'http://localhost/holes/kobe-brany/files/products/' + item.image"/>
        </div>
        <h4>{{ item.name }}</h4>
        <h5>{{ item.price }} €</h5>
        <p>{{ item.description }}</p>
      </div>
    </router-link>
  </div>
</template>

<script>
export default {
  props: ['item'],
  methods: {
    stateClass(item) {
      if (item['state'] == 2) {
        return 'top';
      }
    }
  }
}
</script>
