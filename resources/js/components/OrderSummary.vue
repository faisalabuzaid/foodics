<!-- This example requires Tailwind CSS v2.0+ -->
<template>
    <section v-if="order.products.length" class="space-y-6 w-1/2">
        <div class="bg-white px-4 py-5 sm:rounded-lg sm:px-6">
            <h2 id="timeline-title" class="text-lg font-medium text-gray-900">Your Order Summary</h2>

            <div v-if="order" class="flow-root mt-5">
                <ul role="list" class="-my-6 divide-y divide-gray-200">
                    <li v-for="product in order.products" :key="product.id" class="flex py-6">
                        <div
                            class="h-24 w-24 flex-shrink-0 overflow-hidden rounded-md border border-gray-200"
                        >
                            <img
                                :src="product.product.image_src"
                                class="h-full w-full object-cover object-center"
                            />
                        </div>

                        <div class="ml-4 flex flex-1 flex-col">
                            <div>
                                <div
                                    class="flex justify-between text-base font-medium text-gray-900"
                                >
                                    <h3>
                                        <a>{{ product.product.name }}</a>
                                    </h3>
                                    <p class="ml-4">{{ product.product.price }}</p>
                                </div>
                                <p class="text-gray-500">Qty {{ product.quantity }}</p>
                                <p
                                    v-for="ingredient in product.product.product_ingredients"
                                    class="font-medium text-gray-500"
                                >{{ ingredient.ingredient.name }} {{ ingredient.quantity * 1000 }} g</p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="border-t border-gray-200 py-6 px-4 sm:px-6 mt-6">
                <button
                    v-if="!order.id"
                    href="#"
                    @click="emit('submitOrder', order)"
                    class="flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-indigo-700"
                >Submit Order</button>
            </div>
        </div>
    </section>
</template>

<script setup>

const props = defineProps({
    order: Object,
});

const emit = defineEmits(['submitOrder']);


</script>