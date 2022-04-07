<template>
    <TransitionRoot as="template" :show="open">
        <Dialog as="div" class="fixed z-10 inset-0 overflow-y-auto" @close="closeModal()">
            <div
                v-if="product"
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
                        class="flex text-base text-left transform transition w-full md:inline-block md:max-w-2xl md:px-4 md:my-8 md:align-middle lg:max-w-4xl"
                    >
                        <div
                            class="w-full relative flex items-center bg-white px-4 pt-14 pb-8 overflow-hidden shadow-2xl sm:px-6 sm:pt-8 md:p-6 lg:p-8"
                        >
                            <button
                                type="button"
                                class="absolute top-4 right-4 text-gray-400 hover:text-gray-500 sm:top-8 sm:right-6 md:top-6 md:right-6 lg:top-8 lg:right-8"
                                @click="closeModal()"
                            >
                                <span class="sr-only">Close</span>
                                <XIcon class="h-6 w-6" aria-hidden="true" />
                            </button>

                            <div
                                class="w-full grid grid-cols-1 gap-y-8 gap-x-6 items-start sm:grid-cols-12 lg:gap-x-8"
                            >
                                <div class="sm:col-span-4 lg:col-span-5">
                                    <div
                                        class="aspect-w-1 aspect-h-1 rounded-lg bg-gray-100 overflow-hidden"
                                    >
                                        <img
                                            :src="product.image_src"
                                            class="object-center object-cover"
                                        />
                                    </div>
                                    <p class="absolute top-4 left-4 text-center sm:static sm:mt-6">
                                        <a
                                            :href="product.href"
                                            class="font-medium text-indigo-600 hover:text-indigo-500"
                                        >View full details</a>
                                    </p>
                                </div>
                                <div class="sm:col-span-8 lg:col-span-7">
                                    <h2
                                        class="text-2xl font-extrabold text-gray-900 sm:pr-12"
                                    >{{ product.name }}</h2>

                                    <section aria-labelledby="information-heading" class="mt-4">
                                        <h3
                                            id="information-heading"
                                            class="sr-only"
                                        >Product information</h3>

                                        <div class="flex items-center">
                                            <p
                                                class="text-lg text-gray-900 sm:text-xl"
                                            >{{ product.price }}</p>
                                        </div>

                                        <div class="mt-6 flex items-center">
                                            <p
                                                class="ml-2 font-medium text-gray-500"
                                            >{{ product.description }}</p>
                                        </div>
                                    </section>

                                    <section aria-labelledby="options-heading" class="mt-6">
                                        <div>
                                            <label
                                                for="quantity-number"
                                                class="block text-sm font-medium text-gray-700"
                                            >Quantity</label>
                                            <div class="mt-1 relative rounded-md shadow-sm">
                                                <input
                                                    type="number"
                                                    v-model="quantity"
                                                    class="block w-full border-2 border-black-300 placeholder-gray-300"
                                                    name="quantity"
                                                    placeholder="Enter Quantity"
                                                    :autofocus="true"
                                                    :required="true"
                                                />
                                            </div>
                                        </div>
                                        <div class="mt-6">
                                            <button
                                                @click="addItemToOrder()"
                                                type="submit"
                                                class="w-full bg-indigo-600 border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-50 focus:ring-indigo-500"
                                            >Add to order</button>
                                        </div>
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
    RadioGroup,
    RadioGroupDescription,
    RadioGroupLabel,
    RadioGroupOption,
    TransitionChild,
    TransitionRoot,
} from '@headlessui/vue'
import { ShieldCheckIcon, XIcon } from '@heroicons/vue/outline'
import { CheckIcon, QuestionMarkCircleIcon, StarIcon } from '@heroicons/vue/solid'

const props = defineProps({
    product: Object,
    open: Boolean,
});

const emit = defineEmits(['close']);
const quantity = ref(0);
const closeModal = () => {
    emit('close');
}

const addItemToOrder = () => {
    console.log(props.product.id);
    console.log(quantity.value);
    emit('close', [props.product.id, quantity.value]);
}

</script>