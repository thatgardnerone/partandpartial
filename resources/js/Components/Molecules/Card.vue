<script setup>
import { ArrowPathIcon } from "@heroicons/vue/24/outline/index.js";

defineProps({
    title: {
        type: String,
        required: true,
    },
    content: {
        type: Object,
        default: null,
    },
});
</script>

<template>
    <div
        class="flex aspect-square flex-1 flex-col justify-between bg-gray-100 p-4">
        <div class="flex-0 flex items-center justify-between">
            <h2 class="font-semibold uppercase text-gray-600">
                {{ title }}
            </h2>
            <div>
                <ArrowPathIcon class="mx-auto h-6 w-6 text-gray-400" />
            </div>
        </div>
        <div class="flex flex-1 flex-col items-center justify-center">
            <p
                :class="{
                    'animate-pulse text-gray-500': !content,
                }">
                {{ content ?? "loading" }}
            </p>
        </div>
    </div>
</template>

<style scoped></style>
