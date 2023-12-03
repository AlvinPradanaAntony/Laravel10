<template>
    <div class="h-screen bg-gray-100 dark:bg-gray-800">
        <Head :title="title" />

        <div class="h-full lg:grid lg:grid-cols-12">
            <div class="lg:col-span-2">
                <side-bar homeRouteName="dashboard">
                    <side-bar-simple-menu icon="fa-solid fa-house-chimney" label="Home" routeName="dashboard" />

                    <side-bar-toggle-menu icon="fa-solid fa-flag" label="Lista" :submenuList="submenu" />
                </side-bar>
            </div>

            <div class="lg:col-span-10">
                <nav-bar profileRouteName="profile"  logoutRouteName="logout" />

                <div class="h-auto bg-gray-100 dark:bg-gray-800 p-2 font-light text-xs lg:text-sm flex items-center justify-center lg:justify-start overflow-hidden">
                    <slot name="breadcrumb" />
                </div>

                <div class=" h-12 p-4 font-semibold md:text-lg lg:text-xl flex items-center justify-center lg:justify-start overflow-hidden bg-white tex-gray-900 dark:lg:border-l dark:lg:border-gray-800 dark:bg-gray-900 dark:text-white">
                    <slot name="label" />
                </div>

                <div class="bg-gray-100 dark:bg-gray-800 mt-4 md:px-4 lg:px-4">
                    <slot name="content" />
                </div>

                <div class="overflow-hidden">
                    <slot name="footer" />
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
    import { Head } from '@inertiajs/inertia-vue3';
    import SideBar from '@/Dashboard/Components/SideBar.vue'
    import SideBarSimpleMenu from '@/Dashboard/Components/SideBarSimpleMenu.vue'
    import SideBarToggleMenu from '@/Dashboard/Components/SideBarToggleMenu.vue'
    import NavBar from '@/Dashboard/Components/NavBar.vue'

    const submenu = [
        {
            icon:       'fa-solid fa-flag',
            label:      'Item 1',
            routeName:  ''
        },
        {
            icon:       'fa-solid fa-flag',
            label:      'Item 2',
            routeName:  ''
        }
    ]

    const props = defineProps({
        title: {
            required:   true,
            type:       String,
        },
    })
</script>
