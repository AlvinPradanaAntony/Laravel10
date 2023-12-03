<template>
    <button class="w-full h-full flex items-center justify-center text-gray-900 hover:text-blue-700 dark:text-white dark:hover:text-blue-700" @click="action">
        <i class="fa-solid fa-circle-half-stroke"></i>
    </button>
</template>

<script setup>
    const emit = defineEmits(['action'])

    function action(){
        emit('action')
    }
</script>
