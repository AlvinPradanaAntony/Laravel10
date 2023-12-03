<template>
    <nav class="flex" aria-label="Breadcrumb">
        <ol class="flex flex-wrap items-center space-x-2 justify-center">
            <li class="flex items-center">
                <span v-if="pages.length > 0" class="flex items-center text-gray-700 hover:text-gray-900 hover:cursor-pointer dark:text-gray-400 dark:hover:text-white" @click="go(main.route)"><i class="mb-1" :class="main.icon"></i></span>
                <div v-else class="text-gray-400 dark:text-gray-500">
                    <i :class="main.icon"></i>
                </div>
            </li>

            <li class="flex items-center space-x-2" v-for="(page, index) in pages" :key="index">
                <span>/</span>
                <span v-if="index + 1 < pages.length" class="flex items-center text-gray-700 hover:text-gray-900 hover:cursor-pointer dark:text-gray-400 dark:hover:text-white" @click="go(page.route, page.param)">{{page.name}}</span>
                <span v-else class="text-gray-400 dark:text-gray-500">{{page.name}}</span>
            </li>
        </ol>
    </nav>
</template>

<script setup>
    import { Inertia } from '@inertiajs/inertia';

    const props = defineProps({
        main: {
            required:   true,
            type:       Object,
            default:    {
                name:   '',
                route:  '',
                icon:   '',
            }
        },

        pages: {
            required:   true,
            type:       Array,
            default:    []
        }
    })

    function go(routeName, param = null){
        if(param)
            Inertia.get(route(routeName, param))
        else{
            Inertia.get(route(routeName))
        }
    }
</script>
