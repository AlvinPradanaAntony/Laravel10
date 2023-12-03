<template>
    <button :type="type" class="inline-flex items-center justify-center px-2 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-700 focus:outline-none disabled:opacity-25 transition">
        <slot />
    </button>
</template>

<script setup>
    const props = defineProps({
        type: {
            type: String,
            default: 'button',
        },
    })
</script>
