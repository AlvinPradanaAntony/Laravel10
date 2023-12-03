<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
    },
    hover: {
        type: Boolean,
        default: false
    }
});

const classes = computed(() =>
    props.active
        ? 'inline-flex items-center px-4 py-1 w-full text-sm font-medium leading-5 bg-primary text-white rounded-md focus:border-indigo-700 transition duration-150 ease-in-out'
        : `inline-flex items-center px-4 py-1 w-full text-sm font-medium leading-5 text-gray-500 transition duration-150 ease-in-out ${props.hover ? 'hover:text-primary hover:bg-gray-200/50 rounded-md' : ''}`
);

</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
