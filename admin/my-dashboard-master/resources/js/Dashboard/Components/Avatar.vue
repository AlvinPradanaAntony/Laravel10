<template>
    <div class="flex items-center space-x-1.5 text-gray-900 text-sm cursor-pointer hover:text-blue-700 dark:text-white dark:hover:text-blue-700" @click="toggle">
        <img v-if="user.image_path" class="w-6 h-6 rounded-full overflow-hidden" :src="'/storage/'+user.image_path" alt="">
        <i v-else class="w-6 h-6 fa-solid fa-circle-user"></i>
        <div class="space-y-1 hidden lg:block">
            <div>{{user.name}}</div>
        </div>
        <i class="fa-solid fa-sort-down mb-2"></i>
    </div>
</template>

<script setup>
    import { usePage } from '@inertiajs/inertia-vue3';
    import { computed } from 'vue';

    const user = computed(() => {
        return usePage().props.value.user
    })
</script>
