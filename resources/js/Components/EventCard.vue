<template>
  <div class="bg-white rounded-lg shadow-md p-4">
    <h2 class="text-xl font-bold mb-2">{{ event.name }}</h2>

    <p class="text-gray-500 mb-4">{{ event.description }}</p>
    <p class="text-gray-500 mb-4">Location</p>
    <p class="text-gray-500 mb-4">{{ event.location }}</p>
    <p class="text-gray-500 mb-4">vip Price</p>
    <p class="text-gray-500 mb-4">{{ event.vip_price }}</p>
    <p class="text-gray-500 mb-4">regular Price</p>
    <p class="text-gray-500 mb-4">{{ event.regular_price }}</p>
    <div class="flex justify-between items-center">
      <span class="text-gray-600">{{ event.date }}</span>
      <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
        Register
      </button>
    </div>
  </div>
</template>

<script>
import { defineComponent } from 'vue';

export default defineComponent({
  name: 'EventCard',
  props: {
    event: {
      type: Object,
      required: true,
    },
  },
});
</script>

<style scoped>
/* Add any custom styles here */
</style>
