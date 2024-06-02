<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { Head, Link, router, usePage } from "@inertiajs/vue3";
</script>

<template>
    <nav class="navbar navbar-light bg-light">
        <div class="container container-fluid">
            <Link :href="route('index')">
                <span class="navbar-brand mb-0 h1">Perpustakaan Arcadia</span>
            </Link>
            <div>
                <input
                    class="rounded-2xl form-control me-2"
                    type="search"
                    placeholder="Search"
                    aria-label="Search"
                />
            </div>
            <div v-if="$page.props.auth.peminjam">
                <div class="flex flex-row space-x-3 items-center">
                    <p>{{ $page.props.auth.peminjam.nama_peminjam }} (User)</p>
                    <Link as="button" method="post" :href="route('logout')">
                        <PrimaryButton class="bg-red-600 hover:bg-red-700"
                            >Logout
                        </PrimaryButton>
                    </Link>
                    <Link :href="route('customer.form.peminjaman')">
                        <PrimaryButton>Form Peminjaman</PrimaryButton>
                    </Link>
                    <Link :href="route('customer.daftar.peminjaman')">
                        <PrimaryButton>Daftar Peminjaman</PrimaryButton>
                    </Link>
                </div>
            </div>
            <div v-else-if="$page.props.auth.admin">
                <div class="flex flex-row space-x-3 items-center">
                    <p>{{ $page.props.auth.admin.nama_admin }} (Admin)</p>
                    <Link :href="route('admin.daftar.peminjam')">
                        <PrimaryButton>List User</PrimaryButton>
                    </Link>
                    <Link :href="route('admin.pemesanan')">
                        <PrimaryButton>List Peminjamanan</PrimaryButton>
                    </Link>
                    <Link as="button" method="post" :href="route('logout')">
                        <PrimaryButton class="bg-red-600 hover:bg-red-700"
                            >Logout
                        </PrimaryButton>
                    </Link>
                </div>
            </div>
            <div v-else>
                <Link :href="route('login')">
                    <span class="font-bold mr-2">login</span>
                </Link>
                <Link :href="route('user.register')">
                    <span class="font-bold">register</span>
                </Link>
            </div>
        </div>
    </nav>
    <div class="container mt-10">
        <slot></slot>
    </div>
</template>
