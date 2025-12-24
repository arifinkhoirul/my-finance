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
    LogOut,
    ChartNoAxesCombined,
    ChartPie,
    ChartColumnBig,
    ChartBarStacked
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

    selfRewardDataLastMothFourth: Number,
    selfRewardDataLastMothThird: Number,
    selfRewardDataLastMothSecond: Number,
    selfRewardDataLastMothNow: Number,

    totalSaldo: Number,
    totalExpenses: Number,

    expensesFoodMonthFourth: Number,
    expensesTransportationMonthFourth: Number,
    expensesTagihanMonthFourth: Number,
    expensesHealthMonthFourth: Number,
    expensesEducationMonthFourth: Number,
    expensesOtherMonthFourth: Number,

    expensesFoodMontThird: Number,
    expensesTransportationMontThird: Number,
    expensesTagihanMontThird: Number,
    expensesHealthMontThird: Number,
    expensesEducationMontThird: Number,
    expensesOtherMontThird: Number,

    expensesFoodMontSecond: Number,
    expensesTransportationMontSecond: Number,
    expensesTagihanMontSecond: Number,
    expensesHealthMontSecond: Number,
    expensesEducationMontSecond: Number,
    expensesOtherMontSecond: Number,

    expensesFoodMontNow: Number,
    expensesTransportationMontNow: Number,
    expensesTagihanMontNow: Number,
    expensesHealthMontNow: Number,
    expensesEducationMontNow: Number,
    expensesOtherMontNow: Number,
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


const selfRewardEmpatBarChart = Math.abs(props.selfRewardDataLastMothFourth);
const selfRewardTigaBarChart = Math.abs(props.selfRewardDataLastMothThird);
const selfRewardDuaBarChart = Math.abs(props.selfRewardDataLastMothSecond);
const selfRewardSatuBarChart = Math.abs(props.selfRewardDataLastMothNow);


const fourthMonthFoodExpenses = Math.abs(props.expensesFoodMonthFourth);
const fourthMonthTransportationExpenses = Math.abs(props.expensesTransportationMonthFourth);
const fourthMonthTagihanExpenses = Math.abs(props.expensesTagihanMonthFourth);
const fourthMonthHealthExpenses = Math.abs(props.expensesHealthMonthFourth);
const fourthMonthEducationExpenses = Math.abs(props.expensesEducationMonthFourth);
const fourthMonthOtherExpenses = Math.abs(props.expensesOtherMonthFourth);

const thirdMonthFoodExpenses = Math.abs(props.expensesFoodMontThird);
const thirdMonthTransportationExpenses = Math.abs(props.expensesTransportationMontThird);
const thirdMonthTagihanExpenses = Math.abs(props.expensesTagihanMontThird);
const thirdMonthHealthExpenses = Math.abs(props.expensesHealthMontThird);
const thirdMonthEducationExpenses = Math.abs(props.expensesEducationMontThird);
const thirdMonthOtherExpenses = Math.abs(props.expensesOtherMontThird);

const secondMonthFoodExpenses = Math.abs(props.expensesFoodMontSecond);
const secondMonthTransportationExpenses = Math.abs(props.expensesTransportationMontSecond);
const secondMonthTagihanExpenses = Math.abs(props.expensesTagihanMontSecond);
const secondMonthHealthExpenses = Math.abs(props.expensesHealthMontSecond);
const secondMonthEducationExpenses = Math.abs(props.expensesEducationMontSecond);
const secondMonthOtherExpenses = Math.abs(props.expensesOtherMontSecond);

const nowMonthFoodExpenses = Math.abs(props.expensesFoodMontNow);
const nowMonthTransportationExpenses = Math.abs(props.expensesTransportationMontNow);
const nowMonthTagihanExpenses = Math.abs(props.expensesTagihanMontNow);
const nowMonthHealthExpenses = Math.abs(props.expensesHealthMontNow);
const nowMonthEducationExpenses = Math.abs(props.expensesEducationMontNow);
const nowMonthOtherExpenses = Math.abs(props.expensesOtherMontNow);

// function generate 4 bulan terakhir--------------------------------------------------
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
// ----------------------------------------------------


// grafik pertama------------------------------------
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
// ------------------------------------------------------------------------------------------


// grafik kedua ----------------------------------------------------------------------------
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

// ---------------------------------------------------------------------------------------------


// grafik keempat-----------------------------------------------------------------------------------------------------------------
const barSeriesSelfReward = [
    { name: 'Self Reward', data: [selfRewardEmpatBarChart, selfRewardTigaBarChart, selfRewardDuaBarChart, selfRewardSatuBarChart] }
]

const barOptionsSelfReward = {
    colors: ['#fbbf24'],
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
// --------------------------------------------------------------------------------------------------------------------------------



// grafik ketiga-------------------------------------------------------------------------------------------------------------
// Data series untuk chart
const barStackedSeries = ref([
    {
        name: 'Makanan',
        data: [fourthMonthFoodExpenses, thirdMonthFoodExpenses, secondMonthFoodExpenses, nowMonthFoodExpenses]
    },
    {
        name: 'Transportasi',
        data: [fourthMonthTransportationExpenses, thirdMonthTransportationExpenses, secondMonthTransportationExpenses, nowMonthTransportationExpenses]
    },
    {
        name: 'Tagihan',
        data: [fourthMonthTagihanExpenses, thirdMonthTagihanExpenses, secondMonthTagihanExpenses, nowMonthTagihanExpenses]
    },
    {
        name: 'Kesehatan',
        data: [fourthMonthHealthExpenses, thirdMonthHealthExpenses, secondMonthHealthExpenses, nowMonthHealthExpenses]
    },
    {
        name: 'Pendidikan',
        data: [fourthMonthEducationExpenses, thirdMonthEducationExpenses, secondMonthEducationExpenses, nowMonthEducationExpenses]
    },
    {
        name: 'Lainnya',
        data: [fourthMonthOtherExpenses, thirdMonthOtherExpenses, secondMonthOtherExpenses, nowMonthOtherExpenses]
    }
]);

// Konfigurasi chart options
const barStackedOptions = ref({
    chart: {
        type: 'bar',
        height: 400,
        stacked: true,
        stackType: '100%',
        toolbar: {
            show: true
        }
    },
    plotOptions: {
        bar: {
            horizontal: true,
            dataLabels: {
                position: 'center'
            }
        }
    },
    dataLabels: {
        enabled: true,
        formatter: function (val) {
            return Math.round(val) + '%';
        },
        style: {
            fontSize: '12px',
            fontWeight: 'bold',
            colors: ['#fff']
        }
    },
    stroke: {
        width: 0
    },
    title: {
        align: 'left',
        style: {
            fontSize: '16px',
            fontWeight: 'bold'
        }
    },
    xaxis: {
        categories: getLastMonths(4),
        labels: {
            formatter: function (val) {
                return val;
            }
        },
        max: 100
    },
    yaxis: {
        title: {
            text: undefined
        }
    },
    tooltip: {
        y: {
            formatter: function (val) {
                return `Rp` + ' ' + Math.abs(val).toLocaleString('id-ID');
            }
        }
    },
    fill: {
        opacity: 1
    },
    legend: {
        position: 'top',
        horizontalAlign: 'left',
        offsetX: 40,
        markers: {
            width: 12,
            height: 12,
            radius: 2
        }
    },
    colors: ['#5B93F5', '#5DD39E', '#FFB944', '#EF5350', '#7E57C2', '#E9762B']
});
// ------------------------------------------------------------------------------------------------------------


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
// ------------------------------------
</script>


<template>
    <div class="min-h-screen bg-slate-100 p-4 space-y-6">
        <!-- Header -->
        <div class="bg-gradient-to-r from-purple-600 to-indigo-500 rounded-2xl p-6 text-white">
            <h1 class="text-xl font-bold">Statistik Keuangan</h1>
            <p class="opacity-80">Analisis keuangan 4 bulan terakhir</p>
        </div>

        <!-- Cards -->
        <div class="grid grid-cols-2 gap-4">
            <StatCard title="Total Saldo" :value="Math.abs(totalSaldo).toLocaleString('id-ID')" />
            <StatCard title="Total Investasi" :value="Math.abs(totalInvestment).toLocaleString('id-ID')" />
            <StatCard title="Total Cash" :value="Math.abs(totalCash).toLocaleString('id-ID')" />
            <StatCard title="Total Pengeluaran" :value="Math.abs(totalExpenses).toLocaleString('id-ID')" />
        </div>

        <!-- Line Chart -->
        <div class="bg-white rounded-2xl p-4 shadow">
            <div class="grid grid-cols-2 justify-items-start">
                <ChartNoAxesCombined class="ml-4 text-purple-700" />
                <h2 class="font-semibold mb-2 ml-[-120px]">Tren Saldo</h2>
            </div>
            <VueApexCharts type="area" height="250" :options="lineOptions" :series="lineSeries" />
        </div>

        <!-- Donut Chart -->
        <div class="bg-white rounded-2xl p-4 shadow">
            <div class="grid grid-cols-2 justify-items-start">
                <ChartPie class="ml-4 text-green-700" />
                <h2 class="font-semibold mb-2 ml-[-120px]">Distribusi Saldo</h2>
            </div>
            <VueApexCharts type="donut" height="250" :options="donutOptions" :series="donutSeries" />
        </div>

        <!-- Bar Chart -->
        <div class="bg-white rounded-2xl p-4 shadow">
            <div class="grid grid-cols-2 justify-items-start">
                <ChartColumnBig class="ml-4 text-red-500" />
                <h2 class="font-semibold mb-2 ml-[-120px]">Pengeluaran Bulanan </h2>
            </div>
            <VueApexCharts type="bar" height="250" :options="barOptions" :series="barSeries" />
        </div>

        <div class="bg-white rounded-2xl pt-4 shadow">
            <div class="grid grid-cols-2 justify-items-start">
                <ChartBarStacked class="ml-4 text-blue-500" />
                <h2 class="font-semibold mb-2 ml-[-120px]">Kategori Pengeluaran Bulanan</h2>
            </div>
            <VueApexCharts type="bar" height="500" :series="barStackedSeries" :options="barStackedOptions" />
        </div>

        <!-- Bar Chart -->
        <div class="bg-white rounded-2xl p-4 shadow">
            <div class="grid grid-cols-2 justify-items-start">
                <ChartColumnBig class="ml-4 text-yellow-500" />
                <h2 class="font-semibold mb-2 ml-[-120px]">Pengeluaran Self Reward Bulanan</h2>
            </div>
            <VueApexCharts type="bar" height="250" :options="barOptionsSelfReward" :series="barSeriesSelfReward" />
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
            class="animate-pulse relative overflow-hidden rounded-2xl w-[340px] h-[50px] mb-3 bg-slate-500/80 p-10">
        </div>

        <div v-else class="bg-white rounded-full shadow-xl px-6 md:px-16 py-5 flex items-center gap-8 w-[85%] max-w-md">
            <!-- Home -->
            <Link :href="route('financial.dashboard')">
                <div class="flex flex-col items-center hover:text-purple-700">
                    <Home />
                    <!-- <span class="text-xs mt-1">Beranda</span> -->
                </div>
            </Link>

            <Link :href="route('statistik.index')">
                <!-- Statistik -->
                <div class="flex flex-col items-center text-purple-700  ">
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
            <Link>
                <div class="flex flex-col items-center hover:text-purple-700 text-gray-400">
                    <Settings />
                    <!-- <span class="text-xs mt-1">Pengaturan</span> -->
                </div>
            </Link>

            <!-- Profil -->
            <Link :href="route('myProfile.index')">
                <div class="flex flex-col items-center hover:text-purple-700 text-gray-400">
                    <User />
                    <!-- <span class="text-xs mt-1">Profil</span> -->
                </div>
            </Link>
        </div>
    </div>
</template>


<style></style>
