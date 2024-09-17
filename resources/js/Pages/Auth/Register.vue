<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import { EyeSlashIcon, EyeIcon } from "@heroicons/vue/24/outline";
import { toast } from "vue3-toastify";

const form = useForm({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
});

const passwordVisible = ref(false);

const submit = () => {
    form.post("/register", {
        onSuccess: () => {
            toast.success("Registered successfully!"),
                form.reset("password", "password_confirmation");
        },
        onError: () => {
            toast.error(
                "Registeration failed"
            );
        },
    });
};

const togglePasswordVisibility = () => {
    passwordVisible.value = !passwordVisible.value;
};
</script>

<template>
    <GuestLayout>
        <Head title="Register" />
        <div class="flex items-center justify-center  ">
                <h1 class="text-5xl font-extrabold shadow-md rounded-lg p-2 px-3 text-red-300">Q</h1>
        </div>
        <h1 class="text-center w-full my-2 font-bold">Register</h1>
        <div class="flex space-x-6 mb-8">
            <hr class="w-1/2" />
            <hr class="w-1/2" />
        </div>
        <form @submit.prevent="submit">
            <div>
                <InputLabel for="name" value="Name" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-4">
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
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
                        class="mt-1 block w-full pr-10"
                        v-model="form.password"
                        required
                        autocomplete="new-password"
                    />
                    <button
                        type="button"
                        class="absolute right-0 pr-3 flex items-center text-sm leading-5"
                        @click="togglePasswordVisibility"
                    >
                        <component
                            :is="passwordVisible ? EyeSlashIcon : EyeIcon"
                            class="h-5 w-5 text-gray-500"
                        />
                    </button>
                </div>

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel
                    for="password_confirmation"
                    value="Confirm Password"
                />

                <TextInput
                    id="password_confirmation"
                    :type="passwordVisible ? 'text' : 'password'"
                    class="mt-1 block w-full"
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password"
                />

                <InputError
                    class="mt-2"
                    :message="form.errors.password_confirmation"
                />
            </div>

            <div class="flex flex-col items-center mt-4">
                <div>
                    <PrimaryButton
                        class="ms-4"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Register
                    </PrimaryButton>
                </div>

                <Link
                    :href="route('login')"
                    class="underline ml-4 text-sm text-gray-600 mt-1 hover:text-gray-400"
                >
                    Already registered?
                </Link>
            </div>
        </form>
    </GuestLayout>
</template>
