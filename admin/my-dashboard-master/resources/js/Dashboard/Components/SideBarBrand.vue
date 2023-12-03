<template>
    <div class="h-14 py-2.5 px-5 bg-gray-900 text-white flex items-center">
        <div class="w-full flex items-center justify-center">
            <i class="fa-solid fa-desktop mr-3"></i>
            <h1 class="font-extrabold cursor-pointer" @click="home">{{label}}</h1>
        </div>

        <div class="w-full flex justify-end lg:hidden">
            <side-bar-brand-hide-button />
        </div>
    </div>
</template>

<script setup>
    import SideBarBrandHideButton from '@/Dashboard/Components/SideBarBrandHideButton.vue'
    import { Inertia } from '@inertiajs/inertia';

    const props = defineProps({
        homeRouteName: {
            default:    'dashboard',
            type:       String,
        },

        label: {
            default:    'MyDashboard',
            type:       String,
        }
    })

    function home(){
        Inertia.get(route(props.homeRouteName))
    }
</script>
