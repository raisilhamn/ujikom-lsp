<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import Layout from "@/Layouts/Layout.vue";

const form = useForm({
    nama_peminjam: "",
    user_peminjam: "",
    password_peminjam: "",
    foto_peminjam: null, // Add this line
});

const submit = () => {
    console.log("submit");
    form.post(route("register.peminjam"), {
        onFinish: () => form.reset("pasword_peminjam", "foto_peminjam"),
    });
};
</script>

<template>
    <Layout>
        <GuestLayout>
            <Head title="Register Admin" />

            <p class="block text-center font-bold">register.user</p>
            <form @submit.prevent="submit">
                <div>
                    <InputLabel for="nama_peminjam" value="Nama Peminjam" />

                    <TextInput
                        id="nama_peminjam"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.nama_peminjam"
                        required
                        autofocus
                        autocomplete="nama_peminjam"
                    />

                    <InputError
                        class="mt-2"
                        :message="form.errors.nama_peminjam"
                    />
                </div>

                <div class="mt-4">
                    <InputLabel for="user_peminjam" value="User Peminjam" />

                    <TextInput
                        id="user_peminjam"
                        class="mt-1 block w-full"
                        v-model="form.user_peminjam"
                        required
                        autocomplete="username"
                    />

                    <InputError
                        class="mt-2"
                        :message="form.errors.user_peminjam"
                    />
                </div>

                <div class="mt-4">
                    <InputLabel for="password_peminjam" value="Password" />

                    <TextInput
                        id="password_peminjam"
                        type="password"
                        class="mt-1 block w-full"
                        v-model="form.password_peminjam"
                        required
                        autocomplete="new-password"
                    />

                    <InputError
                        class="mt-2"
                        :message="form.errors.password_peminjam"
                    />
                </div>
                <div class="mt-4">
                    <InputLabel for="file" value="File" />
                    <input
                        id="file"
                        type="file"
                        class="mt-1 block w-full"
                        @change="form.foto_peminjam = $event.target.files[0]"
                        required
                    />
                    <InputError class="mt-2" :message="form.errors.file" />
                </div>
                <progress
                    v-if="form.progress"
                    :value="form.progress.percentage"
                    max="100"
                >
                    {{ form.progress.percentage }}%
                </progress>
                <div class="flex items-center justify-end mt-4">
                    <Link
                        :href="route('login')"
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
            <Link :href="route('register.admin.index')">
                <PrimaryButton
                    class="mt-10"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Register Admin
                </PrimaryButton>
            </Link>
        </GuestLayout>
    </Layout>
</template>
