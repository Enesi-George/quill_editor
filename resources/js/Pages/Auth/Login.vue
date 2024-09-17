<script setup>
import { ref } from "vue";
import Checkbox from "@/Components/Checkbox.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { EyeIcon, EyeSlashIcon } from "@heroicons/vue/24/outline";
import { toast } from "vue3-toastify";

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const passwordVisible = ref(false);

const togglePasswordVisibility = () => {
    passwordVisible.value = !passwordVisible.value;
};

const submit = () => {
    form.post(route("login"), {
        onSuccess: () => {
            toast.success("login successful"), form.reset("password");
        },
        onError: () => {
            toast.error("Login failed");
        },
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Log in" />
        <div class="flex items-center justify-center">
            <h1
                class="text-5xl font-extrabold shadow-md rounded-lg p-2 px-3 text-red-300"
            >
                Q
            </h1>
        </div>
        <h1 class="text-center w-full my-2 font-bold">Login</h1>
        <div class="flex space-x-6 mb-8">
            <hr class="w-1/2" />
            <hr class="w-1/2" />
        </div>
        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autofocus
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />

                <div class="relative flex items-center">
                    <TextInput
                        id="password"
                        :type="passwordVisible ? 'text' : 'password'"
                        class="mt-1 block w-full"
                        v-model="form.password"
                        required
                        autocomplete="current-password"
                    />
                    <button
                        type="button"
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5"
                        @click="togglePasswordVisibility"
                    >
                        <component
                            :is="passwordVisible ? EyeSlashIcon : EyeIcon"
                            class="h-5 w-5 text-gray-500"
                        />
                    </button>

                    <InputError class="mt-2" :message="form.errors.password" />
                </div>
            </div>
            <div class="block mt-4">
                <label class="flex items-center">
                    <Checkbox name="remember" v-model:checked="form.remember" />
                    <span class="ms-2 text-sm text-gray-600">Remember me</span>
                </label>
            </div>

            <div class="flex flex-col items-center mt-4">
                <PrimaryButton
                    class="ms-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Log in
                </PrimaryButton>

                <Link
                    v-if="canResetPassword"
                    :href="route('password.request')"
                    class="underline text-center ml-4 text-sm mt-1 text-gray-600 hover:text-gray-400"
                >
                    Forgot your password?
                </Link>
            </div>
        </form>
    </GuestLayout>
</template>
