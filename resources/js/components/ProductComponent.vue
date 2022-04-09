<template>
    <div class="cursor-pointer" @click="showProductModal = true">
        <div
            class="rounded-lg overflow-hidden bg-gray-200 aspect-w-1 aspect-h-1 group-hover:opacity-75"
        >
            <img :src="product.image_src" class="w-full h-full object-center object-cover" />
        </div>
        <div class="pt-10 pb-4 text-center">
            <h3 class="text-sm font-medium text-gray-900">
                <a :href="product.href">
                    <span aria-hidden="true" class="absolute inset-0" />
                    {{ product.name }}
                </a>
            </h3>
            <div class="mt-3 flex flex-col items-center">
                <!-- <p class="mt-1 text-sm text-gray-500">{{ product.description }}</p> -->
            </div>
            <p class="mt-4 text-base font-medium text-gray-900">{{ product.price }}</p>
        </div>
    </div>
    <ProductModal
        :product="product"
        :open="showProductModal"
        @close="(value) => openProductModal(value)"
        @addToOrder="(value) => emit('addToOrder', value)"
    />
</template>
<script setup>
import { ref } from 'vue';
import ProductModal from './ProductModal.vue';

const props = defineProps({
    product: Object,
});

const emit = defineEmits(['addToOrder']);

const showProductModal = ref(false);

const openProductModal = () => {
    showProductModal.value = !showProductModal.value;
}

</script>
