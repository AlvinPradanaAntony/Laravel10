<template>
    <guest>
        <Head title="Forgot Password" />

        <div class="mb-4 text-sm text-gray-600">
            Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
        </div>

        <forgot-password-form @submitted="submit" />
    </guest>
</template>

<script setup>
    import Guest from '@/Layouts/Guest.vue';
    import { Head } from '@inertiajs/inertia-vue3';
    import ForgotPasswordForm from '@/Pages/Auth/Usr/Partials/ForgotPasswordForm.vue';
    import { Inertia } from '@inertiajs/inertia';

    function submit(data){
        Inertia.post(route('password.email'), data)
    }
</script>
