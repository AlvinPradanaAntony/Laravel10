<template>
    <button @click="hideSideBar" class="text-gray-200"><i class="fa-solid fa-xmark"></i></button>
</template>

<script setup>
    import { useMainStore } from '@/Stores/Main'

    const mainStore = useMainStore()

    function hideSideBar(){
        mainStore.changeSideBarVisibilityMobile()
    }
</script>
