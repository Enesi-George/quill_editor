<script setup>
import { reactive, ref } from "vue";
import { router } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { toast } from "vue3-toastify";


const props = defineProps({
  content: String
});

const processing = ref(false);

const form = reactive({
  content: props.content || '', 
});

const submit = () => {
  processing.value = true;
  router.post('/save-content', form, {
    preserveState: true,
    preserveScroll: true,
    onFinish: () => {
      processing.value = false;
      toast.success("Content saved successfully");
    },
    onError: (errors) => {
      console.error(errors);
      processing.value = false;
      toast.error("Error saving content");
    },
  });
};
</script>

<template>
  <section class="space-y-32 px-16">
    <div class="mb-6 ">
    <h3 class="text-2xl font-bold">Rendered content</h3>
    <div class="w-full rounded-sm border">
      <!-- Render the saved HTML content -->
      <h3 v-html="form.content"></h3>
    </div>
  </div>

  <form @submit.prevent="submit" class="">
    <div class="border rounded-md shadow-sm bg-red-300">
      <div class="px-5">
        <label for="content" class="text-2xl font-bold">Html Content</label>
        <p class="text-gray-700 italic">Input your desired html content for rendering...</p>
      </div>
      <hr>
      <textarea id="content" class="w-full h-32 border-none focus:ring-0 focus:outline-none" v-model="form.content"></textarea>
    </div>

    <PrimaryButton
      class="my-5"
      :class="{ 'opacity-25': processing }"
      :disabled="processing">
      Save content
    </PrimaryButton>
  </form>
  </section>

</template>
