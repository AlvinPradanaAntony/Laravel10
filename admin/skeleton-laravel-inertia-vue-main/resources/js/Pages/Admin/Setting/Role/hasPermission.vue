<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { useForm } from "@inertiajs/vue3";
import {useCapitalise} from '@/Composables/baseComposables.js';

const props = defineProps({
  role: {
    type: Object,
    default: () => ({}),
  },
  permissions: {
    type: Object,
    default: () => ({}),
  },
  roleHasPermissions: {
    type: Object,
    default: () => ({}),
  }
})

const form = useForm({
  _method: 'put',
  id: props.role.id,
  name: props.role.name,
  permissions: {...props.roleHasPermissions.reduce((obj, id) => ({ ...obj, [id]: true }), {})}
})

const submitForm = async () => {
  // Format the form data before submitting
  form.permissions = Object.keys(form.permissions).filter((permissionId) => form.permissions[permissionId]),

  form.post(route('role.update', form.id))
  // Optionally, you can add a success message or redirect after the update
};

</script>

<template>
  <Head title="Role permission" />
  <AuthenticatedLayout>
      <template #header>
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">
              Roles permission
          </h2>
      </template>
      <form @submit.prevent="submitForm" class="px-8">
        <ul>
          <li v-for="(permission, key) in permissions" :key="permission.id" class="flex items-center gap-x-1">
            <input type="checkbox" :name="'permissions[' + key + ']'" :id="'permissions[' + key + ']'" v-model="form.permissions[permission.id]"> 
            <label :for="'permissions[' + key + ']'" class="mb-0"> {{ useCapitalise(permission.name) }} </label>
          </li>
        </ul>
        
        <button type="submit" class="c-btn c-primary mt-4">Update Role</button>
      </form>
  </AuthenticatedLayout>
</template>