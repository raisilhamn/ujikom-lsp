<script setup>
import { Head, Link, router, usePage } from "@inertiajs/vue3";
import Layout from "@/Layouts/Layout.vue";
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";

const page = usePage();
const props = defineProps({
    detail: {
        type: Object,
    },
});

const deleteDetail = (item) => {
    // console.log(item.id_detail);

    router.delete(route("admin.delete", item.id_detail), {
        preserveScroll: true,
    });
};
</script>

<template>
    <Head title="Welcome" />

    <Layout>
        <!-- <h1 class="font-black">Daftar Pesanan</h1> -->
        <!-- {{ detail }} -->
        <!-- {{ peminjaman }}/ -->
        <div class="relative overflow-x-auto">
            <h1 class="font-black mt-10">Detail Pesanan</h1>

            <table
                class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
            >
                <thead
                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                >
                    <tr>
                        <!-- <th scope="col" class="px-6 py-3">ID Detail</th> -->
                        <th scope="col" class="px-6 py-3">ID Buku</th>
                        <th scope="col" class="px-6 py-3">Aksi</th>
                        <!-- <th scope="col" class="px-6 py-3">Created At</th>
                        <th scope="col" class="px-6 py-3">Updated At</th> -->
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="item in detail"
                        :key="item.id_detail"
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                    >
                        <!-- <td class="px-6 py-4">{{ item.id_detail }}</td> -->
                        <td class="px-6 py-4">{{ item.buku.judul_buku }}</td>
                        <td class="px-6 py-4">
                            <button
                                @click="deleteDetail(item)"
                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                            >
                                Hapus
                            </button>
                        </td>
                        <!-- <td class="px-6 py-4">{{ item.kode_pinjam }}</td> -->
                        <!-- <td class="px-6 py-4">{{ item.created_at }}</td>
                        <td class="px-6 py-4">{{ item.updated_at }}</td> -->
                    </tr>
                </tbody>
            </table>
        </div>
    </Layout>
</template>
