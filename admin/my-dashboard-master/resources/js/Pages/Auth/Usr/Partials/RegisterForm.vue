<template>
    <form @submit.prevent="submitted" class="p-6 space-y-4">
        <div class="mb-3">
            <outline-text-input id="name" label="Nome" :hasError="v$.name.$error" :errorList="v$.name.$errors" :otherError="$page.props.errors.name" v-model="form.name"/>
        </div>
        <div class="mb-3">
            <outline-text-input id="email" label="Email" :hasError="v$.email.$error" :errorList="v$.email.$errors" :otherError="$page.props.errors.email" v-model="form.email"/>
        </div>
        <div class="mb-3">
            <outline-password-input id="password" label="Senha" :hasError="v$.password.$error" :errorList="v$.password.$errors" :otherError="$page.props.errors.password" v-model="form.password"/>
        </div>
        <div class="mb-3">
                <outline-password-input id="password_confirmation" label="Confirmar Senha" :hasError="v$.password_confirmation.$error" :errorList="v$.password_confirmation.$errors" :otherError="$page.props.errors.password_confirmation" v-model="form.password_confirmation"/>
        </div>

        <div class="flex items-center justify-end">
            <secondary-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Registrar
            </secondary-button>
        </div>
    </form>
</template>

<script setup>
    import useValidate from '@vuelidate/core'
    import { required, email, minLength, maxLength, sameAs } from '@vuelidate/validators'
    import OutlineTextInput from '@/Components/Inputs/OutlineTextInput.vue'
    import OutlinePasswordInput from '@/Components/Inputs/OutlinePasswordInput.vue'
    import SecondaryButton from '@/Components/Buttons/SecondaryButton.vue'
    import { computed } from 'vue'
    import { useForm } from '@inertiajs/inertia-vue3'

    const form = useForm({
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
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
            },

            password: {
                required,
                minLength: minLength(8),
                maxLength: maxLength(16),
            },

            password_confirmation: {
                required,
                minLength: minLength(8),
                maxLength: maxLength(16),
                sameAs: sameAs(form.password)
            }
        }
    })

    const v$ = useValidate(rules, form)

    const emit = defineEmits(['submitted'])

    function submitted(){
        v$.value.$validate()

        if(v$.value.$error)
            return

        emit('submitted', form)
    }
</script>
