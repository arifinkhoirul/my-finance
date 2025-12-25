<script setup>
import { ArrowLeft, TrendingUp, Edit2, Trash2 } from 'lucide-vue-next'
import { defineProps, ref, onMounted } from 'vue';
import MainTotalDetail from '@/Components/MainTotalDetail.vue';
import RiwayatTransaksiDetail from '@/Components/RiwayatTransaksiDetail.vue';
import { Link } from '@inertiajs/vue3';




const { allPengeluaran, jumlahPengeluaran } = defineProps({
    allPengeluaran: Array,
    jumlahPengeluaran: String
})



const moveLoadingPage = ref(false)

function loadingPage() {
    moveLoadingPage.value = true
}




const loading = ref(true)

onMounted(() => {
    setTimeout(() => {
        loading.value = false
    }, 2000);
})

</script>

<template>
    <!-- pokemon loading -->
    <transition name="fade">
        <div v-if="moveLoadingPage"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/30 backdrop-blur-sm">
            <div class="loader"></div>
        </div>
    </transition>

    <div class="min-h-screen bg-[#F7F6FF] p-4">
        <!-- HEADER -->
        <div class="flex items-center gap-3 mb-6">
            <Link @click="loadingPage()" :href="route('financial.dashboard')">
                <button class="p-2 rounded-full bg-white shadow">
                    <ArrowLeft class="w-5 h-5" />
                </button>
            </Link>
            <h1 class="text-xl font-bold">Investasi</h1>
        </div>

        <!-- TOTAL INVESTASI CARD -->
        <MainTotalDetail :total="jumlahPengeluaran" :wallet="'pengeluaran'" />

        <!-- skelteon loading -->
        <div v-if="loading"
            class="animate-pulse relative overflow-hidden rounded-xl w-[150px] h-[2px] mb-3 bg-slate-500/80 p-4">
        </div>
        <!-- RIWAYAT -->
        <h2 v-else class="font-semibold text-lg mb-3">
            Riwayat Transaksi
        </h2>

        <!-- LIST -->
        <div class="space-y-4">
            <!-- <div v-for="irul in allInvestasi" :key="irul.id">
                <p>{{ irul.wallet.name }}</p>
            </div> -->
            <RiwayatTransaksiDetail v-for="pengeluaran in allPengeluaran" :key="pengeluaran.id"
                :wallet="pengeluaran.wallet.name" :description="pengeluaran.description" :amount="pengeluaran.amount"
                :date="pengeluaran.date" />
        </div>

    </div>
</template>



<style scoped>
/* HTML: <div class="loader"></div> */
.loader {
    height: 60px;
    aspect-ratio: 1;
    position: relative;
}

.loader::before,
.loader::after {
    content: "";
    position: absolute;
    inset: 0;
    border-radius: 50%;
    transform-origin: bottom;
}

.loader::after {
    background:
        radial-gradient(at 75% 15%, #fffb, #0000 35%),
        radial-gradient(at 80% 40%, #0000, #0008),
        radial-gradient(circle 5px, #fff 94%, #0000),
        radial-gradient(circle 10px, #000 94%, #0000),
        linear-gradient(#F93318 0 0) top /100% calc(50% - 5px),
        linear-gradient(#fff 0 0) bottom/100% calc(50% - 5px) #000;
    background-repeat: no-repeat;
    animation: l20 1s infinite cubic-bezier(0.5, 120, 0.5, -120);
}

.loader::before {
    background: #ddd;
    filter: blur(8px);
    transform: scaleY(0.4) translate(-13px, 0px);
}

@keyframes l20 {

    30%,
    70% {
        transform: rotate(0deg)
    }

    49.99% {
        transform: rotate(0.2deg)
    }

    50% {
        transform: rotate(-0.2deg)
    }
}
</style>
