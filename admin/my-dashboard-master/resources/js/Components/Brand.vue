<template>
    <div class="flex">
        <img class="w-48" :src="source == null ? '/storage/tenants/default.png' : '/storage/' + source" alt="Brand">

        <div>
            <success-button class="mr-2" @click="brandEdit"><i class="fas fa-pencil-alt"></i></success-button>
        </div>

        <!-- Modals -->
        <jet-dialog-modal :show="showModalBrandEdit" @close="cancelBrandEdit">
            <template #title>
                Alterar Logotipo
            </template>

            <template #content>
                <form @submit.prevent="brandUpdate">
                    <file-input id="image" @selected="fileSelected" :hasError="v$.form.image.$error" :errorList="v$.form.image.$errors" :otherError="$page.props.errors.image"/>
                </form>
            </template>

            <template #footer>
                <light-button class="mr-3" @click="cancelBrandEdit">
                    Cancelar
                </light-button>

                <jet-button @click="brandUpdate">
                    Alterar
                </jet-button>
            </template>
        </jet-dialog-modal>
        <!-- End Modals -->
    </div>
</template>

<script>
    import SuccessButton from '@/Components/Buttons/SuccessButton.vue'
    import useValidate from '@vuelidate/core'
    import { required } from '@vuelidate/validators'
    import JetDialogModal from '@/Jetstream/DialogModal.vue'
    import FileInput from '@/Components/Inputs/FileInput.vue'
    import JetButton from '@/Jetstream/Button.vue'
    import LightButton from '@/Components/Buttons/LightButton.vue'

    export default {
        components: {
            SuccessButton,
            JetDialogModal,
            FileInput,
            JetButton,
            LightButton,
        },

        data () {
            return {
                v$: useValidate(),

                showModalBrandEdit: false,

                form: this.$inertia.form({
                    image: null
                })
            }
        },

        methods: {
            brandEdit(){
                this.showModalBrandEdit = true
            },

            fileSelected(file){
                this.form.image = file
            },

            brandUpdate(){
                this.v$.$validate()

                if(this.v$.$error)
                    return

                this.form.post(this.route('tenants.brand.set'), {
                    forceFormData: true,

                    onSuccess: () => {
                        this.cancelBrandEdit()
                    }
                });
            },

            cancelBrandEdit(){
                this.showModalBrandEdit     = false
                this.form.image             = null
            },
        },

        props: {
            source: {
                default:   null,
                type:       String
            }
        },

        validations(){
            return {
                form: {
                    image: {
                        required,
                    }
                }
            }
        },
    }
</script>
