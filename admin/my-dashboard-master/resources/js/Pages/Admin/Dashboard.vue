<template>
    <admin-layout title="Dashboard">
        <template #breadcrumb>
            <breadcrumb :main="main" :pages="pages" />
        </template>

        <template #label>
            Início
        </template>

        <template #content>
            <div class="grid grid-cols-1 gap-2 md:grid-cols-2 md:gap-3 lg:grid-cols-3 lg:gap-4">
                <widget-card trend="5%" trend-type="up" :number="279" label="Clientes" icon="fa-solid fa-user-group" colorIcon="text-blue-600" @action="action" />
                <widget-card trend="17%" trend-type="down" :number="1287" label="Vendas" icon="fa-solid fa-cart-shopping" colorIcon="text-orange-600" @action="action" />
                <widget-card trend="Mensal" trend-type="info" :number="19987" prefix="R$" label="Receita" icon="fa-solid fa-dollar-sign" colorIcon="text-green-600" @action="action" />
            </div>

            <div class="mt-3">
                <segmented-card title="Receita">
                    <template #content>
                        <line-chart :data="chartData" class="h-96" />
                    </template>
                </segmented-card>
            </div>
        </template>
    </admin-layout>
</template>

<script setup>
    import AdminLayout from '@/Layouts/AdminLayout.vue'
    import Breadcrumb from '@/Components/Breadcrumb.vue';
    import WidgetCard from '@/Components/Cards/WidgetCard.vue';
    import SegmentedCard from '@/Components/Cards/SegmentedCard.vue';
    import * as chartConfig from '@/Components/Charts/chart.config.js'
    import LineChart from '@/Components/Charts/LineChart.vue'
    import { ref, onMounted } from 'vue';

    const chartData = ref(null)

    const fillChartData = () => {
        chartData.value = chartConfig.sampleChartData()
    }

    onMounted(() => {
        fillChartData()
    })

    const main = {
        name:   'Início',
        route:  'dashboard',
        icon:   'fa-solid fa-house-chimney',
    }

    const pages = []

    function action(){
        alert('Exibir Conteúdo')
    }
</script>
