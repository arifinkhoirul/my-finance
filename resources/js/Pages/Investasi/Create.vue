<script setup>
import { ArrowLeft, TrendingUp, Calendar, FileText, Tag, DollarSign, ChartCandlestick } from "lucide-vue-next";
import Datepicker from "vue3-datepicker"
import { ref } from "vue";
import { useForm, Link, usePage } from "@inertiajs/vue3";


const page = usePage()

const categories = [
    { id: 4, label: "Saham", icon: "📊" },
    { id: 11, label: "Crypto", icon: "₿" },
    { id: 12, label: "Reksadana", icon: "📈" },
    { id: 13, label: "Emas", icon: "🪙" },
    { id: 14, label: "Properti", icon: "🏠" },
    { id: 10, label: "Lainnya", icon: "📦" },
];

const form = useForm({
    amount: null,
    category_id: null,
    date: null,
    description: null,
    wallet_id: 3,
    user_id: page.props.user.id,
    type: 'investment',

})

function submit() {
    form.post(route('investasi.store'))
}



const loading = ref(false)

function goBack() {
    loading.value = true
}
</script>


<template>
    <!-- LOADING OVERLAY -->
    <transition name="fade">
        <div v-if="loading" class="fixed inset-0 z-50 flex items-center justify-center bg-black/30 backdrop-blur-sm">
            <div class="loader"></div>
        </div>
    </transition>
    <div class="min-h-screen bg-background pb-8">
        <div class="sticky top-0 z-40 bg-background/50 backdrop-blur-lg border-b border-border">
            <div class="mx-auto max-w-lg px-4 py-4">
                <div class="flex items-center gap-4 ">
                    <Link :href="route('financial.dashboard')" @click="goBack()">
                        <button class="bg-white shadow p-3 rounded-xl">
                            <ArrowLeft class="h-5 w-5 text-foreground" />
                        </button>
                    </Link>
                    <div class="flex items-center gap-3">
                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-purple-500 to-purple-600 shadow-md">
                            <ChartCandlestick class="h-5 w-5 text-white" />
                        </div>
                        <div>
                            <h1 class="text-lg font-bold text-foreground">Tambah Investasi</h1>
                            <p class="text-xs text-slate-500">Catat investasi Anda</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <form @submit.prevent="submit" class="mx-auto max-w-lg px-4 pt-6 space-y-6">
            <div class="space-y-2">
                <label htmlFor="amount" class="text-sm font-medium text-foreground flex items-center gap-2">
                    <DollarSign class="h-4 w-4 text-purple-500" />
                    Jumlah
                </label>
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-lg font-semibold text-muted-foreground">
                        Rp
                    </span>
                    <input id="amount" name="amount" v-model="form.amount" type="number" placeholder="0"
                        class="pl-12 h-14 text-2xl w-full font-bold border-2 border-border focus:border-purple-500 rounded-xl bg-card" />
                </div>
                <p v-if="form.errors.amount" class="text-red-500">{{ form.errors.amount }}</p>
            </div>

            <div class="space-y-3">
                <label class="text-sm font-medium text-foreground flex items-center gap-2">
                    <Tag class="h-4 w-4 text-purple-500" />
                    Kategori
                </label>
                <div class="grid grid-cols-3 gap-2">
                    <button type="button" v-for="category in categories" :key="category.id"
                        @click="form.category_id = category.id" :class="[
                            'flex flex-col items-center gap-2 p-4 rounded-xl border-2 transition-all duration-200',
                            form.category_id == category.id
                                ? 'border-purple-500 bg-purple-500/10'
                                : 'border-border hover:border-purple-500 hover:bg-purple-500/10'
                        ]">
                        <span class="text-2xl">{{ category.icon }}</span>
                        <span>{{ category.label }}</span>
                    </button>
                    <p v-if="form.errors.category_id" class="text-red-500">{{ form.errors.category_id }}</p>
                </div>
            </div>

            <div class="space-y-2">
                <label htmlFor="tanggal" class="text-sm font-medium text-foreground flex items-center gap-2">
                    <Calendar class="h-4 w-4 text-purple-500" />
                    Tanggal
                </label>
                <!-- <Datepicker v-model="date" format="DD MMM YYYY" /> -->
                <Datepicker v-model="form.date" format="yyyy-MM-dd" placeholder="Pilih tanggal"
                    class="w-full rounded-xl border-2 border-border focus:border-purple-500" />
                <p v-if="form.errors.date" class="text-red-500">{{ form.errors.date }}</p>
            </div>

            <div class="space-y-2">
                <label htmlFor="description" class="text-sm font-medium text-foreground flex items-center gap-2">
                    <FileText class="h-4 w-4 text-purple-500" />
                    Catatan
                </label>
                <textarea name="description" id="description" placeholder="Tambahkan catatan..."
                    v-model="form.description"
                    class="min-h-[100px] border-2 w-full border-border focus:border-purple-500 rounded-xl bg-card resize-none"></textarea>
                <p v-if="form.errors.description" class="text-red-500">{{ form.errors.description }}</p>
            </div>


            <button type="submit"
                class="w-full hover:text-white h-14 text-lg font-semibold rounded-xl bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 shadow-lg shadow-purple-500/30 transition-all duration-200 hover:shadow-xl hover:shadow-purple-500/40">
                {{ form.processing ? 'Menyimpan..' : 'Simpan Pemasukan' }}
            </button>
        </form>
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
