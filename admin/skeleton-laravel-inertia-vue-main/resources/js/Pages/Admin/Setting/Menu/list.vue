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
    column: ['name', 'route', 'ordering', 'is_active'],
    displayAs: ['Name', 'Route', 'Ordering', 'Status'],
};

const callbackColumn = {
    'is_active': (val) => {
        let status = {
            '0': 'Non-active',
            '1': 'Active',
        }

        return status[val]
    }
}

const isShow = ref(false);
const form = useForm({
    'id'        : '',
    'name'      : '',
    'route'     : '',
    'ordering'  : '',
    'is_active' : '',
}) 

function submit() {
    isShow.value = false;
    useShowLoading();
    if (form.id) {
        form.put(route('menu.update', form.id), {
            onSuccess: () => {
                form.reset('name','id');
                Swal.fire('Menu edited', '', 'success')
                useHideLoading();
            }
        })
    } else {
        form.post(route('menu.store'), {
            onSuccess: () => {
                form.reset('name','id');
                Swal.fire('Menu created', '', 'success');

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

function createMenu() {
    form.reset('name','id');
    isShow.value = true;
}

function editMenu(param) {
    form.id = param.id;
    form.name = param.name;
    form.is_active = param.is_active;

    isShow.value = true;
}

function deleteMenu(param) {
    Swal.fire({
        icon: 'warning',
        title: 'Warning',
        text: 'Are you sure you want to delete this menu?',
        showDenyButton: true,
        confirmButtonText: 'Delete',
        confirmButtonColor: "#b91c1c",
        denyButtonText: `Don't delete`,
        denyButtonColor: '#dcdce0',
    }).then((result) => {
        if (result.isConfirmed) {
            form.delete(route('menu.destroy', param.id), {
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
    <Head title="Menu" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Menus
            </h2>
        </template>
        <div class="">
            <Modal :show="isShow" @close="isShow = !isShow">
                <div class="">
                    <div class="p-4 border-b-2">
                        <h3>Create Menu</h3>
                    </div>
                    <div class="p-4">
                        <form @submit.prevent="submit">
                            <label for="">Name</label>
                            <input type="text" v-model="form.name" id="" class="c-input">
                            <label for="">Status</label>
                            <select v-model="form.is_active" id="" class="c-input">
                                <option value="1">Aktive</option>
                                <option value="0">Non-active</option>
                            </select>
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
                    <button class="bg-primary rounded-md py-1 px-4" @click="createMenu()"><font-awesome-icon icon="fa-solid fa-plus" class="w-3 pt-1 mr-1"/> Create Menu</button>
                </div>
            </template>
            <div class="px-8">
                <Table :list="list" :thead="tableProperties" :search-column="'name'" :callback-column="callbackColumn">
                    <template v-slot:action="{ rowData }">
                        <div class="flex">
                            <template v-if="can.edit">
                                <TextOnHover :content="'Edit'" :direction="'TOP'">
                                    <template v-slot:activator="{ onHover }">
                                        <button class="c-primary rounded-md px-2 py-1 text-sm mr-1" @click="editMenu(rowData)" @mouseover="onHover(true)" @mouseleave="onHover(false)"><font-awesome-icon icon="fa-regular fa-pen-to-square" /></button>
                                    </template>
                                </TextOnHover>
                            </template>
                            <template v-if="can.delete">
                                <TextOnHover :content="'Delete'" :direction="'TOP'">
                                    <template v-slot:activator="{ onHover }">
                                        <button class="bg-red-700 text-white rounded-md px-2 py-1 text-sm" @click="deleteMenu(rowData)" @mouseover="onHover(true)" @mouseleave="onHover(false)"><font-awesome-icon icon="fa-regular fa-trash-can" /></button>
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
