<script setup>
import { ArrowLeft, TrendingUp, Calendar, FileText, Tag, DollarSign, ChartCandlestick } from "lucide-vue-next";
import Datepicker from "vue3-datepicker"
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";
// import { VueDatePicker } from '@vuepic/vue-datepicker'
// import '@vuepic/vue-datepicker/dist/main.css'

// const date = ref(null);


const categories = [
    { id: 15, label: "Belanja", icon: "🛍️" },
    { id: 16, label: "Liburan", icon: "✈️" },
    { id: 17, label: "Kuliner", icon: "🍽️" },
    { id: 18, label: "Hiburan", icon: "🎬" },
    { id: 19, label: "Hobi", icon: "🎨" },
    { id: 10, label: "Lainnya", icon: "📦" },
];


const form = useForm({
    amount: null,
    category_id: null,
    date: null,
    description: null,
    wallet_id: 4,
    user_id: 1,
    type: 'self-reward',

})

function submit() {
    form.post(route('self.reward.store'))
}

</script>


<template>
    <div class="min-h-screen bg-background pb-8">
        <div class="sticky top-0 z-40 bg-background/50 backdrop-blur-lg border-b border-border">
            <div class="mx-auto max-w-lg px-4 py-4">
                <div class="flex items-center gap-4 ">
                    <a :href="route('financial.dashboard')">
                        <button class="bg-white shadow p-3 rounded-xl">
                            <ArrowLeft class="h-5 w-5 text-foreground" />
                        </button>
                    </a>
                    <div class="flex items-center gap-3">
                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-yellow-300 to-yellow-500 shadow-md">
                            <ChartCandlestick class="h-5 w-5 text-white" />
                        </div>
                        <div>
                            <h1 class="text-lg font-bold text-foreground">Tambah Self Reward</h1>
                            <p class="text-xs text-slate-500">Catat self reward Anda</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <form @submit.prevent="submit" class="mx-auto max-w-lg px-4 pt-6 space-y-6">
            <div class="space-y-2">
                <Label htmlFor="amount" class="text-sm font-medium text-foreground flex items-center gap-2">
                    <DollarSign class="h-4 w-4 text-yellow-500" />
                    Jumlah
                </Label>
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-lg font-semibold text-muted-foreground">
                        Rp
                    </span>
                    <input id="amount" name="amount" v-model="form.amount" type="number" placeholder="0"
                        class="pl-12 h-14 text-2xl w-full font-bold border-2 border-border focus:border-yellow-500 rounded-xl bg-card" />
                </div>
                <p v-if="form.errors.amount" class="text-red-500">{{ form.errors.amount }}</p>
            </div>

            <div class="space-y-3">
                <Label class="text-sm font-medium text-foreground flex items-center gap-2">
                    <Tag class="h-4 w-4 text-yellow-500" />
                    Kategori
                </Label>
                <div class="grid grid-cols-3 gap-2">
                    <button type="button" v-for="category in categories" :key="category.id"
                        @click="form.category_id = category.id" :class="[
                            'flex flex-col items-center gap-2 p-4 rounded-xl border-2 transition-all duration-200',
                            form.category_id == category.id
                                ? 'border-yellow-500 bg-yellow-500/10'
                                : 'border-border hover:border-yellow-500 hover:bg-yellow-500/10'
                        ]">
                        <span class="text-2xl">{{ category.icon }}</span>
                        <span>{{ category.label }}</span>
                    </button>
                    <p v-if="form.errors.category_id" class="text-red-500">{{ form.errors.category_id }}</p>
                </div>
            </div>

            <div class="space-y-2">
                <Label htmlFor="tanggal" class="text-sm font-medium text-foreground flex items-center gap-2">
                    <Calendar class="h-4 w-4 text-yellow-500" />
                    Tanggal
                </Label>
                <!-- <Datepicker v-model="date" format="DD MMM YYYY" /> -->
                <Datepicker v-model="form.date" format="yyyy-MM-dd" placeholder="Pilih tanggal"
                    class="w-full rounded-xl border-2 border-border focus:border-yellow-500" />
                <p v-if="form.errors.date" class="text-red-500">{{ form.errors.date }}</p>
            </div>

            <div class="space-y-2">
                <Label htmlFor="description" class="text-sm font-medium text-foreground flex items-center gap-2">
                    <FileText class="h-4 w-4 text-yellow-500" />
                    Catatan
                </Label>
                <textarea name="description" id="description" placeholder="Tambahkan catatan..."
                    v-model="form.description"
                    class="min-h-[100px] border-2 w-full border-border focus:border-yellow-500 rounded-xl bg-card resize-none"></textarea>
                <p v-if="form.errors.description" class="text-red-500">{{ form.errors.description }}</p>
            </div>


            <Button type="submit"
                class="w-full hover:text-white h-14 text-lg font-semibold rounded-xl bg-gradient-to-r from-yellow-500 to-yellow-600 hover:from-yellow-600 hover:to-yellow-700 shadow-lg shadow-yellow-500/30 transition-all duration-200 hover:shadow-xl hover:shadow-yellow-500/40">
                {{ form.processing ? 'Menyimpan..' : 'Simpan Pemasukan' }}
            </Button>
        </form>
    </div>
</template>


<style></style>
