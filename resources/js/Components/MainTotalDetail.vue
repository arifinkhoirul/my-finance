<script setup>
import { RedoDot, TrendingDown, TrendingUp } from 'lucide-vue-next'
import { defineProps, ref, onMounted } from 'vue';


const { total, wallet } = defineProps({
    total: String,
    wallet: String
})

const totalWallet = Math.abs(total).toLocaleString('id-ID')


const loading = ref(true)

onMounted(() => {
    setTimeout(() => {
        loading.value = false
    }, 2000);
})
</script>


<template>
    <!-- skeleyon loading -->
    <div v-if="loading"
        class="animate-pulse relative overflow-hidden rounded-2xl w-full h-[130px] mb-3 bg-slate-500/80 p-10">
    </div>
    <!-- TOTAL INVESTASI CARD -->
    <div v-else class=" rounded-2xl p-5 flex justify-between items-center mb-6"
        :class="wallet == 'investasi' ? 'bg-[#EDEBFF]' : wallet == 'pemasukan' ? 'bg-green-200/40' : wallet == 'pengeluaran' ? 'bg-red-200/40' : 'bg-yellow-200/40'">
        <div>
            <div v-if="wallet == 'investasi'">
                <p class="text-gray-600 text-sm">Total Investasi</p>
            </div>
            <div v-else-if="wallet == 'pemasukan'">
                <p class="text-gray-600 text-sm">Total Pemasukan</p>
            </div>
            <div v-else-if="wallet == 'pengeluaran'">
                <p class="text-gray-600 text-sm">Total Pengeluaran</p>
            </div>
            <div v-else>
                <p class="text-gray-600 text-sm">Total Self Reward</p>
            </div>

            <h2 class="text-3xl font-bold mt-1"
                :class="wallet == 'investasi' ? 'text-[#5F42F0]' : wallet == 'pemasukan' ? 'text-green-700' : wallet == 'pengeluaran' ? 'text-red-600' : 'text-yellow-600'">
                Rp {{ totalWallet }}
            </h2>
            <p class="text-sm text-gray-500 mt-1">
                <!-- {{ totalWallet == 0 ? 'Kamu belum berinvestasi' : totalWallet >= 0 ? 'Bagus kamu sudah mulai'
                    : totalWallet >= 1000000 ? 'Kamu sudah mulai berani investasi' : 'Bagus kamu mulai berani dan paham
                investasi' }} -->
            </p>
            <div v-if="wallet == 'investasi'">
                <p class="text-sm text-gray-500 mt-1">
                    {{ totalWallet == 0 ? 'Kamu belum berinvestasi' : totalWallet >= 0 ? 'Bagus kamu sudah mulai' :
                        totalWallet >= 500.000 ? 'Kamu sudah mulai berani investasi' : 'Bagus kamu mulai berani dan paham'
                    }}
                </p>
            </div>
            <div v-else-if="wallet == 'pemasukan'">
                <p class="text-sm text-gray-500 mt-1">pemasukan</p>
            </div>
            <div v-else-if="wallet == 'pengeluaran'">
                <p class="text-sm text-gray-500 mt-1">pengeluaran</p>
            </div>
            <div v-else>
                <p class="text-sm text-gray-500 mt-1">self reward</p>
            </div>
        </div>

        <div class="relative">
            <div class=" w-14 h-14 rounded-xl flex items-center justify-center"
                :class="wallet == 'investasi' ? 'bg-[#5F42F0]' : wallet == 'pemasukan' ? 'bg-green-700' : wallet == 'pengeluaran' ? 'bg-red-600' : 'bg-yellow-500'">
                <component class="text-white w-7 h-7"
                    :is="wallet == 'investasi' ? TrendingUp : wallet == 'pemasukan' ? TrendingUp : wallet == 'pengeluaran' ? TrendingDown : RedoDot" />
            </div>
            <div class="absolute -right-4 -bottom-4 w-16 h-16 rounded-full"
                :class="wallet == 'investasi' ? 'bg-[#5F42F0]/20' : wallet == 'pemasukan' ? 'bg-green-700/20' : wallet == 'pengeluaran' ? 'bg-red-600/20' : 'bg-yellow-400/20'">
            </div>
        </div>
    </div>
</template>


<style></style>
