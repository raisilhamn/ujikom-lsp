<script setup>
import { Head, Link, router, useForm } from "@inertiajs/vue3";
import { ref, watch } from "vue";

import Layout from "@/Layouts/Layout.vue";

const props = defineProps({
    buku: {
        type: Object,
    },
});

const form = useForm({
    tgl_pesan: "",
    tgl_wajibkembali: "",
    buku: props.buku,
});

const deleteDetail = (item) => {
    console.log(item.id_buku);
    // router.patch("/deletecart", {});

    router.visit("/deletecart", {
        method: "patch",
        data: {
            id: item.id_buku,
        },
        onSuccess: () => {
            alert("Berhasil dihapus");
        },
    });
};

function submit() {
    form.post(route("customer.peminjaman"), {
        onSuccess: () => {
            alert("Berhasil meminjam");
        },
    });
}
</script>
<template>
    <Head title="Welcome" />

    <Layout>
        <h1 class="font-black">Buku Terbaru</h1>
        <div class="relative overflow-x-auto">
            <h1 class="font-black mt-10 mb-2">Detail Pesanan</h1>
            <!-- {{ buku }} -->
            <div class="mb-10">
                <form @submit.prevent="submit">
                    <div class="flex flex-col mb-2">
                        <label for="tanggal_pinjam">Tanggal Pinjam:</label>
                        <input
                            type="date"
                            required
                            id="tanggal_pinjam"
                            v-model="form.tgl_pesan"
                        />
                    </div>
                    <div class="flex flex-col">
                        <label for="tgl_wajibkembali"
                            >Tanggal Wajib Kembali:</label
                        >
                        <input
                            required
                            type="date"
                            id="tgl_wajibkembali"
                            v-model="form.tgl_wajibkembali"
                        />
                    </div>
                    <button
                        type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-2"
                    >
                        Pinjam
                    </button>
                </form>
            </div>
            <table
                class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
            >
                <thead
                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                >
                    <tr>
                        <!-- <th scope="col" class="px-6 py-3">ID Detail</th> -->
                        <th scope="col" class="px-6 py-3">Judul Buku</th>
                        <th scope="col" class="px-6 py-3">Nama Pengarang</th>
                        <th scope="col" class="px-6 py-3">Nama Penerbit</th>

                        <th scope="col" class="px-6 py-3">Aksi</th>

                        <!-- <th scope="col" class="px-6 py-3">Created At</th>
                        <th scope="col" class="px-6 py-3">Updated At</th> -->
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="item in buku"
                        :key="item.id_buku"
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                    >
                        <!-- <td class="px-6 py-4">{{ item.id_detail }}</td> -->
                        <td class="px-6 py-4">{{ item.judul_buku }}</td>
                        <td class="px-6 py-4">{{ item.nama_pengarang }}</td>
                        <td class="px-6 py-4">{{ item.nama_penerbit }}</td>

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
