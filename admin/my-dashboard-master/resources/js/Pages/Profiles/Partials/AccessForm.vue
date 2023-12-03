<template>
    <form @submit.prevent="submitted" class="p-6 space-y-4">
        <outline-text-input id="name" label="Nome" :hasError="v$.name.$error" :errorList="v$.name.$errors" :otherError="$page.props.errors.name" v-model="user.name"/>
        <outline-text-input id="email" label="Email" :hasError="v$.email.$error" :errorList="v$.email.$errors" :otherError="$page.props.errors.email" v-model="user.email"/>

        <div class="flex items-center justify-end mt-4">
            <secondary-button>
                Salvar
            </secondary-button>
        </div>
    </form>
</template>

<script setup>
    import useValidate from '@vuelidate/core'
    import { required, email, minLength, maxLength } from '@vuelidate/validators'
    import OutlineTextInput from '@/Components/Inputs/OutlineTextInput.vue'
    import SecondaryButton from '@/Components/Buttons/SecondaryButton.vue'
    import { useForm } from '@inertiajs/inertia-vue3'
    import { computed } from 'vue'

    const user = useForm({
        name: props.data.name,
        email: props.data.email,
    });

    const rules = computed(() => {
        return {
            name: {
                required,
                minLength: minLength(3),
                maxLength: maxLength(80),
            },

            email: {
                required,
                email,
            }
        }
    })

    const v$ = useValidate(rules, user)

    const props = defineProps({
        data: {
            default: {
                name:   '',
                email:  '',
            },
            type: Object,
        }
    })

    const emit = defineEmits(['submitted'])

    function submitted(){
        v$.value.$validate()

        if(v$.value.$error)
            return

        emit('submitted', user)
    }
</script>
