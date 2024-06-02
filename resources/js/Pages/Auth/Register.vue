<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import Layout from "@/Layouts/Layout.vue";

const form = useForm({
    nama_admin: "",
    user_admin: "",
    pass_admin: "",
});

const submit = () => {
    form.post(route("register.admin"), {
        onFinish: () => form.reset("pass_admin"),
    });
};
</script>

<template>
    <Layout>
        <GuestLayout>
            <Head title="Register Admin" />

            <p class="block text-center font-bold">register.admin</p>
            <form @submit.prevent="submit">
                <div>
                    <InputLabel for="nama_admin" value="Nama Admin" />

                    <TextInput
                        id="nama_admin"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.nama_admin"
                        required
                        autofocus
                        autocomplete="nama_admin"
                    />

                    <InputError
                        class="mt-2"
                        :message="form.errors.nama_admin"
                    />
                </div>

                <div class="mt-4">
                    <InputLabel for="user_admin" value="User Admin" />

                    <TextInput
                        id="user_admin"
                        class="mt-1 block w-full"
                        v-model="form.user_admin"
                        required
                        autocomplete="username"
                    />

                    <InputError
                        class="mt-2"
                        :message="form.errors.user_admin"
                    />
                </div>

                <div class="mt-4">
                    <InputLabel for="pass_admin" value="Password" />

                    <TextInput
                        id="pass_admin"
                        type="password"
                        class="mt-1 block w-full"
                        v-model="form.pass_admin"
                        required
                        autocomplete="new-password"
                    />

                    <InputError
                        class="mt-2"
                        :message="form.errors.pass_admin"
                    />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <Link
                        :href="route('login-admin')"
                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        Sudah Punya akun ?
                    </Link>

                    <PrimaryButton
                        class="ms-4"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Register
                    </PrimaryButton>
                </div>
            </form>

            <Link
                :href="route('user.register')"
                class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            >
                Register User
            </Link>
        </GuestLayout>
    </Layout>
</template>
