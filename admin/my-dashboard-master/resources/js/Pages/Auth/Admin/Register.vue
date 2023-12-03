<template>
    <guest>
        <Head title="Register" />

        <register-form @cancel="cancel" @submitted="submit"/>
    </guest>
</template>

<script setup>
    import Guest from '@/Layouts/Guest.vue';
    import { Head } from '@inertiajs/inertia-vue3';
    import RegisterForm from '@/Pages/Auth/Admin/Partials/RegisterForm.vue';
    import { Inertia } from '@inertiajs/inertia';

    function cancel(){
        Inertia.get(route('site.welcome'))
    }

    function submit(data){
        Inertia.post(route('register'), data)
    }
</script>
