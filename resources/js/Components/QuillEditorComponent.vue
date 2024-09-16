<template>
  <div class="quill-editor">
    <div v-if="message" class="mt-4 p-4" :class="messageClass">
      {{ message }}
    </div>
    <div class="my-10 mb-24">
      <h3 class="text-lg font-semibold mb-2">Rendered Content Preview:</h3>
      <div v-html="htmlContent" class="ql-editor border p-4 rounded"></div>
    </div>

    <QuillEditor
      v-model:content="htmlContent"
      :options="editorOptions"
      @update:content="onEditorChange"
      contentType="html"
    />
    <div class="mt-4 flex justify-between items-center">
      <PrimaryButton
        @click="saveContent"
        class="ms-4"
        :class="{ 'opacity-25': processing }"
        :disabled="processing"
      >
        Save content
      </PrimaryButton>
      <span v-if="isDirty" class="text-yellow-600">Unsaved changes</span>
    </div>
  </div>
</template>

<script>
import { QuillEditor } from "@vueup/vue-quill";
import "@vueup/vue-quill/dist/vue-quill.snow.css";
import { router } from "@inertiajs/vue3";
import { toast } from "vue3-toastify";
import PrimaryButton from "@/Components/PrimaryButton.vue";

export default {
  name: "QuillEditorComponent",
  components: {
    QuillEditor,
    PrimaryButton,
  },
  props: {
    initialHtmlContent: {
      type: String,
      default: "Start your editing here!",
    },
  },
  data() {
    return {
      htmlContent: this.initialHtmlContent,
      originalHtmlContent: this.initialHtmlContent,
      isDirty: false,
      message: "",
      messageClass: "",
      processing: false,
      editorOptions: {
        theme: "snow",
        modules: {
          toolbar: [
            ["bold", "italic", "underline", "strike"],
            ["blockquote", "code-block"],
            [{ header: 1 }, { header: 2 }],
            [{ list: "ordered" }, { list: "bullet" }],
            [{ script: "sub" }, { script: "super" }],
            [{ indent: "-1" }, { indent: "+1" }],
            [{ direction: "rtl" }],
            [{ size: ["small", false, "large", "huge"] }],
            [{ header: [1, 2, 3, 4, 5, 6, false] }],
            [{ color: [] }, { background: [] }],
            [{ font: [] }],
            [{ align: [] }],
            ["clean"],
          ],
        },
      },
    };
  },
  methods: {
    onEditorChange(content) {
      this.htmlContent = content;
      this.isDirty = this.htmlContent !== this.originalHtmlContent;
    },
    saveContent() {
      this.processing = true;
      router.post(
        "/save-content",
        { content: this.htmlContent },
        {
          preserveState: true,
          preserveScroll: true,
          onSuccess: () => {
            this.originalHtmlContent = this.htmlContent;
            this.isDirty = false;
            this.processing = false;
            toast.success("Content saved successfully");
          },
          onError: () => {
            this.processing = false;
            toast.error("Error saving content");
          },
        }
      );
    },
  },
};
</script>

<style>
.quill-editor {
  max-width: 800px;
  margin: 0 auto;
}

</style>