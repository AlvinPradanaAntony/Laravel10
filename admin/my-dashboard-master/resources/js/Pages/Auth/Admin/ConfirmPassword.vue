<template>
    <guest>
        <Head title="Confirm Password" />

        <div class="mb-4 text-sm text-gray-600">
            This is a secure area of the application. Please confirm your password before continuing.
        </div>

        <confirm-password-form @submitted="submit" />
    </guest>
</template>

<script setup>
    import Guest from '@/Layouts/Guest.vue';
    import { Head } from '@inertiajs/inertia-vue3';
    import ConfirmPasswordForm from '@/Pages/Auth/Admin/Partials/ConfirmPasswordForm.vue';
    import { Inertia } from '@inertiajs/inertia';

    function submit(data){
        Inertia.post(route('password.confirm'), data)
    }
</script>
