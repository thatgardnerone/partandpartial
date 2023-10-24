<script setup>
import { Head, router, useForm } from "@inertiajs/vue3";
import {
    Dialog,
    DialogPanel,
    DialogTitle,
    TransitionChild,
    TransitionRoot,
} from "@headlessui/vue";
import { onMounted, ref } from "vue";

const props = defineProps({
    post: Object,
});

const isOpen = ref(false);

const openModal = () => {
    isOpen.value = true;
};

const closeModal = () => {
    isOpen.value = false;
};

const form = useForm({
    title: null,
    body: null,
});

const updatePost = () => {
    form.title ??= props.post.title;
    form.body ??= props.post.body;

    form.post(route("modal-form.update", { post: props.post.id }), {
        preserveState: true,
        onSuccess: () => {
            closeModal();
        },
    });
};

onMounted(() => {
    router.reload({
        only: ['post']
    })
})
</script>

<template>
    <Head title="Modal form" />

    <section class="mx-auto flex max-w-4xl flex-col gap-y-1 pt-6">
        <div class="space-y-2" v-if="post">
            <h1 class="text-2xl font-bold text-gray-900">Sample Post</h1>
            <!-- TODO: Lazy-loaded data goes here -->
            <p>
                Title:
                <span class="block bg-gray-100 px-0.5 pb-0.5 font-mono">
                    {{ post?.title }}
                </span>
            </p>
            <p>
                Body:
                <span class="block bg-gray-100 px-0.5 pb-0.5 font-mono">
                    {{ post?.body }}
                </span>
            </p>
            <p>
                Last updated:
                <span class="block bg-gray-100 px-0.5 pb-0.5 font-mono">
                    {{ post?.updated_at }}
                </span>
            </p>

            <button
                class="rounded bg-blue-200 px-4 py-2 text-sm font-semibold text-blue-900 transition duration-100 hover:bg-blue-300 focus:outline-none focus-visible:ring focus-visible:ring-blue-200 focus-visible:ring-opacity-50 active:bg-blue-400"
                type="button"
                @click="openModal">
                Open modal
            </button>
        </div>

        <div class="mt-2" v-else>
            <h1 class="text-2xl font-bold text-gray-900 animate-pulse">Lazy-loading post, please wait...</h1>
        </div>
    </section>

    <TransitionRoot :show="isOpen" appear as="template">
        <Dialog as="div" class="relative z-10" @close="closeModal">
            <TransitionChild
                as="template"
                enter="duration-300 ease-out"
                enter-from="opacity-0"
                enter-to="opacity-100"
                leave="duration-200 ease-in"
                leave-from="opacity-100"
                leave-to="opacity-0">
                <div class="fixed inset-0 bg-black bg-opacity-25" />
            </TransitionChild>

            <div class="fixed inset-0 overflow-y-auto">
                <div
                    class="flex min-h-full items-center justify-center p-4 text-center">
                    <TransitionChild
                        as="template"
                        enter="duration-300 ease-out"
                        enter-from="opacity-0 scale-95"
                        enter-to="opacity-100 scale-100"
                        leave="duration-200 ease-in"
                        leave-from="opacity-100 scale-100"
                        leave-to="opacity-0 scale-95">
                        <DialogPanel
                            class="w-full max-w-md transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all">
                            <DialogTitle
                                as="h3"
                                class="text-lg font-medium leading-6 text-gray-900">
                                Update post
                            </DialogTitle>

                            <form @submit.prevent.passive="updatePost">
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">
                                        Enter some new details for the post, to
                                        be updated via an XHR request.
                                    </p>

                                    <label for="title">
                                        <span class="sr-only">Title</span>
                                        <input
                                            id="title"
                                            v-model="form.title"
                                            :placeholder="post.title"
                                            class="mt-2 block w-full rounded-md border-gray-300 text-sm placeholder-gray-400 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                            type="text" />
                                    </label>

                                    <label for="body">
                                        <span class="sr-only">Body</span>
                                        <textarea
                                            id="body"
                                            v-model="form.body"
                                            :placeholder="post.body"
                                            class="mt-2 block w-full rounded-md border-gray-300 text-sm placeholder-gray-400 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                            rows="4" />
                                    </label>
                                </div>

                                <div class="mt-4">
                                    <button
                                        :disabled="form.processing"
                                        class="rounded bg-blue-200 px-4 py-2 text-sm font-semibold text-blue-900 transition duration-100 hover:bg-blue-300 focus:outline-none focus-visible:ring focus-visible:ring-blue-200 focus-visible:ring-opacity-50 active:bg-blue-400"
                                        type="submit"
                                        @click="closeModal">
                                        Submit
                                    </button>
                                </div>
                            </form>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>

<style scoped></style>
