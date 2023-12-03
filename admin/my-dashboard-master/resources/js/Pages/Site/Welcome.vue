<template>
    <Head title="Welcome" />

    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            <Link :href="route('login')" class="text-sm text-gray-700 underline">
                Entrar
            </Link>

            <Link :href="route('register')" class="ml-4 text-sm text-gray-700 underline">
                Registrar
            </Link>
        </div>

        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 text-center">
            <h1 class="mb-3 text-xl lg:text-7xl">DASHBOARD</h1>
            <p class="text-sm lg:text-lg">dashboard for Laravel with Vue JS 3, Inertia JS and Tailwind CSS 3</p>
        </div>
    </div>
</template>

<script>
    import { defineComponent } from 'vue'
    import { Head, Link } from '@inertiajs/inertia-vue3';
    export default defineComponent({
        components: {
            Head,
            Link,
        },
        props: {
            canLogin: Boolean,
            canRegister: Boolean,
            laravelVersion: String,
            phpVersion: String,
        }
    })
</script>

<style>
    body {
        padding: 0px;
    }
</style>
