<template>
    <div class="inline-flex items-center space-x-3 border border-gray-800 text-white text-xs py-0.5 px-3 rounded-lg" :class="[dynamicClass]">
        <i :class="dynamicIcon"></i>
        <p>{{trend}}</p>
    </div>
</template>

<script setup>
    import { computed } from 'vue';

    const dynamicClass = computed(() => {
        if(props.trendType === 'up'){
            return "bg-green-600"
        }
        else if(props.trendType === 'down'){
            return "bg-red-600"
        }
        else if(props.trendType === 'info'){
            return "bg-blue-600"
        }
    })

    const dynamicIcon = computed(() => {
        if(props.trendType === 'up'){
            return "fa-solid fa-angle-up"
        }
        else if(props.trendType === 'down'){
            return "fa-solid fa-angle-down"
        }
        else if(props.trendType === 'info'){
            return "fa-solid fa-circle-info"
        }
    })

    const props = defineProps({
        trend: {
            type: String,
            required: true
        },

        trendType: {
            type: String,
            required: true
        }
    })
</script>
