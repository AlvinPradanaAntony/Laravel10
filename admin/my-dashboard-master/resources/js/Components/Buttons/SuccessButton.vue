<template>
    <button :type="type" class="inline-flex items-center justify-center px-2 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-700 focus:outline-none disabled:opacity-25 transition" @click="action">
        <slot />
    </button>
</template>

<script setup>
    const emit = defineEmits(['action'])

    const props = defineProps({
        type: {
            type: String,
            default: 'button',
        },
    })

    function action(){
        emit('action')
    }
</script>
