<template>
    <div>
        <h1>Inertiajs is {{ test }}</h1>

        <Link href="/about-us">Go to about us</Link>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/inertia-vue3";

const props = defineProps(["test"]);

</script>