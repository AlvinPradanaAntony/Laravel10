<template>
    <div class="w-full h-full flex items-center justify-center text-left relative px-5">
        <div @click.prevent="toggle">
            <slot name="trigger" />
        </div>


        <div v-if="isOpen" class="absolute origin-top-right top-14 right-0 w-screen md:w-52 lg:w-52 rounded-md shadow-lg">
            <div class="w-full bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600">
                <!-- Header -->
                <div class="px-3 py-2 font-semibold text-center text-sm text-gray-900 dark:text-white">
                    <slot name="header" />
                </div>

                <!-- Body -->
                <div>
                    <slot name="content" />
                </div>


                <!-- footer -->
                <div>
                    <slot name="footer" />
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
    import { ref } from 'vue'

    const isOpen = ref(false)

    const props = defineProps({
        title: {
            default: 'Titulo',
            type: String
        }
    })

    function toggle(){
        isOpen.value = !isOpen.value
    }
</script>
