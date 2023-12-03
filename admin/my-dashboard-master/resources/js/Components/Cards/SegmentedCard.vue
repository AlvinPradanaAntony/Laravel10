<template>
    <card>
        <!-- title -->
        <h5 class="mb-4 text-xl text-center font-light">
            <h5 class="text-gray-900 dark:text-white">{{title}}</h5>
        </h5>

        <!-- content -->
        <div class="mb-6 text-gray-900 dark:text-white">
            <slot name="content" />
        </div>

        <!-- action -->
        <div class="flex justify-center">
            <slot name="action" />
        </div>
    </card>
</template>

<script setup>
    import Card from '@/Components/Cards/Card.vue';

    const props = defineProps({
        title: {
            required:   true,
            type:       String
        }
    })
</script>
