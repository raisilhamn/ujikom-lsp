<script setup>
import { Head, Link, router, usePage } from "@inertiajs/vue3";
import Layout from "@/Layouts/Layout.vue";
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";

const page = usePage();
const props = defineProps({
    peminjaman: {
        type: Object,
    },
    detail: {
        type: Object,
    },
});

const updateStatus = (item) => {
    router.patch("/update-status", {
        kode_pinjam: item.kode_pinjam,
        status_peminjaman: item.status_peminjaman,
    });
};
</script>

<template>
    <Head title="Welcome" />

    <Layout
        ><h1 class="font-black">Daftar Pesanan</h1>
        <!-- {{ peminjaman }}/ -->
        <div class="relative overflow-x-auto">
            <table
                class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
            >
                <thead
                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                >
                    <tr>
                        <th scope="col" class="px-6 py-3">Kode Pinjam</th>
                        <th scope="col" class="px-6 py-3">ID Peminjam</th>
                        <th scope="col" class="px-6 py-3">ID Admin</th>
                        <th scope="col" class="px-6 py-3">Tanggal Pesan</th>
                        <th scope="col" class="px-6 py-3">Tanggal Ambil</th>
                        <th scope="col" class="px-6 py-3">
                            Tanggal Wajib Kembali
                        </th>
                        <th scope="col" class="px-6 py-3">Tanggal Kembali</th>
                        <th scope="col" class="px-6 py-3">Status Peminjaman</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="item in peminjaman"
                        :key="item.kode_pinjam"
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                    >
                        <Link
                            class="w-10 items-center justify-center rounded-xl p-3 text-center align-middle text-sm"
                            :href="
                                route('admin.detail', {
                                    kode_pinjam: item.kode_pinjam,
                                })
                            "
                            ><td class="px-6 py-4 bg-blue-100 rounded-xl">
                                {{ item.kode_pinjam }}
                            </td>
                        </Link>

                        <td class="px-6 py-4">
                            {{ item.peminjam.nama_peminjam }}
                        </td>
                        <td v-if="item.admin" class="px-6 py-4">
                            {{ item.admin.nama_admin }}
                        </td>
                        <td v-else></td>
                        <td class="px-6 py-4">{{ item.tgl_pesan }}</td>
                        <td class="px-6 py-4">{{ item.tgl_ambil }}</td>
                        <td class="px-6 py-4">{{ item.tgl_wajibkembali }}</td>
                        <td class="px-6 py-4">{{ item.tgl_kembali }}</td>
                        <select
                            v-model="item.status_peminjaman"
                            @change="updateStatus(item)"
                        >
                            <option value="diproses">Diproses</option>
                            <option value="disetujui">Disetujui</option>
                            <option value="ditolak">Ditolak</option>
                            <option value="selesai">Selesai</option>
                        </select>
                    </tr>
                </tbody>
            </table>
        </div>
    </Layout>
</template>
