<template>
    <TransitionRoot as="template" :show="open">
        <Dialog as="div" class="fixed z-10 inset-0 overflow-y-auto" @close="closeModal()">
            <div
                class="flex min-h-screen text-center md:block md:px-2 lg:px-4"
                style="font-size: 0"
            >
                <TransitionChild
                    as="template"
                    enter="ease-out duration-300"
                    enter-from="opacity-0"
                    enter-to="opacity-100"
                    leave="ease-in duration-200"
                    leave-from="opacity-100"
                    leave-to="opacity-0"
                >
                    <DialogOverlay
                        class="hidden fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity md:block"
                    />
                </TransitionChild>

                <!-- This element is to trick the browser into centering the modal contents. -->
                <span
                    class="hidden md:inline-block md:align-middle md:h-screen"
                    aria-hidden="true"
                >&#8203;</span>
                <TransitionChild
                    as="template"
                    enter="ease-out duration-300"
                    enter-from="opacity-0 translate-y-4 md:translate-y-0 md:scale-95"
                    enter-to="opacity-100 translate-y-0 md:scale-100"
                    leave="ease-in duration-200"
                    leave-from="opacity-100 translate-y-0 md:scale-100"
                    leave-to="opacity-0 translate-y-4 md:translate-y-0 md:scale-95"
                >
                    <div
                        v-if="product"
                        class="flex text-base text-left transform transition w-full md:inline-block md:max-w-2xl md:px-4 md:my-8 md:align-middle lg:max-w-4xl"
                    >
                        <div
                            class="w-full relative flex items-center bg-white px-4 pt-14 pb-8 overflow-hidden shadow-2xl sm:px-6 sm:pt-8 md:p-6 lg:p-8"
                        >
                            <button
                                type="button"
                                class="absolute top-4 right-4 text-gray-400 hover:text-gray-500 sm:top-8 sm:right-6 md:top-6 md:right-6 lg:top-8 lg:right-8"
                                @click="open = false"
                            >
                                <span class="sr-only">Close</span>
                                <XIcon class="h-6 w-6" aria-hidden="true" />
                            </button>

                            <div
                                class="w-full grid grid-cols-1 gap-y-8 gap-x-6 items-start sm:grid-cols-12 lg:gap-x-8"
                            >
                                <div
                                    class="aspect-w-2 aspect-h-3 rounded-lg bg-gray-100 overflow-hidden sm:col-span-4 lg:col-span-5"
                                >
                                    <img
                                        :src="product.image_src"
                                        class="object-center object-cover"
                                    />
                                </div>
                                <div class="sm:col-span-8 lg:col-span-7">
                                    <h2
                                        class="text-2xl font-extrabold text-gray-900 sm:pr-12"
                                    >{{ product.name }}</h2>

                                    <section aria-labelledby="information-heading" class="mt-2">
                                        <h3
                                            id="information-heading"
                                            class="sr-only"
                                        >Product information</h3>

                                        <p class="text-2xl text-gray-900">{{ product.price }}</p>

                                        <!-- Reviews -->
                                        <div class="mt-6">
                                            <h4 class="sr-only">Reviews</h4>
                                            <div class="flex items-center">
                                                <p class="sr-only">{{ product.description }}</p>
                                            </div>
                                            <p
                                                v-for="ingredient in product.product_ingredients"
                                                class="font-medium text-gray-700"
                                            >{{ ingredient.ingredient.name }} {{ ingredient.quantity * 1000 }} g</p>
                                        </div>
                                    </section>

                                    <section aria-labelledby="options-heading" class="mt-10">
                                        <h3 id="options-heading" class="sr-only">Product options</h3>

                                        <form onsubmit="return false" @submit="addItemToOrder()">
                                            <!-- Sizes -->
                                            <div class="mt-10">
                                                <div class>
                                                    <h4
                                                        class="text-sm text-gray-900 font-medium"
                                                    >Quantity</h4>
                                                    <input
                                                        :min="1"
                                                        name="quantity"
                                                        type="number"
                                                        v-model="quantity"
                                                        id="quantity"
                                                        autocomplete="csc"
                                                        class="block mt-3 w-1/4 px-6 py-2 border-gray-900 bg-gray-200 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                                    />
                                                </div>
                                            </div>

                                            <button
                                                type="submit"
                                                class="mt-6 w-full bg-indigo-600 border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                            >Add to bag</button>
                                        </form>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                </TransitionChild>
            </div>
        </Dialog>
    </TransitionRoot>
</template>

<script setup>
import { ref } from 'vue'
import {
    Dialog,
    DialogOverlay,
    TransitionChild,
    TransitionRoot,
} from '@headlessui/vue'
import { XIcon } from '@heroicons/vue/outline'

const props = defineProps({
    product: Object,
    open: Boolean,
});

const emit = defineEmits(['close', 'addToOrder']);
const quantity = ref(0);
const closeModal = () => {
    emit('close');
}

const addItemToOrder = () => {
    emit('addToOrder', { product: props.product, quantity: quantity.value });
    emit('close');

}

</script>