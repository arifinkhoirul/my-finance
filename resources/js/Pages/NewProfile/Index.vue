<script setup>
import {
    ArrowLeft,
    Camera,
    TrendingUp,
    TrendingDown,
    Home,
    BarChart2,
    Plus,
    Settings,
    User,
    ChartCandlestick,
    RedoDot,
    ChevronRight,
    LogOut,
    Heart,
} from 'lucide-vue-next'
import ProfileItem from '@/Components/ProfileItem.vue';
import { defineProps, ref, onMounted } from 'vue';
import { Link } from '@inertiajs/vue3';


defineProps({
    userName: String,
    userEmail: String,
    userBergabung: String,
    totalTransaksi: Number
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


const moveLoadingPage = ref(false)

const loadingPage = () => {
    moveLoadingPage.value = true
}
</script>


<template>
    <!-- pokemon loading -->
    <transition name="fade">
        <div v-if="moveLoadingPage"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/30 backdrop-blur-sm">
            <div class="loader"></div>
        </div>
    </transition>

    <div class="min-h-screen bg-gray-100 h-[1200px]">
        <!-- skeleton laoding -->
        <!-- Header -->
        <div :class="loading ? '' : 'ungu-sesuai'" class="pt-6 pb-20 relative">
            <div v-if="loading" class="animate-pulse relative">
            </div>
            <div v-else class="flex items-center gap-3 px-4 text-white">
                <!-- <a :href="route('financial-dashboard')"> -->
                <Link @click="loadingPage()" :href="route('financial.dashboard')" class="p-2 rounded-full bg-white/20">
                    <ArrowLeft size="20" />
                </Link>
                <!-- </a> -->
                <h1 class="text-lg font-semibold">Profil Saya</h1>
            </div>
        </div>

        <!-- Profile Card -->
        <div class="relative -mt-16 px-4">
            <!-- skeleton laoding -->
            <div v-if="loading"
                class="animate-pulse relative overflow-hidden rounded-2xl w-full h-[300px] mb-3 bg-slate-500/80 p-10">
            </div>
            <div v-else class="bg-white rounded-2xl shadow p-6 text-center">
                <!-- Avatar -->
                <div class="relative inline-block">
                    <img src="https://images.pexels.com/photos/210600/pexels-photo-210600.jpeg" loading="lazy"
                        class="w-24 h-24 rounded-full object-cover border-4 border-white" />
                    <!-- <button class="absolute bottom-0 right-0 ungu-sesuai p-2 rounded-full text-white shadow">
                        <Camera size="16" />
                    </button> -->
                </div>

                <!-- Name -->
                <h2 class="mt-4 text-lg font-bold">{{ userName }}</h2>
                <p class="text-sm text-gray-500">{{ userEmail }}</p>

                <!-- Divider -->
                <div class="my-4 h-px bg-gray-200"></div>

                <!-- Stats -->
                <div class="flex justify-around">
                    <div>
                        <p class="text-purpl color-ungu-sesuai font-bold text-lg">{{ totalTransaksi }}</p>
                        <p class="text-xs text-gray-500">Transaksi</p>
                    </div>
                    <div>
                        <p class="color-ungu-sesuai font-bold text-lg">{{ formatDate(userBergabung) }}</p>
                        <p class="text-xs text-gray-500">Bergabung</p>
                    </div>
                </div>
            </div>
        </div>


        <div class="px-4 mt-6 space-y-4">
            <!-- skeleton laoding -->
            <div v-if="loading"
                class="animate-pulse relative overflow-hidden rounded-2xl w-ful h-[300px] mb-3 bg-slate-500/80 p-10">
            </div>
            <!-- Informasi Pribadi -->
            <div v-else class="bg-white rounded-2xl p-4 shadow">
                <h3 class="text-sm font-semibold mb-3">Informasi Pribadi</h3>
                <ProfileItem icon="User" title="Nama Lengkap" :value="userName" />
                <ProfileItem icon="Mail" title="Email" :value="userEmail" />
                <ProfileItem icon="Phone" title="Nomor Telepon" value="Fitur belum tersedia" />
                <ProfileItem icon="MapPin" title="Lokasi" value="Fitur belum tersedia" />
            </div>


            <!-- skeleteo loading -->
            <div v-if="loading"
                class="animate-pulse relative overflow-hidden rounded-2xl w-ful h-[300px] mb-3 bg-slate-500/80 p-10">
            </div>
            <!-- Pengaturan -->
            <div v-else class="bg-white rounded-2xl p-4 shadow">
                <h3 class="text-sm font-semibold mb-3">Pengaturan</h3>

                <ProfileItem icon="Bell" title="Notifikasi" value="Fitur belum tersedia" />
                <ProfileItem icon="Shield" title="Keamanan" value="Fitur belum tersedia" />
                <ProfileItem icon="CreditCard" title="Metode Pembayaran" value="Fitur belum tersedia" />
                <ProfileItem icon="HelpCircle" title="Dukungan & Bantuan" value="Fitur belum tersedia" />
            </div>


            <!-- skeleteo loading -->
            <div v-if="loading"
                class="animate-pulse relative overflow-hidden rounded-2xl w-ful h-[80px] mb-3 bg-slate-500/80 p-10">
            </div>
            <!-- Logout -->
            <Link :href="route('logout')" method="post" as="button"
                class="w-full flex items-center justify-center gap-2 py-3 rounded-xl bg-red-100 tepurplungu-sesuai font-semibold">
                <LogOut size="18" />
                Keluar dari Akun
            </Link>
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

        <div v-if="loading">
        </div>
        <div v-else class="fixed bottom-4 left-0 right-0 z-40 flex justify-center">
            <div class="bg-white rounded-full shadow-xl px-6 md:px-16 py-5 flex items-center gap-8 w-[85%] max-w-md">
                <!-- Home -->
                <Link @click="loadingPage()" :href="route('financial.dashboard')">
                    <div class="flex flex-col items-center hover:text-purple-700">
                        <Home />
                        <!-- <span class="text-xs mt-1">Beranda</span> -->
                    </div>
                </Link>

                <Link @click="loadingPage()" :href="route('statistik.index')">
                    <!-- Statistik -->
                    <div class="flex flex-col items-center">
                        <BarChart2 />
                        <!-- <span class="text-xs mt-1">Statistik</span> -->
                    </div>
                </Link>

                <!-- Plus Button -->
                <div @click="openAddMenu()"
                    class="-mt-8 bg-gradient-to-br from-indigo-500 to-purple-500 text-white p-4 rounded-full shadow-xl active:scale-95 transition">
                    <Plus />
                </div>

                <!-- Dukungan -->
                <Link @click="loadingPage()" :href="route('dukungan.index')">
                    <div class="flex flex-col items-center hover:text-purple-700 text-gray-400 ">
                        <Heart />
                        <!-- <span class="text-xs mt-1">Pengaturan</span> -->
                    </div>
                </Link>

                <!-- Profil -->
                <Link @click="loadingPage()" :href="route('myProfile.index')">
                    <div class="flex flex-col items-center hover:text-purple-700 text-purple-700  ">
                        <User />
                        <!-- <span class="text-xs mt-1">Profil</span> -->
                    </div>
                </Link>
            </div>
        </div>
    </div>
</template>

<style scoped>
.ungu-sesuai {
    background-color: #5F42F0;
}

.color-ungu-sesuai {
    color: #5F42F0;
}




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
