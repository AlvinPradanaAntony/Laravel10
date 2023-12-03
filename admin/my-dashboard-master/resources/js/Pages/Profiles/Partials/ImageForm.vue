<template>
    <form @submit.prevent="submitted">
        <file-input id="image" @selected="fileSelected" :hasError="v$.image.$error" :errorList="v$.image.$errors" :otherError="$page.props.errors.image"/>

        <div class="flex items-center justify-end mt-4">
            <light-button @click="close" class="mr-4">
                Cancelar
            </light-button>

            <secondary-button>
                Salvar
            </secondary-button>
        </div>
    </form>
</template>

<script setup>
    import FileInput from '@/Components/Inputs/FileInput.vue';
    import LightButton from '@/Components/Buttons/LightButton.vue'
    import SecondaryButton from '@/Components/Buttons/SecondaryButton.vue'
    import useValidate from '@vuelidate/core'
    import { required } from '@vuelidate/validators'
    import { useForm } from '@inertiajs/inertia-vue3';
    import { computed } from 'vue';

    const emit = defineEmits(['submitted', 'close'])

    const form = useForm({
        image: ''
    })

    const rules = computed(() => {
        return {
            image: {
                required,
            }
        }
    })

    const v$ = useValidate(rules, form)

    function fileSelected(file){
        form.image = file
    }

    function submitted(){
        //console.log(form)
        v$.value.$validate()

        if(v$.value.$error)
            return

        emit('submitted', form)
    }

    function close () {
        emit('close')
    }
</script>
