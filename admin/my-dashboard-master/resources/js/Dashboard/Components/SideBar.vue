<template>
    <div class="sidebar h-full fixed top-0 left-0 w-56 text-center hover:overflow-y-auto bg-gray-800 dark:bg-gray-850 invisible lg:visible" id="sidebar">
        <side-bar-brand :homeRouteName="props.homeRouteName"/>
        <slot />
    </div>
</template>

<script setup>
    import SideBarBrand from '@/Dashboard/Components/SideBarBrand.vue'
    import { computed, watch } from 'vue'
    import { useMainStore } from '@/Stores/Main'

    const mainStore = useMainStore()

    const sideBarVisibilityMobile = computed(() => mainStore.sideBarVisibilityMobile)

    const props = defineProps({
        homeRouteName: {
            required: true,
            type: String
        }
    })

    watch(sideBarVisibilityMobile, () => {
        var el = document.getElementById('sidebar')

        if(sideBarVisibilityMobile.value){
            el.classList.remove('invisible')
            el.classList.add('visible')
        }
        else{
            el.classList.remove('visible')
            el.classList.add('invisible')
        }
    })
</script>
