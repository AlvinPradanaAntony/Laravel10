<template>
    <button :type="type" class="inline-flex items-center justify-center px-2 py-2 bg-white border border-black rounded-md font-semibold text-xs text-black uppercase tracking-widest hover:bg-gray-100 active:bg-gray-100 focus:outline-none focus:border-gray-900 focus:ring focus:ring-blue-300 disabled:opacity-25 transition">
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
