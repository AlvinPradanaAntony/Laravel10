<template>
    <dialog-modal :show="show" @close="close">
        <template #title>
            Alterar Imagem
        </template>

        <template #content>
            <image-form @close="close" @submitted="submitted"/>
        </template>
    </dialog-modal>
</template>

<script setup>
    import DialogModal from '@/Components/Modals/DialogModal.vue'
    import ImageForm from '@/Pages/Profiles/Partials/ImageForm.vue';

    const emit = defineEmits(['submitted', 'close'])

    const props = defineProps({
        show: {
            required:   true,
            type:       Boolean,
        }
    })

    function submitted(data) {
        emit('submitted', data)
    }

    function close () {
        emit('close')
    }
</script>
