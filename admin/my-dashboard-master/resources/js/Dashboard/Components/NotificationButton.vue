<template>
    <button class="w-full h-full font-thin hover:text-blue-700 flex items-center justify-center dark:text-white dark:hover:text-blue-700" @click="action">
        <i class="far fa-bell"></i>
        <span v-if="hasNotification" class="relative flex h-2 w-2 -top-1.5 -left-1">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-600 opacity-75"></span>
            <span class="relative inline-flex rounded-full h-2 w-2 bg-red-600"></span>
        </span>
    </button>
</template>

<script setup>
    import { computed, onMounted } from 'vue'
    import { useMainStore } from '@/Stores/Main'
    import axios from 'axios';

    onMounted(() => {
        check()
    })

    const mainStore = useMainStore()

    const hasNotification = computed(() => mainStore.hasNotification)

    const emit = defineEmits(['action'])

    function check() {
        // axios.get(route('notifications-route'))
        //     .then(response => {
        //         let has = response.data.length > 0 ? true : false

        //         mainStore.setHasNotification(has)
        //     })
    }

    function action() {
        emit('action');
    }
</script>
