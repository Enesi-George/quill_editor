<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import QuillEditorComponent from '@/Components/QuillEditorComponent.vue';

const props = defineProps({
  content: {
    type: String,
    default: '<p>Start editing here!</p>'
  }
});
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <!-- Passing content to the QuillEditorComponent -->
            <QuillEditorComponent :content="content"/>
        </div>
    </AuthenticatedLayout>
</template>
