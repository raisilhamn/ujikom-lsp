<script setup>
import Checkbox from "@/Components/Checkbox.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import Layout from "@/Layouts/Layout.vue";

defineProps({
    canResetpass_admin: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    user_admin: "",
    pass_admin: "",
    remember: false,
});

// TODO: change this
const submit = () => {
    form.post(route("login.admin"), {
        onFinish: () => form.reset("pass_admin"),
    });
};
</script>

<template>
    <Layout>
        <GuestLayout>
            <Head title="Log in" />

            <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                {{ status }}
            </div>

            <form @submit.prevent="submit">
                <div>
                    <InputLabel for="user_admin" value="User Admin" />

                    <TextInput
                        id="user_admin"
                        class="mt-1 block w-full"
                        v-model="form.user_admin"
                        required
                        autofocus
                        autocomplete="username"
                    />

                    <InputError
                        class="mt-2"
                        :message="form.errors.user_admin"
                    />
                </div>

                <div class="mt-4">
                    <InputLabel for="pass_admin" value="Password Admin" />

                    <TextInput
                        id="pass_admin"
                        type="password"
                        class="mt-1 block w-full"
                        v-model="form.pass_admin"
                        required
                        autocomplete="current-pass_admin"
                    />

                    <InputError
                        class="mt-2"
                        :message="form.errors.pass_admin"
                    />
                </div>

                <!-- <div class="block mt-4">
                <label class="flex items-center">
                    <Checkbox name="remember" v-model:checked="form.remember" />
                    <span class="ms-2 text-sm text-gray-600">Remember me</span>
                </label>
            </div> -->

                <div class="flex items-center justify-end mt-4">
                    <!-- <Link
                    v-if="canResetpass_admin"
                    :href="route('pass_admin.request')"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    Forgot your pass_admin?
                </Link> -->

                    <PrimaryButton
                        class="ms-4"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Log in
                    </PrimaryButton>
                </div>
            </form>

            <Link :href="route('login')">
                <PrimaryButton
                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Login User
                </PrimaryButton></Link
            >
        </GuestLayout>
    </Layout>
</template>
