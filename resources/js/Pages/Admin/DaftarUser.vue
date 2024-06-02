<script setup>
import { Head, Link, router, usePage, useForm } from "@inertiajs/vue3";
import Layout from "@/Layouts/Layout.vue";

const props = defineProps({
    peminjam: {
        type: Object,
    },
});
// const form = useForm({
//     status_peminjaman: "",
// });
const updateStatus = (item) => {
    console.log(item.status_peminjam);
    router.visit("/update-user", {
        method: "patch",
        data: {
            id_peminjam: item.id_peminjam,
            status_peminjam: item.status_peminjam,
        },
        onSuccess: () => {
            alert("Status Peminjam Berhasil Diubah");
        },
    });
};
</script>

<template>
    <Head title="Welcome" />

    <Layout
        ><h1 class="font-black">Daftar User</h1>
        <!-- {{ peminjaman }}/ -->
        <!-- {{ peminjam }} -->
        <div class="relative overflow-x-auto">
            <table
                class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
            >
                <thead
                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                >
                    <tr>
                        <th scope="col" class="px-6 py-3">Foto</th>
                        <th scope="col" class="px-6 py-3">Id peminjam</th>
                        <th scope="col" class="px-6 py-3">Nama Peminjam</th>
                        <th scope="col" class="px-6 py-3">Status Peminjam</th>
                        <!-- <th scope="col" class="px-6 py-3">Tanggal Pesan</th>
                        <th scope="col" class="px-6 py-3">Tanggal Ambil</th>
                        <th scope="col" class="px-6 py-3">
                            Tanggal Wajib Kembali
                        </th>
                        <th scope="col" class="px-6 py-3">Tanggal Kembali</th>
                        <th scope="col" class="px-6 py-3">Status Peminjaman</th> -->
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="item in peminjam"
                        :key="item.id_peminjam"
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                    >
                        <!-- <Link
                            class="w-10 items-center justify-center rounded-xl p-3 text-center align-middle text-sm"
                            :href="
                                route('admin.detail', {
                                    kode_pinjam: item.kode_pinjam,
                                })
                            "
                            ><td class="px-6 py-4 bg-blue-100 rounded-xl">
                                {{ item.kode_pinjam }}
                            </td>
                        </Link> -->
                        <!-- {{
                            item.foto_peminjam
                        }} -->
                        <td>
                            <img
                                v-if="item.foto_peminjam"
                                :src="item.foto_peminjam"
                                class="ml-3 h-12 w-12 rounded-xl"
                                alt="Foto User"
                            />
                            <img
                                v-else
                                src="https://picsum.photos/100"
                                class="ml-3 h-12 w-12 rounded-xl"
                                alt=""
                            />
                        </td>
                        <td class="px-6 py-4">
                            {{ item.id_peminjam }}
                        </td>

                        <td class="px-6 py-4">{{ item.nama_peminjam }}</td>
                        <!-- <td class="px-6 py-4">{{ item.tgl_ambil }}</td> -->
                        <!-- <td class="px-6 py-4">{{ item.tgl_wajibkembali }}</td>
                        <td class="px-6 py-4">{{ item.tgl_kembali }}</td> -->
                        <!-- {{
                            item.status_peminjam
                        }} -->
                        <select
                            v-model="item.status_peminjam"
                            @change="updateStatus(item)"
                        >
                            <option value="0">Non Aktif</option>
                            <option value="1">Aktif</option>
                        </select>
                    </tr>
                </tbody>
            </table>
        </div>
    </Layout>
</template>
