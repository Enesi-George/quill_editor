<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import QuillEditorComponent from '@/Components/QuillEditorComponent.vue';

const props = defineProps({
  initialContent: {
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
            <QuillEditorComponent :initial-html-content="initialContent" />
        </div>
    </AuthenticatedLayout>
</template>
