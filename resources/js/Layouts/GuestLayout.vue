<script setup>
import { ref, onMounted } from 'vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import { usePage } from '@inertiajs/vue3';
import { ArrowLeftIcon } from '@heroicons/vue/24/outline'

const welcomeMessage = ref('')
const fullMessage = 'Welcome to Quill Application Website'
const { url } = usePage()

const typeMessage = () => {
  let index = 0
  const typingInterval = setInterval(() => {
    if (index < fullMessage.length) {
      welcomeMessage.value += fullMessage[index]
      index++
    } else {
      clearInterval(typingInterval)
    }
  }, 100) 
}

const goBack = () => {
  window.history.back()
}

onMounted(() => {
  typeMessage()
})
</script>

<template>
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div>
        </div>
      <div class="hidden md:flex min-h-screen w-1/2 bg-red-200 items-center justify-center p-8">
        <div class="text-center">
          <h2 class="text-2xl font-bold sm:text-3xl">{{ welcomeMessage }}</h2>
          <p class="mt-4">Where you get to edit HTML content.</p>
        </div>
      </div>
      
      <div class="relative w-full min-h-screen md:w-1/2 px-12 py-8 bg-white flex justify-center items-center">
        <div class="w-full max-w-sm">
          <PrimaryButton 
          v-if="url === '/login'" 
          @click="goBack" 
          class="absolute top-5 left-6 py-auto"
        >
          <ArrowLeftIcon class="w-5 h-5 inline-block mr-2"/> Back
        </PrimaryButton>

          <slot />
        </div>
      </div>
    </div>
</template>

<style scoped>
/* Add typing animation */
@keyframes typing {
  from { width: 0; }
  to { width: 100%; }
}

h2 {
  white-space: nowrap;
  overflow: hidden;
  border-right: 4px solid;
  width: fit-content;
  animation: typing 4s steps(30, end), blink-caret 0.75s step-end infinite;
}

/* Blinking cursor animation */
@keyframes blink-caret {
  from, to { border-color: transparent; }
  50% { border-color: black; }
}
</style>
