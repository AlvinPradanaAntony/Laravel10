<template>
    <Modal
        :show="show"
        :max-width="maxWidth"
        :closeable="closeable"
        @close="close"
    >
        <div class="bg-white text-gray-900 dark:bg-gray-900 dark:text-white px-6 py-4">
            <div class="text-lg">
                <slot name="title" />
            </div>

            <div class="mt-4">
                <slot name="content" />
            </div>
        </div>

        <div class="flex flex-row justify-end px-6 py-4 dark:bg-gray-800 dark:text-white">
            <slot name="footer" />
        </div>
    </Modal>
</template>

<script setup>
    import Modal from '@/Components/Modals//Modal.vue';

    const emit = defineEmits(['close']);

    defineProps({
        show: {
            type: Boolean,
            default: false,
        },
        maxWidth: {
            type: String,
            default: '2xl',
        },
        closeable: {
            type: Boolean,
            default: true,
        },
    });

    const close = () => {
        emit('close');
    };
</script>
