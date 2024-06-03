<script setup>
import { Head, Link, router, usePage, useForm } from "@inertiajs/vue3";
import Layout from "@/Layouts/Layout.vue";
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";

const page = usePage();
const props = defineProps({
    detail: {
        type: Object,
    },
    peminjaman: {
        type: Object,
    },
});

const form = useForm({
    tgl_wajibkembali: "",
    kode_pinjam: props.peminjaman.kode_pinjam,
});

const deleteDetail = (item) => {
    router.delete(route("admin.delete", item.id_detail), {
        preserveScroll: true,
    });
};

function submit() {
    form.patch(route("admin.terima.peminjaman"), {
        onSuccess: () => {
            alert("Berhasil Menerima Peminjaman");
        },
    });
}

const kembalikan = (item) => {
    router.visit("/update-status-pengembalian", {
        method: "patch",
        data: {
            kode_pinjam: item.kode_pinjam,
        },
        onSuccess: () => {
            alert("Berhasil mengembalikan buku");
        },
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
            <div class="mb-10">
                <!-- badge status peminjaman -->
                <div
                    v-if="peminjaman.status_peminjaman == 'diproses'"
                    class="bg-yellow-200 text-yellow-800 px-2 py-1 rounded"
                >
                    Diproses
                </div>
                <div
                    v-else-if="peminjaman.status_peminjaman == 'disetujui'"
                    class="bg-green-200 text-green-800 px-2 py-1 rounded"
                >
                    Disetujui
                </div>
                <div
                    v-else-if="peminjaman.status_peminjaman == 'selesai'"
                    class="bg-blue-200 text-blue-800 px-2 py-1 rounded"
                >
                    Selesai
                </div>
                <!-- disetujui  -->
                <div
                    v-else-if="peminjaman.status_peminjaman == 'ditolak'"
                    class="bg-red-200 text-red-800 px-2 py-1 rounded"
                >
                    ditolak
                </div>
            </div>
            <!-- {{ peminjaman.status_peminjaman }} -->
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
            <!-- {{ peminjaman }} -->
            <div
                class="mb-10 w-full flex justify-center"
                v-if="peminjaman.status_peminjaman == 'diproses'"
            >
                <form @submit.prevent="submit" class="mt-10">
                    <div class="flex flex-col max-w-fit">
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
                        Terima Peminjaman
                    </button>
                </form>
            </div>
        </div>
        <div class="block">
            <div
                class="w-full flex justify-center mt-10"
                v-if="peminjaman.status_peminjaman == 'disetujui'"
            >
                <PrimaryButton
                    @click="kembalikan(peminjaman)"
                    class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
                >
                    Validasi Kembalikan Buku
                </PrimaryButton>
            </div>
        </div>
    </Layout>
</template>
