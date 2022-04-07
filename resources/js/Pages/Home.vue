<!--
  This example requires Tailwind CSS v2.0+ 
  
  This example requires some changes to your config:
  
  ```
  // tailwind.config.js
  module.exports = {
    // ...
    plugins: [
      // ...
      require('@tailwindcss/aspect-ratio'),
    ],
  }
  ```
-->
<template>
    <div class="bg-white">
        <div class="max-w-7xl mx-auto overflow-hidden sm:px-6 lg:px-8">
            <h2 class="sr-only">Products</h2>

            <div
                v-if="items"
                class="-mx-px border-l border-gray-200 grid grid-cols-2 sm:mx-0 md:grid-cols-3 lg:grid-cols-4"
            >
                <div
                    v-for="product in items"
                    :key="product.id"
                    class="group relative p-4 border-r border-b border-gray-200 sm:p-6"
                >
                    <ProductComponent :product="product" @open="(item) => openItemModal(item)" />
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
// import { StarIcon } from '@heroicons/vue/solid'
import axios from 'axios';
import { ref } from 'vue';
import ProductComponent from '../components/ProductComponent.vue';
import ProductModal from '../components/ProductModal.vue';

const items = ref([]);
const showProductModal = ref(false);
const selectedProduct = ref({});
const fetchInventoryItems = async () => {
    const response = await axios.get('/api/products');
    items.value = response.data.products;
    return response.data;
};

fetchInventoryItems().then(() => {

});

const openItemModal = (product) => {
    selectedProduct.value = items.value.find(item => item.id = product.id);
    // console.log(selectedProduct.value);
    showProductModal.value = true;
}
</script>