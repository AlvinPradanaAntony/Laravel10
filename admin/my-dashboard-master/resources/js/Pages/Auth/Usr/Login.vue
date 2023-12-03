<template>
    <guest>
        <Head title="Log in" />

        <login-form @cancel="cancel" @submitted="submit"/>
    </guest>
</template>

<script setup>
    import Guest from '@/Layouts/Guest.vue';
    import { Head } from '@inertiajs/inertia-vue3';
    import LoginForm from '@/Pages/Auth/Usr/Partials/LoginForm.vue';
    import { Inertia } from '@inertiajs/inertia';

    function cancel(){
        Inertia.get(route('site.welcome'))
    }

    function submit(data){
        Inertia.post(route('login'), data)
    }
</script>
