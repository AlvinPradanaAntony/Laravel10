<template>
    <card>
        <div class="space-y-6">
            <div class="flex items-center">
                <trend :trend="trend" :trendType="trendType" />

                <div class="w-full flex justify-end">
                    <button @click="action" class="bg-gray-100 text-gray-900 hover:bg-gray-200 py-1 px-2 rounded-sm border border-b-gray-200">
                        <i :class="actionIcon"></i>
                    </button>
                </div>
            </div>

            <div class="flex items-center">
                <div>
                    <h3 class="text-lg leading-tight text-gray-500 dark:text-gray-400">
                        {{ label }}
                    </h3>

                    <h1 class="text-3xl leading-tight font-semibold">
                        <growing-number :value="number" :prefix="prefix" :suffix="suffix" />
                    </h1>
                </div>

                <div class="text-4xl w-full flex justify-end" :class="colorIcon">
                    <i :class="icon"></i>
                </div>
            </div>
        </div>
    </card>
</template>

<script setup>
    import Card from '@/Components/Cards/Card.vue';
    import Trend from '@/Components/Trend.vue'
    import GrowingNumber from '@/Components/GrowingNumber.vue'

    const emit = defineEmits(['action'])

    defineProps({
        actionIcon: {
            default: 'fa-solid fa-eye',
            type: String
        },

        colorIcon:{
            required: true,
            type: String
        },

        number: {
            type: Number,
            default: 0
        },

        icon: {
            type: String,
            required: true
        },

        prefix: {
            type: String,
            default: null
        },

        suffix: {
            type: String,
            default: null
        },

        label: {
            type: String,
            default: null
        },

        trend: {
            type: String,
            default: null
        },

        trendType: {
            type: String,
            required: true
        }
    })

    function action(){
        emit('action')
    }
</script>
