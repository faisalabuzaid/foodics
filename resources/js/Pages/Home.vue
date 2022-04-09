<template>
    <title>Foodics Task</title>
    <div class="bg-white">
        <Header />
        <div class="mt-8 flex justify-between">
            <OrderSummary :order="order" @submitOrder="(order) => submitOrder(order)"></OrderSummary>
            <div class="w-full overflow-hidden mt-2">
                <h2 class="sr-only">Products</h2>

                <div
                    v-if="products"
                    class="px-10 border-l border-gray-200 grid grid-cols-2 sm:mx-0 md:grid-cols-3 lg:grid-cols-4"
                >
                    <div
                        v-for="product in products"
                        :key="product.id"
                        class="group relative p-10 sm:p-6"
                    >
                        <ProductComponent
                            :product="product"
                            @addToOrder="(payload) => addProductToOrder(payload)"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import axios from 'axios';
import { ref } from 'vue';
import ProductComponent from '../components/ProductComponent.vue';
import Header from '../components/Header.vue';
import OrderSummary from '../components/OrderSummary.vue';
import { createToaster } from "@meforma/vue-toaster";

const toaster = createToaster({
    position: "top-right",
});
const products = ref([]);

const fetchInventoryProducts = async () => {
    const response = await axios.get('/api/products');
    products.value = response.data.products;
    return response.data;
};

fetchInventoryProducts();

const order = ref({ products: [] });

const addProductToOrder = (payload) => {
    order.value.products.push(payload);
}

const submitOrder = async (payload) => {
    await axios.post('/api/orders', order.value).then((res) => {
        toaster.success(`Your order has been placed successfully`);
        order.value.products = [];
    });
}
</script>