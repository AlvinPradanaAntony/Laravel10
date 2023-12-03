<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Modal from '@/Components/Modal.vue';
import Table from '@/Components/Table.vue';
import TextOnHover from '@/Components/partials/TextOnHover.vue';
import { Head, useForm, Link } from "@inertiajs/vue3";
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
        form.put(route('role.update', form.id), {
            onSuccess: () => {
                form.reset('name','id');
                Swal.fire('Role edited', '', 'success');
                useHideLoading();
            }
        })
    } else {
        form.post(route('role.store'), {
            onSuccess: () => {
                form.reset('name','id');
                Swal.fire('Role created', '', 'success')
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

function createRole() {
    form.reset('name','id');
    isShow.value = true;
}

function editRole(param) {
    form.id = param.id;
    form.name = param.name;
    form.guard_name = param.guard_name;

    isShow.value = true;
}

function deleteRole(param) {
    Swal.fire({
        icon: 'warning',
        title: 'Warning',
        text: 'Are you sure you want to delete this role?',
        showDenyButton: true,
        confirmButtonText: 'Delete',
        denyButtonText: `Don't delete`,
    }).then((result) => {
        isShow.value = false;
        useShowLoading();
        if (result.isConfirmed) {
            form.delete(route('role.destroy', param.id), {
                onSuccess: () => {
                    form.reset('name','id');
                    useHideLoading();
                    Swal.fire('Deleted!', '', 'success')
                },
                onError: (err) => {
                    form.reset('name','id');
                    useHideLoading();
                    Swal.fire(err, '', 'error')
                }
            }) 
        } 
    })
}
</script>

<template>
    <Head title="Role" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Roles
            </h2>
        </template>
        <div class="">
            <Modal :show="isShow" @close="isShow = !isShow">
                <div class="">
                    <div class="p-4 border-b-2">
                        <h3>Create Role</h3>
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
                    <button class="bg-primary rounded-md py-1 px-4" @click="createRole()"><font-awesome-icon icon="fa-solid fa-plus" class="w-3 pt-1 mr-1"/> Create Role</button>
                </div>
            </template>
            <div class="px-8">
                <Table :list="list" :thead="tableProperties" :search-column="'name'">
                    <template v-slot:action="{ rowData }">
                        <div class="flex">
                            <template v-if="can.edit">
                                <TextOnHover :content="'Edit'" :direction="'TOP'">
                                    <template v-slot:activator="{ onHover }">
                                        <button class="bg-green-700 text-white c-btn-sm" @click="editRole(rowData)" @mouseover="onHover(true)" @mouseleave="onHover(false)"><font-awesome-icon icon="fa-regular fa-pen-to-square" /></button>
                                    </template>
                                </TextOnHover>
                            </template>
                            <template v-if="can.delete">
                                <TextOnHover :content="'Delete'" :direction="'TOP'">
                                    <template v-slot:activator="{ onHover }">
                                        <button class="bg-red-700 text-white c-btn-sm" @click="deleteRole(rowData)" @mouseover="onHover(true)" @mouseleave="onHover(false)"><font-awesome-icon icon="fa-regular fa-trash-can" /></button>
                                    </template>
                                </TextOnHover>
                            </template>
                            <template v-if="rowData.id === 1" class="">
                              <p class="c-btn-sm border-primary border-2 cursor-pointer">All Permission Granted</p>
                            </template>
                            <template v-else>
                              <Link :href="route('role.edit', rowData.id)" class="c-btn-sm c-primary">Permissions</Link>
                            </template>
                        </div>
                    </template>
                </Table>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
