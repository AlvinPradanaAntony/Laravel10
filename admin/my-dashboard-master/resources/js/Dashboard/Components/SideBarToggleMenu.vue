<template>
    <div class="py-2.5 px-4 flex items-center duration-300 cursor-pointer hover:bg-blue-700 gap-2" :class="textColor" @click="toggle">
        <div class="w-9 flex items-center justify-center overflow-hidden">
            <i v-if="icon" :class="icon"></i>
        </div>
        <div class="w-full flex items-center overflow-hidden">
            <span class="font-semibold text-sm text-gray-200">{{label}}</span>
        </div>
        <div class="w-9 flex items-center justify-center overflow-hidden">
            <i class="fa-solid fa-chevron-down text-gray-200" id="icon"></i>
        </div>
    </div>

    <div v-if="submenuVisibility" class="bg-gray-700 dark:bg-gray-750 text-left text-sm font-thin" :class="textColor" id="submenu">
        <ul>
            <li v-for="(submenu, index) in submenuList" :key="index" class="flex items-center text-xs font-normal cursor-pointer py-1.5 pl-8 pr-4 hover:bg-gray-600" :class="[submenuVisibility ? 'hover:border-l-2 hover:border-blue-700' : '']" @click="action(submenu.routeName)">
                <div class="w-11 flex justify-center">
                    <i v-if="submenu.icon" :class="submenu.icon"></i>
                </div>

                <div class="w-full">
                    {{submenu.label}}
                </div>
            </li>
        </ul>
    </div>
</template>

<script setup>
    import { Inertia } from '@inertiajs/inertia';
    import { ref } from 'vue';

    const submenuVisibility = ref(false)

    const props = defineProps({
        icon: {
            default:    '',
            type:       String,
        },

        label: {
            required:   true,
            type:       String,
        },

        submenuList: {
            required:   true,
            type:       Array,
        },

        textColor: {
            default:    'text-white',
            type:       String,
        },
    })

    function action(routeName){
        if(routeName){
            Inertia.get(route(routeName))
        }
    }

    function toggle(){
        submenuVisibility.value = !submenuVisibility.value
    }
</script>
