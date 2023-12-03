<template>
    <div class="overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-center text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-white uppercase bg-gray-900 dark:bg-gray-800 dark:text-gray-400">
                <slot name="headers" />
            </thead>
            <tbody>
                <slot name="rows" />
            </tbody>
        </table>
    </div>
</template>

<script setup>

</script>
