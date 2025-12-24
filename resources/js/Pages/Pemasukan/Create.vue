<script setup>
import { ArrowLeft, TrendingUp, Calendar, FileText, Tag, DollarSign } from "lucide-vue-next";
import Datepicker from "vue3-datepicker"
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";
// import { VueDatePicker } from '@vuepic/vue-datepicker'
// import '@vuepic/vue-datepicker/dist/main.css'

// const date = ref(null);

const categories = [
    { id: 1, label: "Gaji", icon: "💼" },
    { id: 6, label: "Freelance", icon: "💻" },
    { id: 7, label: "Hasil Investasi", icon: "📈" },
    { id: 8, label: "Hadiah", icon: "🎁" },
    { id: 9, label: "Bonus", icon: "🏆" },
    { id: 10, label: "Lainnya", icon: "📦" },
];

const form = useForm({
    amount: null,
    category_id: null,
    date: null,
    description: null,
    wallet_id: 1,
    user_id: 1,
    type: 'income',
})

function submit() {
    form.post(route('pemasukan.store'))
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
                            class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-emerald-500 to-green-600 shadow-md">
                            <TrendingUp class="h-5 w-5 text-white" />
                        </div>
                        <div>
                            <h1 class="text-lg font-bold text-foreground">Tambah Pemasukan</h1>
                            <p class="text-xs text-slate-500">Catat investasi Anda</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <form @submit.prevent="submit" class="mx-auto max-w-lg px-4 pt-6 space-y-6">
            <div class="space-y-2">
                <Label htmlFor="amount" class="text-sm font-medium text-foreground flex items-center gap-2">
                    <DollarSign class="h-4 w-4 text-emerald-500" />
                    Jumlah
                </Label>
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-lg font-semibold text-muted-foreground">
                        Rp
                    </span>
                    <input id="amount" name="amount" v-model="form.amount" type="number" placeholder="0"
                        class="pl-12 h-14 text-2xl w-full font-bold border-2 border-border focus:border-emerald-500 rounded-xl bg-card" />
                </div>
                <p v-if="form.errors.amount" class="text-red-500">{{ form.errors.amount }}</p>
            </div>

            <div class="space-y-3">
                <Label class="text-sm font-medium text-foreground flex items-center gap-2">
                    <Tag class="h-4 w-4 text-emerald-500" />
                    Kategori
                </Label>
                <div class="grid grid-cols-3 gap-2">
                    <button type="button" v-for="category in categories" :key="category.id"
                        @click="form.category_id = category.id" :class="[
                            'flex flex-col items-center gap-2 p-4 rounded-xl border-2 transition-all duration-200',
                            form.category_id == category.id
                                ? 'border-emerald-500 bg-emerald-500/10'
                                : 'border-border hover:border-emerald-500 hover:bg-emerald-500/10'
                        ]">
                        <span class="text-2xl">{{ category.icon }}</span>
                        <span>{{ category.label }}</span>
                    </button>
                    <p v-if="form.errors.category_id" class="text-red-500">{{ form.errors.category_id }}</p>
                </div>
            </div>

            <div class="space-y-2">
                <Label htmlFor="tanggal" class="text-sm font-medium text-foreground flex items-center gap-2">
                    <Calendar class="h-4 w-4 text-emerald-500" />
                    Tanggal
                </Label>
                <!-- <Datepicker v-model="date" format="DD MMM YYYY" /> -->
                <Datepicker v-model="form.date" format="yyyy-MM-dd" placeholder="Pilih tanggal"
                    class="w-full rounded-xl border-2 border-border focus:border-emerald-500" />
                <p v-if="form.errors.date" class="text-red-500">{{ form.errors.date }}</p>
            </div>

            <div class="space-y-2">
                <Label htmlFor="description" class="text-sm font-medium text-foreground flex items-center gap-2">
                    <FileText class="h-4 w-4 text-emerald-500" />
                    Catatan
                </Label>
                <textarea name="description" id="description" placeholder="Tambahkan catatan..."
                    v-model="form.description"
                    class="min-h-[100px] border-2 w-full border-border focus:border-emerald-500 rounded-xl bg-card resize-none"></textarea>
                <p v-if="form.errors.description" class="text-red-500">{{ form.errors.description }}</p>
            </div>


            <Button type="submit"
                class="w-full hover:text-white h-14 text-lg font-semibold rounded-xl bg-gradient-to-r from-emerald-500 to-green-600 hover:from-emerald-600 hover:to-green-700 shadow-lg shadow-emerald-500/30 transition-all duration-200 hover:shadow-xl hover:shadow-emerald-500/40">
                {{ form.processing ? 'Menyimpan..' : 'Simpan Pemasukan' }}
            </Button>
        </form>
    </div>
</template>


<style></style>
