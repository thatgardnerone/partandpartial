<script setup></script>

<template>
    <div class="flex min-h-screen flex-col bg-gray-50">
        <header
            class="flex-0 sticky top-0 border-b border-gray-200 bg-gray-50 px-4 py-6">
            <h1 class="text-2xl font-semibold">Part and Partial</h1>
        </header>

        <div class="flex-1">
            <slot />
        </div>

        <footer
            class="flex-0 sticky bottom-0 border-t border-gray-200 bg-gray-50 px-4 py-6">
            <p class="text-gray-600">
                &copy; {{ new Date().getFullYear() }} Jamie Gardner
            </p>
        </footer>
    </div>
</template>
