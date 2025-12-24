<script setup>
import {
    User,
    Mail,
    Phone,
    MapPin,
    Bell,
    Shield,
    CreditCard,
    HelpCircle,
    ChevronRight
} from 'lucide-vue-next'

const props = defineProps({
    icon: String,
    title: String,
    value: String
})

const icons = {
    User,
    Mail,
    Phone,
    MapPin,
    Bell,
    Shield,
    CreditCard,
    HelpCircle
}
</script>

<template>
    <div class="flex items-center justify-between py-3 border-b last:border-b-0">
        <div class="flex items-center gap-3">
            <div class="p-2 rounded-full  ungu-sesuai color-ungu-sesuai">
                <component :is="icons[icon]" size="18" />
            </div>
            <div>
                <p class="text-sm font-medium">{{ title }}</p>
                <p v-if="value" class="text-xs text-gray-500">{{ value }}</p>
            </div>
        </div>
        <ChevronRight class="text-gray-400" size="18" />
    </div>
</template>

<style scoped>
.ungu-sesuai {
    background-color: #e4deff;
}

.color-ungu-sesuai {
    color: #5F42F0;
}
</style>
