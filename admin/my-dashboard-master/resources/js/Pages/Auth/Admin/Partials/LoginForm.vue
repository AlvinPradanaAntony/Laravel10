<template>
    <form @submit.prevent="submitted" class="p-6 space-y-4">
        <div class="mb-3">
            <h1 class="font-light text-md text-center">Login do Admin</h1>
        </div>

        <div class="mb-3">
            <outline-text-input id="email" label="Email" :hasError="v$.email.$error" :errorList="v$.email.$errors" :otherError="$page.props.errors.email" v-model="form.email"/>
        </div>

        <div class="mb-3">
            <outline-password-input id="password" label="Senha" :hasError="v$.password.$error" :errorList="v$.password.$errors" :otherError="$page.props.errors.password" v-model="form.password"/>
        </div>

        <div class="flex items-center justify-end">
            <secondary-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Entrar
            </secondary-button>
        </div>
    </form>
</template>

<script setup>
    import useValidate from '@vuelidate/core'
    import { required, email, minLength, maxLength } from '@vuelidate/validators'
    import OutlineTextInput from '@/Components/Inputs/OutlineTextInput.vue'
    import OutlinePasswordInput from '@/Components/Inputs/OutlinePasswordInput.vue'
    import SecondaryButton from '@/Components/Buttons/SecondaryButton.vue'
    import { useForm } from '@inertiajs/inertia-vue3'
    import { computed } from 'vue'

    const form = useForm({
        email: '',
        password: '',
    });

    const rules = computed(() => {
        return {
            email: {
                required,
                email,
            },

            password: {
                required,
                minLength: minLength(8),
                maxLength: maxLength(16),
            },
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
