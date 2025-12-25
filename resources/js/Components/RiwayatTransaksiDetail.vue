<template>
    <div v-if="loading"
        class="animate-pulse relative overflow-hidden rounded-2xl w-full h-[85px] mb-3 bg-slate-500/80 p-10">
    </div>
    <div v-else class="bg-white rounded-xl p-4 flex items-center justify-between shadow-sm">
        <div class="flex items-center gap-4">
            <div class="bg-[#EDEBFF] w-12 h-12 rounded-xl flex items-center justify-center"
                :class="wallet == 'investasi' ? 'bg-[#EDEBFF]' : wallet == 'pemasukan' ? 'bg-green-200/40' : wallet == 'pengeluaran' ? 'bg-red-200/40' : 'bg-yellow-200/40'">
                <component
                    :class="wallet == 'investasi' ? 'text-[#5F42F0]' : wallet == 'pemasukan' ? 'text-green-700' : wallet == 'pengeluaran' ? 'text-red-600' : 'text-yellow-600'"
                    :is="wallet == 'investasi' ? TrendingUp : wallet == 'pemasukan' ? TrendingUp : wallet == 'pengeluaran' ? TrendingDown : RedoDot" />
            </div>

            <div class="mr-1">
                <h3 class="font-semibold">
                    {{ wallet }}
                </h3>
                <p class="text-sm text-gray-500">
                    {{ description }}
                </p>
            </div>
        </div>

        <div class="text-right">
            <p class="font-semibold"
                :class="wallet == 'investasi' ? 'text-[#5F42F0]' : wallet == 'pemasukan' ? 'text-green-700' : wallet == 'pengeluaran' ? 'text-red-600' : 'text-yellow-600'">
                Rp {{ Math.abs(amount).toLocaleString('id-ID') }}
            </p>
            <p class="text-sm text-gray-400">
                {{ date }}
            </p>
        </div>

        <div class="flex items-center gap-3 ml-4">
            <button
                :class="wallet == 'investasi' ? 'text-[#5F42F0]' : wallet == 'pemasukan' ? 'text-green-700' : wallet == 'pengeluaran' ? 'text-red-600' : 'text-yellow-600'">
                <Edit2 class="w-4 h-4" />
            </button>
            <button class="text-red-500">
                <Trash2 class="w-4 h-4" />
            </button>
        </div>
    </div>
</template>

<script setup>
import { ArrowLeft, TrendingUp, Edit2, Trash2, Wallet, TrendingDown, RedoDot } from 'lucide-vue-next'
import { defineProps, ref, onMounted } from 'vue';

const { wallet, description, amount, date } = defineProps({
    wallet: String,
    description: String,
    amount: String,
    date: String
})




const loading = ref(true)


onMounted(() => {
    setTimeout(() => {
        loading.value = false
    }, 2000);
})

</script>

<style></style>
