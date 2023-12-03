<template>
    <div class="h-screen">
        <!-- navbar -->
        <nav class="relative flex flex-wrap items-center justify-between px-2 py-3 bg-gray-50 text-gray-800 shadow-lg">
            <div class="container px-4 mx-auto flex flex-wrap items-center justify-between">
                <div class=" w-full relative flex justify-between lg:w-auto  px-4 lg:static lg:block lg:justify-start">
                    <a class="text-sm font-medium leading-relaxed inline-block mr-4 py-2 whitespace-nowrap hover:" @click="welcome">
                        <span class="text-blue-600">Cyber</span><b>age</b>
                    </a>
                    <button class="cursor-pointer text-xl leading-none px-3 py-1 border border-solid border-transparent rounded bg-transparent block lg:hidden outline-none focus:outline-none" type="button" v-on:click="toggleNavbar()">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                </div>

                <div v-bind:class="{'hidden': !showMenu, 'flex': showMenu}" class="lg:flex lg:flex-grow items-center">
                    <ul class="flex flex-col lg:flex-row list-none mx-auto">
                        <li class="nav-item">
                            <a class="px-3 py-2 flex items-center text-xs uppercase font-bold leading-snug hover:text-blue-600" href="">Início</a>
                        </li>
                        <li class="nav-item">
                            <a class="px-3 py-2 flex items-center text-xs uppercase font-bold leading-snug  hover:text-blue-600" href="">Quem Somos</a>
                        </li>
                        <li class="nav-item">
                            <a class="px-3 py-2 flex items-center text-xs uppercase font-bold leading-snug  hover:text-blue-600" href="">Orçamento</a>
                        </li>
                        <li class="nav-item">
                            <a class="px-3 py-2 flex items-center text-xs uppercase font-bold leading-snug  hover:text-blue-600" href="">Contato</a>
                        </li>
                    </ul>
                </div>

                <div v-bind:class="{'hidden': !showMenu, 'flex': showMenu}" class="lg:flex lg:flex-grow items-center justify-end">
                    <jet-button type="button" @click.prevent="login">
                        Entrar
                    </jet-button>
                </div>
            </div>
        </nav>
        <!-- end navbar -->


        <!-- content -->
        <slot></slot>
        <!-- end content -->


        <!-- footer -->
        <footer class="w-full p-4 bg-gray-800 fixed bottom-0 text-sm text-white">
            &copy; 2022 Cyberage Technologies. Todos os direitos reservados.
        </footer>
        <!-- end footer -->
    </div>
</template>

<script>
    import {Link } from '@inertiajs/inertia-vue3';
    import JetButton from '@/Jetstream/Button.vue'

    export default {
        name: "teal-navbar",

        components: {
            Link,
            JetButton,
        },

        data() {
            return {
                showMenu: false
            }
        },

        methods: {
            toggleNavbar: function(){
                this.showMenu = !this.showMenu;
            },

            welcome(){
                this.$inertia.get(this.route('site.welcome'))
            },

            login(){
                this.$inertia.get(this.route('login'))
            },
        },
    }
</script>
