<script setup>
import {
    Wallet,
    TrendingUp,
    TrendingDown,
    ArrowUpRight,
    ArrowDownRight,
    Car,
    Utensils,
    Film,
    ShoppingBag,
    Gift,
    Home,
    BarChart2,
    Plus,
    Settings,
    User,
    ChartCandlestick,
    RedoDot,
    BanknoteArrowUp,
    BanknoteArrowDown,
    ArrowRight,
    ChevronRight,
    BadgeCheck,
    X,
    CircleCheck
} from 'lucide-vue-next'
import { defineProps, ref, watch, onMounted } from 'vue';
import { usePage, Link } from '@inertiajs/vue3';


// -----------------------------------
defineProps({
    transactions: Array,
    wallets: Array,
    walletInvestment: Object,
    walletExpenses: Object,
    walletCash: Object,
    totalIncome: Object,
    totalSelfReward: Object,
    walletIncome: Object,
    saldoUtama: Object,

})

// ----------------------------------

// --------------------------------
const loading = ref(true)

onMounted(() => {
    setTimeout(() => {
        loading.value = false
    }, 2000);
})
// --------------------------------


// ----------------------------------
const moveLoading = ref(true)

const startLoading = () => {
    moveLoading.value = false
}

const moveLoadingInvestasi = ref(true)

const startLoadingInvestasi = () => {
    moveLoadingInvestasi.value = false
}

// ----------------------------------

// ----------------------------------
const moveLoadingSelfReward = ref(true)

const startLoadingSelfReward = () => {
    moveLoadingSelfReward.value = false
}
// ----------------------------------


// ---------------------------------
const page = usePage()

const showFlash = ref(false)

watch(
    () => page.props.flash?.message,
    (message) => {
        if (message) {
            showFlash.value = true

            setTimeout(() => {
                showFlash.value = false
            }, 3000)
        }
    },
    { immediate: true }
)

// -------------------------------------


// ------------------------------------
const showAddMenu = ref(false)

const openAddMenu = () => {
    showAddMenu.value = true
}

const closeAddMenu = () => {
    showAddMenu.value = false
}
// -------------------------------------


// -------------------------------------------------
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
// ------------------------------------------------------------


// --------------------------------------------------------------
function formatShortRupiah(value) {
    const money = Math.abs(value)

    if (money >= 1_000_000_000) {
        return (value / 1_000_000_000).toFixed(1).replace('.0', '') + 'm'
    }

    if (money >= 1_000_000) {
        return (value / 1_000_000).toFixed(1).replace('.0', '') + 'jt'
    }

    if (money >= 1_000) {
        return (value / 1_000).toFixed(1).replace('.0', '') + 'k'
    }


    return value.toString()
}
// -----------------------------------------------------------------
</script>

<template>
    <Transition enter-active-class="transition ease-out duration-300" enter-from-class="opacity-0 translate-y-4"
        enter-to-class="opacity-100 translate-y-0" leave-active-class="transition ease-in duration-300"
        leave-from-class="opacity-100 translate-y-0" leave-to-class="opacity-0 translate-y-4">
        <div v-if="showFlash"
            class="fixed top-5 left-5 right-5 z-50 flex items-center gap-3 rounded-xl bg-white px-5 py-2 text-black shadow-xl shadow-emerald-700/30">
            <CircleCheck class="text-green-500 h-8 w-10" />

            <p class="text-md">
                {{ page.props.flash.message }}
                <!-- Kamu berhasil menambahkan pemasukan -->
            </p>

            <button @click="showFlash = false" class="ml-2  rounded-full p-1 hover:bg-white/20">
                <X class="h-4 w-4" />
            </button>
        </div>
    </Transition>

    <div class="min-h-screen bg-[#f6f7ff] p-4 pb-28">

        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-full bg-yellow-300 flex items-center justify-center">
                    😀
                </div>
                <div>
                    <p class="text-sm text-gray-500">Selamat datang 👋</p>
                    <h1 class="font-bold">Ahmad Fauzi</h1>
                </div>
            </div>

            <div class="flex gap-3">
                <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow">
                    🔍
                </div>
                <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow">
                    🔔
                </div>
            </div>
        </div>

        <!-- skeleton -->
        <div v-if="loading" class="animate-pulse relative overflow-hidden rounded-2xl h-[300px] mb-3 bg-slate-300 p-10">
        </div>
        <!-- Wallet Card -->
        <div v-else
            class="bg-gradient-to-br from-indigo-500 to-purple-500 rounded-3xl p-6 text-white mb-6 relative overflow-hidden">
            <div class="absolute right-[-40px] top-[-40px] w-40 h-40 bg-white/10 rounded-full"></div>

            <div class="flex justify-between items-center mb-4">
                <div class="flex items-center gap-2">
                    <Wallet />
                    <span class="font-semibold">Dompet Utama</span>
                </div>
                <button class="bg-white/20 px-4 py-1 rounded-full text-sm">
                    Ubah
                </button>
            </div>

            <p class="text-sm opacity-80">Total Saldo</p>
            <h2 class="text-3xl font-bold mb-6">Rp {{ Math.abs(saldoUtama).toLocaleString('id-ID') }}</h2>

            <div class="grid grid-cols-2 gap-4">
                <div class="bg-white/20 rounded-2xl p-4">
                    <div class="bg-emerald-200 w-10 px-2 py-1 rounded-full mb-2">
                        <TrendingUp class="mb-1 text-green-400" />
                    </div>
                    <p class="text-sm">Pemasukan Bulan ini</p>
                    <p class="font-semibold">Rp {{ Math.abs(walletIncome).toLocaleString('id-ID') }}</p>
                </div>
                <div class="bg-white/20 rounded-2xl p-4">
                    <div class="bg-red-200 w-10 px-2 py-1 rounded-full mb-2">
                        <TrendingDown class="mb-1 text-red-400" />
                    </div>
                    <p class="text-sm">Pengeluaran Bulan Ini</p>
                    <p class="font-semibold">Rp {{ Math.abs(walletExpenses).toLocaleString('id-ID') }}</p>
                </div>
            </div>
        </div>

        <!-- Quick Cards -->
        <div class="grid md:grid-cols-3 grid-cols-2 gap-4 mb-6">
            <!-- skeleton -->
            <div v-if="loading" class="animate-pulse relative overflow-hidden rounded-2xl h-[130px] bg-slate-300 p-10">
            </div>
            <!-- Investasi -->
            <div v-else class="relative overflow-hidden rounded-2xl transition bg-purple-100 p-10">
                <!-- Icon -->
                <div class="absolute top-4 right-4 bg-purple-500 text-white p-2 rounded-full">
                    <TrendingUp :size="18" />
                </div>

                <p class="text-lg text-gray-500">Investasi</p>
                <p class="text-xl md:text-3xl font-bold text-purple-600">
                    Rp {{ Math.abs(walletInvestment).toLocaleString('id-ID') }}
                </p>

                <div class="absolute -bottom-6 -right-6 w-20 h-20 bg-purple-200 rounded-full"></div>
                <!-- Decorative shape -->
            </div>

            <!-- skeleton -->
            <div v-if="loading" class="animate-pulse relative overflow-hidden rounded-2xl h-[130px] bg-slate-300 p-10">
            </div>
            <!-- Pengeluaran -->
            <div v-else class="relative overflow-hidden rounded-2xl bg-yellow-100 p-10">
                <div class="absolute top-4 right-4 bg-yellow-500 text-white p-2 rounded-full">
                    <RedoDot :size="18" />
                </div>

                <p class="text-lg text-gray-500">Self Rewrd</p>
                <p class="text-xl md:text-3xl font-bold text-yellow-600">
                    Rp {{ Math.abs(totalSelfReward).toLocaleString('id-ID') }}
                </p>

                <div class="absolute -bottom-6 -right-6 w-20 h-20 bg-yellow-200 rounded-full"></div>
            </div>

            <!-- skeleton -->
            <div v-if="loading" class="animate-pulse relative overflow-hidden rounded-2xl h-[130px] bg-slate-300 p-10">
            </div>
            <!-- Cash -->
            <div v-else class="relative overflow-hidden rounded-2xl bg-blue-100 p-10">
                <div class="absolute top-4 right-4 bg-blue-500 text-white p-2 rounded-full">
                    <Wallet :size="18" />
                </div>

                <p class="text-lg text-gray-500">Cash</p>
                <p class="text-xl md:text-3xl font-bold text-blue-600">
                    Rp {{ Math.abs(walletCash).toLocaleString('id-ID') }}
                </p>

                <div class="absolute -bottom-6 -right-6 w-20 h-20 bg-blue-200 z-0 rounded-full"></div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="grid grid-cols-4 gap-4 mb-6">
            <Action icon="TrendingUp" label="Pemasukan" />
            <Action icon="TrendingDown" label="Pengeluaran" />
            <Action icon="ArrowUpRight" label="Transfer" />
            <Action icon="Settings" label="Lainnya" />
        </div>
        <!-- Transactions -->
        <div class="flex justify-between items-center mb-4">
            <h2 class="font-bold text-lg">Transaksi Terakhir</h2>
            <a class="text-purple-600 text-sm font-bold">Lihat Semua</a>
        </div>

        <div class="space-y-3">
            <!-- skeleton -->
            <div v-if="loading" class="animate-pulse relative overflow-hidden rounded-2xl h-[60px] bg-slate-300 p-10">
            </div>
            <div v-if="loading" class="animate-pulse relative overflow-hidden rounded-2xl h-[60px] bg-slate-300 p-10">
            </div>
            <div v-if="loading" class="animate-pulse relative overflow-hidden rounded-2xl h-[60px] bg-slate-300 p-10">
            </div>
            <div v-if="loading" class="animate-pulse relative overflow-hidden rounded-2xl h-[60px] bg-slate-300 p-10">
            </div>
            <!-- end skeleton -->

            <!-- infromation transaction -->
            <div v-else v-for="transaction in transactions" :key="transaction.id"
                class="bg-white rounded-2xl p-4 flex justify-between items-center">
                <!--  -->
                <div class="flex items-center gap-3">
                    <div :class="transaction.category.name == 'transportasi' ? 'bg-red-200' : transaction.category.name == 'makanan' ? 'bg-red-200' : transaction.category.name == 'hiburan' ? 'bg-red-200' : transaction.category.name == 'belanja' ? 'bg-red-200' : transaction.category.name == 'gaji' ? 'bg-green-200' : transaction.category.name == 'self reward' ? 'bg-yellow-200' : transaction.category.name == 'freelance' ? 'bg-green-200' : 'bg-purple-200'"
                        class="w-10 h-10 rounded-xl  flex items-center justify-center">
                        <component
                            :class="transaction.category.name == 'transportasi' ? 'text-blue-700' : transaction.category.name == 'makanan' ? 'text-yellow-700' : transaction.category.name == 'hiburan' ? 'text-red-700' : transaction.category.name == 'belanja' ? 'text-red-700' : transaction.category.name == 'gaji' ? 'text-green-700' : transaction.category.name == 'self reward' ? 'text-yellow-700' : transaction.category.name == 'freelance' ? 'text-green-700' : 'text-purple-700'"
                            :is="transaction.category.name == 'transportasi' ? BanknoteArrowUp : transaction.category.name == 'makanan' ? BanknoteArrowUp : transaction.category.name == 'hiburan' ? BanknoteArrowUp : transaction.category.name == 'belanja' ? BanknoteArrowUp : transaction.category.name == 'gaji' ? BanknoteArrowDown : transaction.category.name == 'self reward' ? RedoDot : transaction.category.name == 'saham' ? ChartCandlestick : BanknoteArrowDown" />
                    </div>
                    <div>
                        <p class="font-medium">{{ transaction.wallet.name }}</p>
                        <p class="text-sm text-gray-500">{{ transaction.description }}</p>
                    </div>
                </div>
                <!-- <p>{{ transaction.wallet.name }}</p> -->
                <div class="text-right">
                    <p
                        :class="transaction.wallet.name == 'pengeluaran' ? 'text-red-500' : transaction.wallet.name == 'pemasukan' ? 'text-green-700' : transaction.wallet.name == 'investasi' ? 'text-purple-600' : 'text-yellow-500'">
                        {{ transaction.wallet.name == 'pengeluaran' ? '-' : transaction.wallet.name == 'pemasukan' ? '+'
                            : transaction.wallet.name == 'investasi' ? '->' : '-' }}Rp {{
                            Math.abs(transaction.amount).toLocaleString('id-ID') }}
                    </p>
                    <p class="text-xs text-gray-400">{{ formatDate(transaction.date) }}</p>
                </div>
            </div>
            <!-- end transaction -->
        </div>


        <!-- Backdrop -->
        <transition name="fade">
            <div v-if="showAddMenu" @click="closeAddMenu" class="fixed inset-0 bg-black/40 backdrop-blur-sm z-40"></div>
        </transition>

        <transition name="bottom-sheet ">
            <!-- Bottom Sheet -->
            <div v-if="showAddMenu" class="fixed bottom-0 left-0 right-0 z-50 pb-6 px-4 mb-[65px] animate-slide-up">
                <div class=" rounded-3xl p-4 space-y-4">

                    <!-- Item -->
                    <Link @click="startLoading()" :href="route('pemasukan.create')">
                        <button v-if="moveLoading"
                            class="w-full flex items-center gap-4 hover:scale-110 hover:bg-gradient-to-br hover:from-green-700 hover:to-white transition-all hover:text-white bg-white shadow rounded-2xl p-4">
                            <div
                                class="w-12 h-12 rounded-xl bg-gradient-to-br from-emerald-500 to-green-600 flex items-center justify-center text-white">
                                <TrendingUp />
                            </div>
                            <span class="font-semibold text-lg">Pemasukan</span>
                            <ChevronRight class="ml-[90px] text-green-700" />
                        </button>
                        <!-- loading -->
                        <button v-else
                            class="w-full flex items-center gap-4 hover:scale-110 hover:bg-gradient-to-br hover:from-green-700 hover:to-white transition-all hover:text-white bg-white shadow rounded-2xl h-[70px] p-4">
                            <span class="font-semibold text-lg transition-all">Loading...</span>
                        </button>
                    </Link>


                    <Link @click="startLoadingInvestasi()" :href="route('investasi.create')">
                        <button v-if="moveLoadingInvestasi"
                            class="w-full flex items-center gap-4 hover:scale-110 mt-4 hover:bg-gradient-to-br hover:from-purple-700 hover:to-white hover:text-white transition-all bg-white shadow rounded-2xl p-4">
                            <div
                                class="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-600 to-pink-300 flex items-center justify-center text-white">
                                <ChartCandlestick />
                            </div>
                            <span class="font-semibold text-lg">Investasi</span>
                            <ChevronRight class="ml-[110px] text-purple-700" />
                        </button>
                        <!-- loading -->
                        <button v-else
                            class="w-full flex items-center gap-4 mt-4 hover:scale-110 hover:bg-gradient-to-br hover:from-green-700 hover:to-white transition-all hover:text-white bg-white shadow rounded-2xl h-[70px] p-4">
                            <span class="font-semibold text-lg transition-all">Loading...</span>
                        </button>
                    </Link>

                    <Link @click="startLoadingSelfReward()" :href="route('self.reward.create')">
                        <button v-if="moveLoadingSelfReward"
                            class="w-full flex items-center gap-4 hover:scale-110 hover:bg-gradient-to-br mt-4 hover:from-yellow-600 hover:to-white hover:text-white transition-all bg-white shadow rounded-2xl p-4">
                            <div
                                class="w-12 h-12 rounded-xl bg-gradient-to-br from-yellow-300 to-yellow-600 bg-purple-500 flex items-center justify-center text-white">
                                <RedoDot />
                            </div>
                            <span class="font-semibold text-lg">Self Reward</span>
                            <ChevronRight class="ml-[85px] text-yellow-700" />
                            <!-- loading -->
                        </button>
                        <button v-else
                            class="w-full flex items-center gap-4 mt-4 hover:scale-110 hover:bg-gradient-to-br hover:from-green-700 hover:to-white transition-all hover:text-white bg-white shadow rounded-2xl h-[70px] p-4">
                            <span class="font-semibold text-lg transition-all">Loading...</span>
                        </button>
                    </Link>


                    <button
                        class="w-full flex items-center gap-4 hover:scale-110 bg-white hover:bg-gradient-to-br hover:from-red-700 hover:to-white hover:text-white transition-all shadow rounded-2xl p-4">
                        <div
                            class="w-12 h-12 rounded-xl bg-gradient-to-br from-rose-500 to-red-600 flex items-center justify-center text-white">
                            <TrendingDown />
                        </div>
                        <span class="font-semibold text-lg">Pengeluaran</span>
                        <ChevronRight class="ml-[83px] text-red-700" />

                    </button>

                    <!-- Cancel -->
                    <button @click="closeAddMenu"
                        class="w-full flex items-center  bg-gradient-to-br from-indigo-500 to-purple-500 justify-center gap-2 text-white rounded-2xl p-4 mt-2 font-semibold text-lg">
                        ✕ Batal
                    </button>

                </div>
            </div>
        </transition>


        <!-- Bottom Nav -->
        <!-- Floating Bottom Nav -->
        <div class="fixed bottom-4 left-0 right-0 z-40 flex justify-center">
            <div class="bg-white rounded-full shadow-xl px-6 md:px-16 py-5 flex items-center gap-8 w-[85%] max-w-md">
                <!-- Home -->
                <div class="flex flex-col items-center text-purple-600">
                    <Home />
                    <!-- <span class="text-xs mt-1">Beranda</span> -->
                </div>

                <!-- Statistik -->
                <div class="flex flex-col items-center text-gray-400">
                    <BarChart2 />
                    <!-- <span class="text-xs mt-1">Statistik</span> -->
                </div>

                <!-- Plus Button -->
                <div @click="openAddMenu()"
                    class="-mt-8 bg-gradient-to-br from-indigo-500 to-purple-500 text-white p-4 rounded-full shadow-xl active:scale-95 transition">
                    <Plus />
                </div>

                <!-- Pengaturan -->
                <div class="flex flex-col items-center text-gray-400">
                    <Settings />
                    <!-- <span class="text-xs mt-1">Pengaturan</span> -->
                </div>

                <!-- Profil -->
                <div class="flex flex-col items-center text-gray-400">
                    <User />
                    <!-- <span class="text-xs mt-1">Profil</span> -->
                </div>
            </div>
        </div>


    </div>
</template>


<style>
.bottom-sheet-enter-active,
.bottom-sheet-leave-active {
    transition: transform 0.25s ease, opacity 0.25s ease;
}

.bottom-sheet-enter-from {
    transform: translateY(100%);
    opacity: 0;
}

.bottom-sheet-enter-from {
    transform: translateY(50%);
    opacity: 0.5;
}

.bottom-sheet-enter-to {
    transform: translateY(0);
    opacity: 1;
}

.bottom-sheet-leave-from {
    transform: translateY(0);
    opacity: 1;
}

.bottom-sheet-leave-to {
    transform: translateY(100%);
    opacity: 0;
}

.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.25s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
