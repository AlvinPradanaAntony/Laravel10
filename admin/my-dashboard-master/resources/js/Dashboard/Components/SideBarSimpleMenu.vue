<template>
    <div class="py-2.5 px-4 flex items-center duration-300 cursor-pointer hover:bg-blue-700 gap-2" :class="textColor" @click="action">
        <div class="w-9 flex items-center justify-center overflow-hidden">
            <i v-if="icon" :class="icon"></i>
        </div>
        <div class="w-full flex items-center overflow-hidden">
            <span class="font-semibold text-sm">{{label}}</span>
        </div>
        <div class="w-9 flex items-center justify-center overflow-hidden">
            <!-- Secondary Icon -->
        </div>
    </div>
</template>

<script setup>
    import { Inertia } from '@inertiajs/inertia';

    const props = defineProps({
        icon: {
            default:    '',
            type:       String
        },

        label: {
            type:       String,
            required:   true
        },

        textColor: {
            default:    'text-white',
            type:       String
        },

        routeName: {
            required:   true,
            type:       String
        },
    })

    function action(){
        Inertia.get(route(props.routeName))
    }
</script>
