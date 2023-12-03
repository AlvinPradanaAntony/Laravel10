<template>
    <nav class="lg:sticky lg:top-0 h-14 bg-white text-gray-900 dark:bg-gray-900 dark:lg:border-l dark:lg:border-gray-800 flex items-center">
        <div class="w-14 h-full flex items-center justify-center overflow-hidden dark:text-white lg:invisible">
            <button @click="hideSideBar" class="p-2 hover:text-blue-700"><i class="fa-solid fa-bars"></i></button>
        </div>

        <div class="w-full h-full flex items-center justify-end">
            <nav-bar-item divider="x" padding="px-5">
                <button-light-dark @action="lightDark" />
            </nav-bar-item>

            <nav-bar-item divider="r" padding="px-5">
                <notification-button />
            </nav-bar-item>

            <nav-bar-item>
                <dropdown>
                    <template #trigger>
                        <avatar />
                    </template>

                    <template #header>
                        {{user.name}}
                    </template>

                    <template #content>
                        <dropdown-item label="Perfil" icon="fa-solid fa-id-card" @action="profile" />
                        <dropdown-item label="Notificações" icon="far fa-bell" />
                    </template>

                    <template #footer>
                        <dropdown-item label="Sair" icon="fa-solid fa-right-from-bracket" @action="logout" />
                    </template>
                </dropdown>
            </nav-bar-item>
        </div>
	</nav>
</template>

<script setup>
    import NotificationButton from '@/Dashboard/Components/NotificationButton.vue'
    import ButtonLightDark from '@/Dashboard/Components/ButtonLightDark.vue'
    import Dropdown from '@/Dashboard/Components/Dropdown.vue'
    import Avatar from '@/Dashboard/Components/Avatar.vue'
    import NavBarItem from '@/Dashboard/Components/NavBarItem.vue'
    import DropdownItem from '@/Dashboard/Components/DropdownItem.vue'
    import { useMainStore } from '@/Stores/Main'
    import { Inertia } from '@inertiajs/inertia'
    import { usePage } from '@inertiajs/inertia-vue3'
    import { computed } from 'vue'

    const user = computed(() => {
        return usePage().props.value.user
    })

    const props = defineProps({
        profileRouteName: {
            required: true,
            type: String
        },

        logoutRouteName: {
            required: true,
            type: String
        }
    })

    const mainStore = useMainStore()

    function lightDark() {
        mainStore.setDarkMode()

    }

    function hideSideBar(){
        mainStore.changeSideBarVisibilityMobile()
    }

    function profile(){
        Inertia.get(route(props.profileRouteName))
    }

    function logout(){
        Inertia.post(route(props.logoutRouteName))
    }
</script>
