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
    CircleCheck,
    LogOut
} from 'lucide-vue-next'
import { ref, onMounted, defineProps } from 'vue';
import { Link } from '@inertiajs/vue3'
import StatCard from '../../Components/StatCard.vue'
import VueApexCharts from 'vue3-apexcharts'






const props = defineProps({
    saldoTrendMonthFourth: Number,
    saldoTrendMonthThird: Number,
    saldoTrendMonthSecond: Number,
    saldoTrendMonthNow: Number,
    totalInvestment: Number,
    totalCash: Number,
    expensesDataLastMothFourth: Number,
    expensesDataLastMothThird: Number,
    expensesDataLastMothSecond: Number,
    expensesDataLastMothNow: Number,
})

const bulanEmpatGrafikArea = Math.abs(props.saldoTrendMonthFourth);
const bulanTigaGrafikArea = Math.abs(props.saldoTrendMonthThird);
const bulanDuaGrafikArea = Math.abs(props.saldoTrendMonthSecond);
const bulanSatuGrafikArea = Math.abs(props.saldoTrendMonthNow);

const totalInvestasiPieChart = Math.abs(props.totalInvestment);
const totalMoneyCashPieChart = Math.abs(props.totalCash);

const expensesEmpatBarChart = Math.abs(props.expensesDataLastMothFourth);
const expensesTigaBarChart = Math.abs(props.expensesDataLastMothThird);
const expensesDuaBarChart = Math.abs(props.expensesDataLastMothSecond);
const expensesSatuBarChart = Math.abs(props.expensesDataLastMothNow);

// --------------------------------------------------
function getLastMonths(count = 4) {
    const months = []
    const now = new Date()

    for (let i = count - 1; i >= 0; i--) {
        const date = new Date(now.getFullYear(), now.getMonth() - i, 1)
        months.push(
            date.toLocaleString('id-ID', { month: 'short' })
        )
    }

    return months
}


const lineSeries = [
    { name: 'Saldo Utama', data: [bulanEmpatGrafikArea, bulanTigaGrafikArea, bulanDuaGrafikArea, bulanSatuGrafikArea] }
]

const lineOptions = {
    chart: { toolbar: { show: false } },
    colors: ['#7c3aed'],
    dataLabels: { enabled: false },
    stroke: { curve: 'smooth' },
    xaxis: { categories: getLastMonths(4) },

    yaxis: {
        labels: {
            formatter: (val) => {
                return val.toLocaleString('id-ID')
            }
        }
    },

    tooltip: {
        y: {
            formatter: (val) => {
                return 'Rp ' + val.toLocaleString('id-ID')
            }
        }
    }
}

// ------------------------------------
const donutSeries = [totalMoneyCashPieChart, totalInvestasiPieChart]

const donutOptions = {
    labels: ['Cash', 'Investasi'],
    colors: ['#22c55e', '#6366f1']
}


const barSeries = [
    { name: 'Pengeluaran', data: [expensesEmpatBarChart, expensesTigaBarChart, expensesDuaBarChart, expensesSatuBarChart] }
]

const barOptions = {
    colors: ['#ef4444'],
    xaxis: {
        categories: getLastMonths(4)
    },
    yaxis: {
        labels: {
            formatter: (value) => {
                return value.toLocaleString('id-ID')
            }
        }
    },
    tooltip: {
        y: {
            formatter: (value) => {
                return 'Rp ' + value.toLocaleString('id-ID')
            }
        }
    }
}


const radialSeries = [20, 40, 30, 10]

const radialOptions = {
    chart: {
        type: 'radialBar',
    },
    plotOptions: {
        radialBar: {
            hollow: {
                size: '35%',
            },
            dataLabels: {
                name: {
                    show: true,
                },
                value: {
                    show: true,
                    formatter: val => `${val}%`,
                },
                total: {
                    show: true,
                    label: 'TOTAL',
                    formatter: () => '100%',
                },
            },
        },
    },
    labels: ['TEAM A', 'TEAM B', 'TEAM C', 'TEAM D'],
    colors: ['#60a5fa', '#34d399', '#fbbf24', '#f87171'],
}

// ------------------------------------
const showAddMenu = ref(false)

const openAddMenu = () => {
    showAddMenu.value = true
}

const closeAddMenu = () => {
    showAddMenu.value = false
}
// -------------------------------------
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


// ----------------------------------
const moveLoadingPengeluaran = ref(true)

const startLoadingPengeluaran = () => {
    moveLoadingPengeluaran.value = false
}
</script>


<template>
    <div class="min-h-screen bg-slate-100 p-4 space-y-6">
        <!-- Header -->
        <div class="bg-gradient-to-r from-purple-600 to-indigo-500 rounded-2xl p-6 text-white">
            <h1 class="text-xl font-bold">Statistik Keuangan</h1>
            <p class="opacity-80">Analisis keuangan 6 bulan terakhir</p>
        </div>

        <!-- Cards -->
        <div class="grid grid-cols-2 gap-4">
            <StatCard title="Total Saldo" value="Rp 3.8M" growth="+11.8%" />
            <StatCard title="Investasi" value="Rp 1.6M" growth="+14.3%" />
            <StatCard title="Cash" value="Rp 1.7M" />
            <StatCard title="Pengeluaran" value="Rp 2.0M" />
        </div>

        <!-- Line Chart -->
        <div class="bg-white rounded-2xl p-4 shadow">
            <h2 class="font-semibold mb-2">Tren Saldo</h2>
            <VueApexCharts type="area" height="250" :options="lineOptions" :series="lineSeries" />
        </div>

        <!-- Donut Chart -->
        <div class="bg-white rounded-2xl p-4 shadow">
            <h2 class="font-semibold mb-2">Distribusi Aset</h2>
            <VueApexCharts type="donut" height="250" :options="donutOptions" :series="donutSeries" />
        </div>

        <!-- Bar Chart -->
        <div class="bg-white rounded-2xl p-4 shadow">
            <h2 class="font-semibold mb-2">Pengeluaran Bulanan & (belum nambahin data Self Reward)</h2>
            <VueApexCharts type="bar" height="250" :options="barOptions" :series="barSeries" />
        </div>


        <div class="bg-white rounded-2xl p-4 shadow">
            <h1 class="font-semibold mb-2">Kategori Pengeluaran</h1>
            <VueApexCharts type="radialBar" height="250" :series="radialSeries" :options="radialOptions" />
        </div>
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

                <Link @click="startLoadingPengeluaran()" :href="route('pengeluaran.create')">
                    <button v-if="moveLoadingPengeluaran"
                        class="w-full flex items-center gap-4 hover:scale-110 mt-4 bg-white hover:bg-gradient-to-br hover:from-red-700 hover:to-white hover:text-white transition-all shadow rounded-2xl p-4">
                        <div
                            class="w-12 h-12 rounded-xl bg-gradient-to-br from-rose-500 to-red-600 flex items-center justify-center text-white">
                            <TrendingDown />
                        </div>
                        <span class="font-semibold text-lg">Pengeluaran</span>
                        <ChevronRight class="ml-[83px] text-red-700" />
                    </button>
                    <button v-else
                        class="w-full flex items-center gap-4 mt-4 hover:scale-110 hover:bg-gradient-to-br hover:from-green-700 hover:to-white transition-all hover:text-white bg-white shadow rounded-2xl h-[70px] p-4">
                        <span class="font-semibold text-lg transition-all">Loading...</span>
                    </button>
                </Link>

                <!-- Cancel -->
                <button @click="closeAddMenu"
                    class="w-full flex items-center  bg-gradient-to-br from-indigo-500 to-purple-500 justify-center gap-2 text-white rounded-2xl p-4 mt-2 font-semibold text-lg">
                    ✕ Batal
                </button>

            </div>
        </div>
    </transition>

    <div class="fixed bottom-4 left-0 right-0 z-40 flex justify-center">
        <!-- conten loader -->
        <div v-if="loading"
            class="animate-pulse relative overflow-hidden rounded-2xl w- h-[50px] mb-3 bg-slate-300/0 p-10">
        </div>

        <div v-else class="bg-white rounded-full shadow-xl px-6 md:px-16 py-5 flex items-center gap-8 w-[85%] max-w-md">
            <!-- Home -->
            <Link :href="route('financial.dashboard')">
                <div class="flex flex-col items-center text-purple-600">
                    <Home />
                    <!-- <span class="text-xs mt-1">Beranda</span> -->
                </div>
            </Link>

            <Link :href="route('statistik.index')">
                <!-- Statistik -->
                <div class="flex flex-col items-center text-gray-400">
                    <BarChart2 />
                    <!-- <span class="text-xs mt-1">Statistik</span> -->
                </div>
            </Link>

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
</template>


<style></style>
