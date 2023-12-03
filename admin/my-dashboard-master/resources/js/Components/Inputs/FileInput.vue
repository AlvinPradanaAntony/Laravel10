<template>
    <div class="w-full">
        <input :id="id" v-on:change="onFileSelected" type="file" class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">

        <p class="text-center text-xs text-red-700" v-if="hasError">{{ errorList[0].$message }}</p>
        <p class="text-center text-xs text-red-700" v-else-if="otherError">{{ otherError }}</p>
    </div>
</template>

<script setup>
    const emit = defineEmits(['selected'])

    const props = defineProps({
        id: {
            required:   true,
            type:       String
        },

        modelValue: {
            default: null
        },

        hasError: {
            required: true,
            type: Boolean
        },

        errorList: {
            required: true,
            type: Array
        },

        otherError: {
            required: true,
        }
    })

    function onFileSelected(event){
        emit('selected', event.target.files[0])
    }
</script>
