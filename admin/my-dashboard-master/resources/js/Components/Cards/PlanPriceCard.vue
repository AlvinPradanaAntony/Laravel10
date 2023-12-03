<template>
    <div class="p-4 h-full w-full bg-white rounded-lg border shadow-md sm:p-8 dark:bg-gray-800 dark:border-gray-700">
        <h5 class="mb-4 text-xl text-center uppercase font-medium text-gray-500 dark:text-gray-400">{{plan.name}}</h5>
        <div class="flex items-baseline justify-center text-gray-900 dark:text-white">
            <span class="text-3xl font-semibold mr-1">{{coin}}</span>
            <span class="text-5xl font-extrabold tracking-tight">{{plan.price}}</span>
            <span class="text-xl font-normal text-gray-500 dark:text-gray-400">/{{frequency}}</span>
        </div>
        <!-- List -->
        <ul role="list" class="my-7 space-y-5">
            <li class="flex space-x-3">
                <svg class="flex-shrink-0 w-5 h-5 text-blue-600 dark:text-blue-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                <span class="text-base font-normal leading-tight text-gray-500 dark:text-gray-400">{{plan.max_number_stores}} Loja(s)</span>
            </li>

            <li class="flex items-center space-x-3">
                <svg class="flex-shrink-0 w-5 h-5 text-blue-600 dark:text-blue-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                <span class="text-base font-normal leading-tight text-gray-500 dark:text-gray-400">{{systems.length}} Sistemas</span>

                <div @click="showSystems">
                    <i class="fa-solid fa-eye text-gray-500 hover:cursor-pointer hover:text-blue-600  "></i>
                </div>
            </li>

            <li class="flex space-x-3">
                <svg v-if="plan.own_domain" class="flex-shrink-0 w-5 h-5 text-blue-600 dark:text-blue-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                <svg v-else class="flex-shrink-0 w-5 h-5 text-gray-400 dark:text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>

                <span v-if="plan.own_domain" class="text-base font-normal leading-tight text-gray-500 dark:text-gray-400">Domínio próprio</span>
                <span v-else class="text-base line-through decoration-gray-500 font-normal leading-tight text-gray-500">Domínio próprio</span>
            </li>
        </ul>

        <button @click="wantChangePlan(plan.code)" type="button" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-200 dark:focus:ring-blue-900 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex justify-center w-full text-center">Selecionar</button>
    </div>

    <!-- Modals -->
    <confirmation-modal :show="showModalChangePlan" @close="cancelChangePlan">
        <template #title>
            Alterar Plano
        </template>

        <template #content>
            Você está prestes a alterar o plano de sua assinatura, isso gerará uma nova cobrança
            referente ao valor do novo plano. Não se preocupe com o(s) dia(s) que ainda falta(m)
            para terminar o ciclo de cobrança anterior, pois será calculado um credito referente
            ao mesmo e este será usado na cobrança atual. Deseja continuar?
        </template>

        <template #footer>
            <light-button class="mr-3" @click="cancelChangePlan">
                Desistir
            </light-button>

            <secondary-button @click="changePlan">
                Alterar
            </secondary-button>
        </template>
    </confirmation-modal>

    <dialog-modal :show="showModalSystem" @close="cancelShowSystems">
        <template #title>
            Detalhes dos Sistemas
        </template>

        <template #content>
            <table class="w-full divide-y divide-gray-700">
                <thead class="bg-gray-700 text-white uppercase">
                    <tr>
                        <th class="px-6 py-2 text-xs font-medium tracking-wider">Nome</th>
                        <th class="px-6 py-2 text-xs font-medium tracking-wider">descrição</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-700 text-center">
                    <tr v-for="(system, index) in systems" :key="index">
                        <td class="px-6 py-2 text-sm font-medium whitespace-nowrap tracking-wider">{{system.name}}</td>
                        <td class="px-6 py-2 text-sm font-medium whitespace-nowrap tracking-wider">{{system.description}}</td>
                    </tr>
                </tbody>
            </table>
        </template>

        <template #footer>
            <light-button @click="cancelShowSystems">
                Fechar
            </light-button>
        </template>
    </dialog-modal>
</template>

<script>
    import { defineComponent } from 'vue'
    import ConfirmationModal from '@/Components/Modals/ConfirmationModal.vue'
    import DialogModal from '@/Components/Modals/DialogModal.vue'
    import SecondaryButton from '@/Components/Buttons/SecondaryButton.vue'
    import LightButton from '@/Components/Buttons/LightButton.vue'

    export default defineComponent({
        components: {
            ConfirmationModal,
            DialogModal,
            SecondaryButton,
            LightButton,
        },

        data () {
            return {
                showModalSystem:        false,
                showModalChangePlan:    false,
                selected:               ''
            }
        },

        methods: {
            wantChangePlan(code) {
                this.showModalChangePlan    = true
                this.selected               = code
            },

            changePlan(){
                this.$inertia.get(this.route('subscriptions.plan.change', [this.param, this.selected]))
            },

            showSystems(){
                this.showModalSystem = true
            },

            cancelChangePlan () {
                this.showModalChangePlan    = false
                this.selected               = ''
            },

            cancelShowSystems () {
                this.showModalSystem = false
            },
        },

        props: {
            param: {
                required:   true,
                type:       String,
            },
            plan: {
                required:   true,
                type:       Object,
            },
            coin: {
                required:   true,
                type:       String,
            },
            frequency: {
                required:   true,
                type:       String,
            },
            systems: {
                required:   true,
                type:       Object,
            },
        },
    })
</script>
