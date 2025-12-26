<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { Eye, EyeOff, Lock, Mail, Wallet } from 'lucide-vue-next';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <div class="min-h-screen bg-[#F6F5FB] flex items-start justify-center overflow-hidden">
        <div class="w-full max-w-md">

            <Head title="Log in" />

            <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
                {{ status }}
            </div>
            <!-- Header -->
            <div
                class="bg-gradient-to-br mb-5 from-[#5F42F0] to-indigo-500 rounded-b-[20px] px-6 py-10 text-center text-white shadow-lg">
                <div class="mx-auto mb-4 flex h-20 w-20 items-center justify-center rounded-2xl bg-white/20">
                    <Wallet class="h-8 w-8 text-white" />
                </div>
                <h1 class="text-2xl font-bold">DompetKu</h1>
                <p class="text-sm text-white/80 mt-1">
                    Masuk ke akun Anda
                </p>
            </div>

            <!-- Card -->
            <div class="mt-1 rounded-3xl p-6 pt-1 shadow-xl">
                <!-- Tabs -->
                <div class="flex rounded-full bg-gray-100 p-1 mb-6">
                    <button class="flex-1 rounded-full bg-white py-2 text-sm font-semibold shadow">
                        Log In
                    </button>
                    <button class="flex-1 rounded-full py-2 text-sm text-gray-400">
                        <Link :href="route('register')">
                            Daftar
                        </Link>
                    </button>

                </div>

                <!-- templatea login -->
                <form @submit.prevent="submit">
                    <div>
                        <InputLabel for="email" value="Email" class="text-sm text-gray-500" />
                        <div class="mt-1 flex items-center gap-2 rounded-xl  bg-gray-50 px-4 py-3">
                            <Mail class="h-5 w-5 text-gray-400" />
                            <!-- <input v-model="email" type="email" placeholder="nama@email.com"
                                class="w-full bg-transparent outline-none text-sm" /> -->
                            <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required
                                autofocus autocomplete="username" />
                        </div>
                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>

                    <div class="mb-2">
                        <InputLabel class="text-sm text-gray-500" for="password" value="Password" />
                        <div class="mt-1 flex items-center gap-2 rounded-xl border bg-gray-50 px-4 py-3">
                            <Lock class="h-5 w-5 text-gray-400" />
                            <!-- <input v-model="password" :type="showPassword ? 'text' : 'password'"
                                placeholder="Masukkan password" class="w-full bg-transparent outline-none text-sm" /> -->
                            <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password"
                                required autocomplete="current-password" />
                            <button type="button" @click="togglePassword">
                                <Eye v-if="!showPassword" class="h-5 w-5 text-gray-400" />
                                <EyeOff v-else class="h-5 w-5 text-gray-400" />
                            </button>
                            <InputError class="mt-2" :message="form.errors.password" />
                        </div>
                    </div>

                    <div class="mt-4 block">
                        <label class="flex items-center">
                            <Checkbox name="remember" v-model:checked="form.remember" />
                            <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">Remember me</span>
                        </label>
                    </div>

                    <div class="text-right mb-6">
                        <!-- <a href="#" class="text-sm text-purple-600 hover:underline">
                            Lupa Password?
                        </a> -->
                        <div class="mt-4 flex items-center justify-end">
                            <Link v-if="canResetPassword" :href="route('register')"
                                class="rounded-md underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-gray-400 dark:hover:text-gray-100 dark:focus:ring-offset-gray-800 text-sm text-purple-600 hover:underline">
                                Register
                            </Link>
                        </div>
                    </div>

                    <!-- Button -->

                    <PrimaryButton
                        class="flex w-full items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-purple-600 to-indigo-500 py-3 text-white font-semibold shadow-lg hover:opacity-90 transition"
                        :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        {{ form.processing ? 'Masuk....' : 'Log In' }}
                        <div v-if="form.processing">
                        </div>
                        <span v-else class="text-lg text-white">→</span>
                    </PrimaryButton>
                </form>
            </div>
        </div>
    </div>
    <!--  -->
</template>
