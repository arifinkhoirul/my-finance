<template>
    <div class="bg-white rounded-2xl p-4 shadow">
        <p class="text-sm text-gray-500">{{ title }}</p>
        <h2 class="text-xl font-bold">{{ value }}</h2>
        <p v-if="growth" class="text-green-500 text-sm">{{ growth }}</p>
    </div>
</template>

<script setup>
defineProps({
    title: String,
    value: String,
    growth: String
})
</script>
