<template>
    <form @submit.prevent="submitted" class="p-6 space-y-4">
        <div class="mb-3">
            <outline-text-input id="email" label="Email" :hasError="v$.form.email.$error" :errorList="v$.form.email.$errors" :otherError="$page.props.errors.email" v-model="form.email"/>
        </div>

        <div class="flex items-center justify-end">
            <secondary-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Enviar
            </secondary-button>
        </div>
    </form>
</template>

<script setup>
    import useValidate from '@vuelidate/core'
    import { required, email } from '@vuelidate/validators'
    import OutlineTextInput from '@/Components/Inputs/OutlineTextInput.vue'
    import SecondaryButton from '@/Components/Buttons/SecondaryButton.vue'
    import { useForm } from '@inertiajs/inertia-vue3';
    import { computed } from 'vue';

    const form = useForm({
        email: '',
    });

    const rules = computed(() => {
        return {
            email: {
                required,
                email
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
