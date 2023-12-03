<template>
    <div class="w-full h-full mb-4 bg-blue-600 overflow-hidden shadow-xl sm:rounded-lg flex hover:cursor-pointer" @click="clickEvent">
        <div class="w-1/3 h-full border-r border-blue-700 text-white flex items-center justify-center">
            <i :class="icon"></i>
        </div>
        <div class="w-2/3 h-full">
            <div :class="summaryFontSize" class="w-full h-2/3 font-bold text-white bg-blue-500 border-r border-blue-700 px-4 flex items-center">{{summary}}</div>
            <div class="w-full h-1/3 text-md text-white px-4 flex items-center">{{label}}</div>
        </div>
    </div>
</template>

<script>
    export default {
        methods: {
            clickEvent(){
                this.$emit('clickEvent')
            }
        },
        props: {
            icon: {
                required:   true,
                type:       String,
            },
            label: {
                required:   true,
                type:       String,
            },
            summary: {
                required:   true,
            },
            summaryFontSize: {
                required:   true,
                type:       String,
            }
        },
    }
</script>
