<script setup>
import { Head, Link } from "@inertiajs/vue3";
import Layout from "@/Layouts/Layout.vue";

const props = defineProps({
    buku: {
        type: Object,
    },
});
</script>

<template>
    <Head title="Welcome" />

    <Layout
        ><h1 class="font-black">Buku Terbaru</h1>
        <div class="flex flex-row mt-2">
            <div
                v-for="book in buku"
                :key="book.id_buku"
                class="rounded overflow-hidden shadow-lg p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 mr-5"
            >
                <div class="font-bold text-xl mb-2">{{ book.judul_buku }}</div>
                <p class="text-gray-700 text-base">
                    Pengarang: {{ book.nama_pengarang }}<br />
                    Penerbit: {{ book.nama_penerbit }}<br />
                    Tanggal Terbit: {{ book.tgl_terbit }}
                </p>
                <button
                    class="w-1/3 mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                >
                    +
                </button>
            </div>
        </div></Layout
    >
</template>
