<template>
    <guest>
        <Head title="Reset Password" />

        <reset-password-form :token="token" :email="email" @submitted="submit" />
    </guest>
</template>

<script setup>
    import Guest from '@/Layouts/Guest.vue';
    import { Head, useForm } from '@inertiajs/inertia-vue3';
    import ResetPasswordForm from '@/Pages/Auth/Usr/Partials/ResetPasswordForm.vue';

    const props = defineProps({
        email: String,
        token: String,
    });

    const form = useForm({
        token: props.token,
        email: props.email,
        password: '',
        password_confirmation: '',
    });

    const submit = () => {
        form.post(route('password.update'), {
            onFinish: () => form.reset('password', 'password_confirmation'),
        });
    };
</script>
