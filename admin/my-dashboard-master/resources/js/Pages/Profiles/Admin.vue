<template>
    <admin-layout title="Perfil">
        <template #breadcrumb>
            <breadcrumb :main="main" :pages="pages" />
        </template>

        <template #label>
            Perfil
        </template>

        <template #content>
            <success-alert />
            <warning-alert />
            <failed-alert />

            <div class="grid grid-cols-1 gap-1 lg:grid-cols-5 lg:gap-4">
                <div class="col-span-1 lg:col-span-2 space-y-5">
                    <card>
                        <div class="flex justify-center space-x-1 dark:text-white">
                            <img v-if="user.image_path" class="w-36 h-36 rounded-full text-center overflow-hidden" :src="'/storage/'+user.image_path" alt="">
                            <i v-else class="w-36 h-36 fa-solid fa-circle-user"></i>

                            <div class="mt-3">
                                <success-button @action="changeImageEdit"><i class="fa-solid fa-pencil"></i></success-button>
                            </div>
                        </div>

                        <div class="space-y-1 dark:text-white">
                            <div class="flex justify-center">
                                <h1 class="font-bold text-2xl">{{user.name}}</h1>
                            </div>
                            <div class="flex justify-center">
                                <p class="font-light text-md">{{user.email}}</p>
                            </div>
                        </div>
                    </card>
                </div>

                <div class="col-span-1 lg:col-span-3">
                    <segmented-card title="Dados de Acesso">
                        <template #content>
                            <access-form :data="user" @submitted="accessDataUpdate"/>
                        </template>
                    </segmented-card>
                </div>
            </div>

            <change-image-modal :show="showModalBrandEdit" @submitted="changeImageUpdate" @close="cancelChangeImage" />
        </template>
    </admin-layout>
</template>

<script setup>
    import AdminLayout from '@/Layouts/AdminLayout.vue'
    import Breadcrumb from '@/Components/Breadcrumb.vue';
    import SuccessAlert from '@/Components/Alerts/SuccessAlert'
    import WarningAlert from '@/Components/Alerts/WarningAlert'
    import FailedAlert from '@/Components/Alerts/FailedAlert'
    import Card from '@/Components/Cards/Card.vue';
    import SegmentedCard from '@/Components/Cards/SegmentedCard.vue';
    import AccessForm from '@/Pages/Profiles/Partials/AccessForm.vue';
    import SuccessButton from '@/Components/Buttons/SuccessButton.vue';
    import ChangeImageModal from '@/Pages/Profiles/Partials/ChangeImageModal.vue';
    import { computed, ref } from 'vue';
    import { usePage } from '@inertiajs/inertia-vue3';
    import { Inertia } from '@inertiajs/inertia';

    const user = computed(() => {
        return usePage().props.value.user
    })

    const showModalBrandEdit = ref(false)

    const main = {
        name:   'Perfil',
        route:  'profile',
        icon:   'fa-solid fa-id-card',
    }

    const pages = []

    function accessDataUpdate(data){
        console.log(data)
    }

    function changeImageEdit(){
        showModalBrandEdit.value = true
    }

    function changeImageUpdate(data){
        Inertia.post(route('admin.profile.set.image'), data, {
            onSuccess: () => {
                cancelChangeImage()
            }
        })
    }

    function cancelChangeImage(){
        showModalBrandEdit.value = false
    }
</script>
