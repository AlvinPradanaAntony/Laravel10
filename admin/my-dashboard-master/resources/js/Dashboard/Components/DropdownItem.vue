<template>
    <div class="flex items-center text-xs text-gray-700 dark:text-gray-200 px-3 py-2 cursor-pointer hover:bg-gray-100 hover:text-blue-700 dark:hover:text-blue-700" @click="action">
        <i class="mr-3" :class="icon"></i>
        <p class="block">{{label}}</p>
    </div>
</template>

<script setup>
    const emit = defineEmits(['action'])

    const props = defineProps({
        icon: {
            default:    '',
            type:       String
        },

        label: {
            default:    'Item',
            type:       String
        }
    })

    function action(){
        emit('action')
    }
</script>
