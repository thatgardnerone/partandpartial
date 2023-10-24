<script setup>
import { Head } from "@inertiajs/vue3";
import Card from "@/Components/Molecules/Card.vue";
import { ref } from "vue";

const props = defineProps({
    slowData: {
        type: Array,
        required: true,
    },
});

const item0 = ref(props.slowData?.[0]);
const item1 = ref(props.slowData?.[1]);
const item2 = ref(props.slowData?.[2]);
</script>

<template>
    <Head>
        <title>Heavy components</title>
    </Head>

    <main class="mx-auto flex max-w-4xl flex-col px-4 py-6">
        <h2 class="my-4 text-xl font-bold">Heavy components</h2>

        <div class="flex gap-x-5">
            <Card title="Card 1" :content="item0" />
            <Card title="Card 2" :content="item1" />
            <Card title="Card 3" :content="item2" />
        </div>
    </main>
</template>

<style scoped></style>
