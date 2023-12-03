<template>
    <div class="relative z-0">
        <input @blur="eventBlur" type="text" :id="id" @input="$emit('update:modelValue', $event.target.value)" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " :value="modelValue" />
        <label :for="id" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">{{label}}</label>

        <p class="text-center text-xs text-red-700" v-if="hasError">{{ errorList[0].$message }}</p>
        <p class="text-center text-xs text-red-700" v-else-if="otherError">{{ otherError }}</p>
    </div>
</template>

<script setup>
    const props = defineProps({
        id: {
            required: true,
            type: String
        },

        label: {
            required: true,
            type: String
        },

        modelValue: {
            type: String
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

    const emit = defineEmits(['update:modelValue', 'eventBlur'])

    function eventBlur(){
        emit('eventBlur')
    }
</script>
