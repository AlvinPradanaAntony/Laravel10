<template>
  <footer class="w-full p-4 bg-white text-gray-900 dark:bg-gray-900 dark:lg:border-l dark:lg:border-gray-800 dark:text-white">
    <div class="text-sm text-center md:text-left">
        <b>&copy; {{ year }}, Company.</b>
    </div>
  </footer>
</template>

<script setup>
    import { computed } from 'vue'

    const year = computed(() => new Date().getFullYear())
</script>
