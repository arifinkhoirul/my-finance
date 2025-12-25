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
                    {{ capitalizeFirst(wallet) }}
                </h3>
                <p class="text-sm text-gray-700">
                    {{ capitalizeFirst(category) }}
                </p>
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
                {{ formatDate(date) }}
            </p>
        </div>

        <div class="flex items-center gap-3 ml-4">
            <Link
                :href="wallet == 'investasi' ? route('investasi.edit', dataId) : wallet == 'pemasukan' ? route('pemasukan.edit', dataId) : wallet == 'pengeluaran' ? route('pengeluaran.edit', dataId) : route('self.reward.edit', dataId)">
                <button
                    :class="wallet == 'investasi' ? 'text-[#5F42F0]' : wallet == 'pemasukan' ? 'text-green-700' : wallet == 'pengeluaran' ? 'text-red-600' : 'text-yellow-600'">
                    <Edit2 class="w-4 h-4" />
                </button>
            </Link>
            <button @click="emit('deleteChiild', dataId)" class="text-red-500">
                <Trash2 class="w-4 h-4" />
            </button>
        </div>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { ArrowLeft, TrendingUp, Edit2, Trash2, Wallet, TrendingDown, RedoDot } from 'lucide-vue-next'
import { defineProps, ref, onMounted, defineEmits, capitalize } from 'vue';

function capitalizeFirst(text) {
    if (!text) return ''
    return text.charAt(0).toUpperCase() + text.slice(1)
}



const { wallet, description, amount, date, dataId } = defineProps({
    wallet: String,
    description: String,
    amount: String,
    date: String,
    dataId: Number,
    category: String
})



const emit = defineEmits(['deleteChiild'])



const loading = ref(true)

onMounted(() => {
    setTimeout(() => {
        loading.value = false
    }, 2000);
})




const formatDate = (date) => {
    const d = new Date(date)
    const now = new Date()

    const isToday =
        d.getDate() === now.getDate() &&
        d.getMonth() === now.getMonth() &&
        d.getFullYear() === now.getFullYear()

    const yesterday = new Date()
    yesterday.setDate(now.getDate() - 1)

    const isYesterday =
        d.getDate() === yesterday.getDate() &&
        d.getMonth() === yesterday.getMonth() &&
        d.getFullYear() === yesterday.getFullYear()

    const time = d.toLocaleTimeString('id-ID')

    // if (isToday) return `Hari ini, ${time}`
    // if (isYesterday) return `Kemarin, ${time}`

    return d.toLocaleDateString('id-ID', {
        day: '2-digit',
        month: 'short',
        year: 'numeric'
    })
}
</script>



<style scoped>
.list-enter-active {
    animation: fadeSlideUp 0.5s ease-out forwards;
}

@keyframes fadeSlideUp {
    from {
        opacity: 0;
        transform: translateY(12px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>
