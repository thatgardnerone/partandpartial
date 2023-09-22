<script setup></script>

<template>
    <div class="min-h-screen flex flex-col bg-gray-50">
        <header
            class="sticky top-0 flex-0 px-4 py-6 bg-gray-50 border-b border-gray-200">
            <h1 class="font-semibold text-2xl">Part and Partial</h1>
        </header>

        <div class="flex-1">
            <slot />
        </div>

        <footer
            class="sticky bottom-0 flex-0 px-4 py-6 bg-gray-50 border-t border-gray-200">
            <p class="text-gray-600">
                &copy; {{ new Date().getFullYear() }} TGO Solutions
            </p>
        </footer>
    </div>
</template>
