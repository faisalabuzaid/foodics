<template>
    <div>
        <h1>inertiajs is {{ about_us }}</h1>

        <Link href="/">Go to Home</Link>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/inertia-vue3";

const props = defineProps({ about_us: String });

</script>