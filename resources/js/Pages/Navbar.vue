<template>
  <nav>
    <ul>
      <li v-for="item in menuItems" :key="item.id">
        <a :href="item.url">{{ item.label }}</a>
      </li>
    </ul>
  </nav>
</template>

<script>
import { ref } from 'vue';

export default {
  setup() {
    const menuItems = ref([
      { id: 1, label: 'Home', url: '/' },
      { id: 2, label: 'About', url: '/about' },
      { id: 3, label: 'Contact', url: '/contact' },
    ]);

    return {
      menuItems,
    };
  },
};
</script>

<style scoped>
nav {
  background-color: #f0f0f0;
  padding: 10px;
}

ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
}

li {
  display: inline-block;
  margin-right: 10px;
}

a {
  text-decoration: none;
  color: #333;
}
</style>
