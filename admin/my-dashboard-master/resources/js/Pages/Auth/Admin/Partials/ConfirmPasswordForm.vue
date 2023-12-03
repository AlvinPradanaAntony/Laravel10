<template>
    <form @submit.prevent="submitted" class="p-6 space-y-4">
        <div class="mb-3">
            <outline-password-input id="password" :hasError="v$.form.password.$error" :errorList="v$.form.password.$errors" :otherError="$page.props.errors.password" v-model="form.password"/>
        </div>

        <div class="flex items-center justify-end">
            <secondary-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Confirmar
            </secondary-button>
        </div>
    </form>
</template>

<script setup>
    import useValidate from '@vuelidate/core'
    import { required, minLength, maxLength } from '@vuelidate/validators'
    import OutlinePasswordInput from '@/Components/Inputs/OutlinePasswordInput.vue'
    import SecondaryButton from '@/Components/Buttons/SecondaryButton.vue'
    import { useForm } from '@inertiajs/inertia-vue3';
    import { computed } from 'vue';

    const form = useForm({
        password: '',
    });

    const rules = computed(() => {
        return {
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
