<template>
    <div class="w-auto h-full" :class="[dynamicDivider, dynamicPadding, dynamicDividerDark]">
        <slot />
    </div>
</template>

<script setup>
    import { computed } from 'vue';

    const dynamicDividerDark = computed(() => {
        if(props.divider == 'x'){
            return 'dark:border-x dark:border-gray-800'
        }
        else if(props.divider == 'y'){
            return 'dark:border-y dark:border-gray-800'
        }
        else if(props.divider == 'l'){
            return 'dark:border-l dark:border-gray-800'
        }
        else if(props.divider == 'r'){
            return 'dark:border-r dark:border-gray-800'
        }

        return ''
    })

    const dynamicDivider = computed(() => {
        if(props.divider == 'x'){
            return 'border-x'
        }
        else if(props.divider == 'y'){
            return 'border-y'
        }
        else if(props.divider == 'l'){
            return 'border-l'
        }
        else if(props.divider == 'r'){
            return 'border-r'
        }

        return ''
    })

    const dynamicPadding = computed(() => {
        if(props.padding != null){
            return props.padding
        }

        return ''
    })

    const props = defineProps({
        divider: {
            default: null,
            type: String
        },

        padding: {
            default: null,
            type: String
        }
    })
</script>
