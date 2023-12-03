<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Modal from '@/Components/Modal.vue';
import Table from '@/Components/Table.vue';
import TextOnHover from '@/Components/partials/TextOnHover.vue';
import { Head, useForm } from "@inertiajs/vue3";
import { ref } from 'vue';
import Swal from 'sweetalert2';
import { useShowLoading, useHideLoading } from "@/Composables/baseComposables";

defineProps({
    list: {
        type: Object,
    },
    can: {
        type: Object,
    }
});

const tableProperties = {
    column: ['name', 'guard_name'],
    displayAs: ['Name', 'Guard Name']
};

const isShow = ref(false);
const form = useForm({
    'id': '',
    'name': '',
    'guard_name': 'web' 
}) 

function submit() {
    isShow.value = false;
    useShowLoading();
    if (form.id) {
        form.put(route('permission.update', form.id), {
            onSuccess: () => {
                form.reset('name','id');
                Swal.fire('Permission edited', '', 'success')
                useHideLoading();
            }
        })
    } else {
        form.post(route('permission.store'), {
            onSuccess: () => {
                form.reset('name','id');
                Swal.fire('Permission created', '', 'success');

                useHideLoading();
            },
            onError: (err) => {
                form.reset('name','id');
                Swal.fire(err, '', 'error')
                useHideLoading();
            }
        })
    }
}

function createPermission() {
    form.reset('name','id');
    isShow.value = true;
}

function editPermission(param) {
    form.id = param.id;
    form.name = param.name;
    form.guard_name = param.guard_name;

    isShow.value = true;
}

function deletePermission(param) {
    Swal.fire({
        icon: 'warning',
        title: 'Warning',
        text: 'Are you sure you want to delete this permission?',
        showDenyButton: true,
        confirmButtonText: 'Delete',
        confirmButtonColor: "#b91c1c",
        denyButtonText: `Don't delete`,
        denyButtonColor: '#dcdce0',
    }).then((result) => {
        if (result.isConfirmed) {
            form.delete(route('permission.destroy', param.id), {
                onSuccess: () => {
                    form.reset('name','id');
                    isShow.value = false;
                    Swal.fire('Deleted!', '', 'success')
                },
                onError: (err) => {
                    form.reset('name','id');
                    isShow.value = false;
                    Swal.fire(err, '', 'error')
                }
            }) 
        } 
    })
}
</script>

<template>
    <Head title="Permission" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Permissions
            </h2>
        </template>
        <div class="">
            <Modal :show="isShow" @close="isShow = !isShow">
                <div class="">
                    <div class="p-4 border-b-2">
                        <h3>Create Permission</h3>
                    </div>
                    <div class="p-4">
                        <form @submit.prevent="submit">
                            <label for="">Name</label>
                            <input type="text" v-model="form.name" id="" class="c-input">
                            <input type="hidden" v-model="form.id">

                            <div class="flex flex-row-reverse mt-6">
                                <button type="submit" class="c-btn c-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </Modal>
            <template v-if="can.create">
                <div class="px-8 text-white text-sm">
                    <button class="bg-primary rounded-md py-1 px-4" @click="createPermission()"><font-awesome-icon icon="fa-solid fa-plus" class="w-3 pt-1 mr-1"/> Create Permission</button>
                </div>
            </template>
            <div class="px-8">
                <Table :list="list" :thead="tableProperties" :search-column="'name'">
                    <template v-slot:action="{ rowData }">
                        <div class="flex">
                            <template v-if="can.edit">
                                <TextOnHover :content="'Edit'" :direction="'TOP'">
                                    <template v-slot:activator="{ onHover }">
                                        <button class="c-primary rounded-md px-2 py-1 text-sm mr-1" @click="editPermission(rowData)" @mouseover="onHover(true)" @mouseleave="onHover(false)"><font-awesome-icon icon="fa-regular fa-pen-to-square" /></button>
                                    </template>
                                </TextOnHover>
                            </template>
                            <template v-if="can.delete">
                                <TextOnHover :content="'Delete'" :direction="'TOP'">
                                    <template v-slot:activator="{ onHover }">
                                        <button class="bg-red-700 text-white rounded-md px-2 py-1 text-sm" @click="deletePermission(rowData)" @mouseover="onHover(true)" @mouseleave="onHover(false)"><font-awesome-icon icon="fa-regular fa-trash-can" /></button>
                                    </template>
                                </TextOnHover>
                            </template>
                        </div>
                    </template>
                </Table>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
