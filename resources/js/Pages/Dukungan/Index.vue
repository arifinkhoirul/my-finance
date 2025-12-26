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
    Coffee,
    Heart,
    Stethoscope,
    CircleCheck,
    X,
    MessageCircle
} from 'lucide-vue-next'
import { ref, onMounted, watch } from 'vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';



const page = usePage()

const form = useForm({
    user_id: page.props.user.id,
    nama_samaran: null,
    description: null
})


const showFlash = ref(false)


function submit() {
    form.post(route('dukungan.store'), {
        onSuccess: () => {
            form.reset()
            showFlash.value = true
        }
    })
}


watch(
    () => page.props.flash?.message,
    (message) => {
        if (message) {
            setTimeout(() => {
                showFlash.value = false
            }, 3000)
        }
    },
    { immediate: true }
)


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
    <!-- flash message -->
    <Transition enter-active-class="transition ease-out duration-300" enter-from-class="opacity-0 translate-y-4"
        enter-to-class="opacity-100 translate-y-0" leave-active-class="transition ease-in duration-300"
        leave-from-class="opacity-100 translate-y-0" leave-to-class="opacity-0 translate-y-4">
        <div v-if="showFlash"
            class="fixed top-14 left-5 right-5 z-50 flex items-center gap-3 rounded-2xl bg-white px-5 py-2 text-black shadow-xl shadow-emerald-700/30">
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

    <!-- pokemon loading -->
    <transition name="fade">
        <div v-if="moveLoadingPage"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/30 backdrop-blur-sm">
            <div class="loader"></div>
        </div>
    </transition>

    <div class="min-h-screen bg-gray-100 h-[1350px]">
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
                <h1 class="text-lg font-semibold">Dukungan Kami</h1>
            </div>
        </div>

        <!-- cofffe  -->
        <div class="relative -mt-16 px-4">
            <!-- skeleton laoding -->
            <div v-if="loading"
                class="animate-pulse relative overflow-hidden rounded-2xl w-full h-[300px] mb-3 bg-slate-500/80 p-10">
            </div>
            <div v-else class="bg-white rounded-2xl shadow p-6 text-center">
                <div class="bg-card rounded-2xl p-6 shadow-card text-center">
                    <div
                        class="w-20 h-20 mx-auto mb-4 rounded-full bg-gradient-to-br from-pink-500 to-orange-400 flex items-center justify-center">
                        <Coffee class="w-10 h-10 text-white" />
                    </div>
                    <h2 class="text-xl font-bold text-foreground mb-2">
                        Traktir Developer ☕
                    </h2>
                    <p class="text-sm text-muted-foreground mb-4 leading-relaxed">
                        Halo! 👋 Kalau aplikasi ini membantu kamu mengatur keuangan,
                        mungkin kamu bisa traktir developer secangkir kopi?
                    </p>
                    <div class="bg-muted/30 rounded-xl p-4 mb-4">
                        <p class="text-sm text-foreground italic">
                            "Setiap dukungan kecil itu seperti pelukan hangat buat developer
                            yang begadang bikin fitur baru! 🥹✨"
                        </p>
                    </div>
                    <a href="https://saweria.co/irularifin" target="blank">
                        <button
                            class="w-full bg-gradient-to-r from-pink-500 to-orange-400 hover:from-pink-600 hover:to-orange-500 text-white font-semibold py-3 rounded-2xl shadow-lg transition-all duration-300 hover:scale-[1.02] active:scale-[0.98]">
                            Sawer di Saweria 🎉
                        </button>
                    </a>
                    <p class="text-xs text-muted-foreground mt-3">
                        Tenang, gak dipaksa kok! Tapi kalau mau, kita terima dengan senang hati 😄
                    </p>
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
                <div class="flex justify-around text-center">
                    <div>
                        <p class="text-2xl">☕</p>
                        <p class="text-xs text-muted-foreground">Kopi diminum</p>
                        <p class="text-lg font-bold text-primary">12</p>
                    </div>
                    <div>
                        <p class="text-2xl">🐛</p>
                        <p class="text-xs text-muted-foreground">Bug diperbaiki</p>
                        <p class="text-lg font-bold text-primary">2</p>
                    </div>
                    <div>
                        <p class="text-2xl">💜</p>
                        <p class="text-xs text-muted-foreground">Donatur baik</p>
                        <p class="text-lg font-bold text-primary">15</p>
                    </div>
                </div>
            </div>
        </div>


        <!-- kritik dan saran -->
        <div class="px-4 mt-6 space-y-4">
            <!-- skeleton laoding -->
            <div v-if="loading"
                class="animate-pulse relative overflow-hidden rounded-2xl w-ful h-[300px] mb-3 bg-slate-500/80 p-10">
            </div>
            <div v-else class="bg-white rounded-2xl p-6 shadow-sm space-y-4">
                <!-- Header -->
                <div class="flex items-center gap-2">
                    <div class="w-4 h-4 rounded-full text-purple-700 flex items-center justify-center">
                        <MessageCircle />
                    </div>
                    <h2 class="text-lg font-semibold text-gray-900">
                        Kritik &amp; Saran
                    </h2>
                </div>

                <p class="text-sm text-gray-500 leading-relaxed">
                    Punya ide keren atau nemuin bug yang bikin kesel?
                    Ceritain aja, kita dengerin! 👂
                </p>

                <!-- Input Nama -->
                <input type="text" placeholder="Nama kamu (opsional)" v-model="form.nama_samaran" class="w-full rounded-xl px-4 py-3 bg-[#F6F5FF]
                     text-sm placeholder-gray-400
                     focus:outline-none focus:ring-2 focus:ring-purple-400" />

                <!-- Textarea -->
                <textarea rows="4" v-model="form.description"
                    placeholder="Tulis kritik atau saran kamu di sini... Bebas curhat juga boleh! 😄" class="w-full rounded-xl px-4 py-3 bg-[#F6F5FF]
                     text-sm placeholder-gray-400 resize-none
                     focus:outline-none focus:ring-2 focus:ring-purple-400"></textarea>
                <p v-if="form.errors.description" class="text-red-600">{{ form.errors.description }}</p>

                <!-- Button -->
                <button @click="submit()" class="w-full bg-[#5F42F0] hover:bg-[#5236e6]
                     text-white font-semibold py-3 rounded-full
                     flex items-center justify-center gap-2 transition">
                    <span>♡</span>
                    Kirim Masukan
                </button>
            </div>

            <!-- skeleton laoding -->
            <div v-if="loading"
                class="animate-pulse relative overflow-hidden rounded-2xl w-ful h-[50px] mb-3 bg-slate-500/80 p-10">
            </div>
            <!-- Thank You Card -->
            <div v-else class="bg-[#ebe9f7] rounded-2xl p-4 text-center text-sm text-gray-700">
                Terima kasih sudah menggunakan aplikasi ini! ✨
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
                <Link>
                    <div class="flex flex-col items-center hover:text-purple-700 text-purple-700 ">
                        <Heart />
                        <!-- <span class="text-xs mt-1">Pengaturan</span> -->
                    </div>
                </Link>

                <!-- Profil -->
                <Link @click="loadingPage()" :href="route('myProfile.index')">
                    <div class="flex flex-col items-center hover:text-purple-700  ">
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
