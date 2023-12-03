<script setup>
import { ref } from 'vue';
import { usePage, Link } from '@inertiajs/vue3';
import { computed } from 'vue';

import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import SidebarLink from '@/Components/partials/SidebarLink.vue';
import { baseComposablesState, useScreenWidthChecker, useToggleSidebar } from '@/Composables/baseComposables.js';

defineProps({
    list: {
        type: Object,
    },
});
function widthResizer(){
  var width = window.innerWidth
    console.log(width)
    console.log(useScreenWidthChecker('sm'));
}
window.addEventListener('resize', widthResizer);
const page = usePage();
const menus = computed(() => page.props.menu);

</script>

<template>
  <!-- Sidebar -->
  <div class="inset-0 flex z-50 h-full">
      <!-- Fixed and Flex frame for Sidebar and Dimmer  -->

      <!-- Absolute Frame for Sidebar Content and Drawer    -->
      <div class="flex flex-row-reverse top-0">

      <!-- Sidebar Content -->
        <div
            class="fixed z-50 top-0 pt-6 h-screen bg-slate-300 overflow-hidden transition-color w-0 sm:w-56"
            :class="baseComposablesState.isShowSidebar && useScreenWidthChecker('sm') ? 'w-4/5 left-auto right-0 duration-300' : 'left-0 right-auto duration-500'"
        >
                <div class="top-4 right-6" :class="useScreenWidthChecker('sm') ? 'absolute' : 'hidden'">
                    <button
                        @click="useToggleSidebar()"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400"
                    >
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"
                            />
                        </svg>
                    </button>

                </div>
                <!-- Logo -->
                <div class="w-full flex justify-center">
                    <Link :href="route('dashboard')">
                        <ApplicationLogo
                            class="h-16 w-auto fill-current text-gray-800"
                            :class="!baseComposablesState.isShowSidebar && useScreenWidthChecker('sm') ? 'hidden' : 'block'"
                        />
                    </Link>
                </div>
                <div class="pt-6">
                    <div v-for="(menu, i) in menus" :key="i" class="space-x-8 sm:mx-6 sm:flex" :class="baseComposablesState.isShowSidebar && useScreenWidthChecker('sm') ? 'flex mx-4' : 'hidden' " >
                        <template v-if="!menu.parent" >
                            <div class="mb-2 w-full">
                                    <SidebarLink :href="menu.route ? route(menu.route) : ''" :active="route().current(menu.route) ? true : false" :hover="true">
                                        {{ menu.name }}
                                    </SidebarLink>
                            </div>
                        </template>
                        <template v-else>
                            <li class="w-full pb-1 my-0 ml-5 pl-2 border-l-2 border-l-gray-200">
                                <SidebarLink :href="route(menu.route)" :active="route().current(menu.route)" :hover="true">
                                    {{ menu.name }}
                                </SidebarLink>
                            </li>
                        </template>
                    </div>
                </div>
        </div>
      </div>

      <!-- Fluid Dimmer background filling empty space -->
      <!-- <div class="flex-1 bg-gray-400 bg-opacity-75" /> -->
  </div>
</template>
<style>
li::marker {
    color: lightgray;
}
</style>

