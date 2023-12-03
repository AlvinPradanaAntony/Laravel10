<template>
    <layout>

        <div class="mt-8">
            <div class="flex justify-between">
                <h2 class="text-3xl text-gray-700 font-bold">الطلبات</h2>
                <div>
                    <!-- <inertia-link href="/dashboard/customer/orders/create"
                                  class="px-4 py-2 bg-indigo-500 hover:bg-indigo-600 text-white font-medium rounded">
                        أنشاء طلب
                    </inertia-link> -->
                </div>
            </div>
            <div class="mt-4">
                <div class="flex flex-col">
                    <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6">
                        <div
                            class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                            <table class="min-w-full">
                                <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-right text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                                        style="text-align: start">
                                        #
                                    </th>
                                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-right text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                                        style="text-align: start">
                                        المنشئ
                                    </th>
                                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-right text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                                        style="text-align: start">
                                        رجل التوصيل
                                    </th>
                                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-right text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                                        style="text-align: start">
                                        رقم العميل
                                    </th>
                                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                                        style="text-align: start">
                                         الحالة
                                    </th>
                                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                                        style="text-align: start">
                                         السعر الكلى
                                    </th>
                                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                                        style="text-align: start">
                                         التاريخ
                                    </th>
                                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                                        style="text-align: start">
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="bg-white text-gray-700">
                                <tr v-for="order in orders.data" :key="order.id">
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        {{ order.id }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        {{ order.user.name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <span v-if="order.delivery_man">
                                            {{ order.delivery_man.name }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        {{ order.customer_phone }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
                                        :class="[(order.status == 'لم يتم التوصيل' ? 'bg-red-100 text-red-800' : ''),
                                        (order.status === 'تم التوصيل' ? 'bg-green-100 text-green-800' : ''),
                                        (order.status === 'تم التأجيل' ? 'bg-yellow-100 text-yellow-800' : ''),
                                        (order.status === 'تم الأعادة' ? 'bg-gray-100 text-gray-800' : ''),]">
                                            {{ order.status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        {{ order.total_price }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        {{ order.created_at }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 font-medium">
                                        <inertia-link :href="`/dashboard/orders/${order.id}`" class="text-orange-600 px-1 hover:text-indigo-900">توصيل</inertia-link>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <pagination :links="orders.links" class="mt-5"></pagination>
        </div>

    </layout>
</template>

<script>
    import Layout from "../../../Shared/Layout";
    import Pagination from "../../../Shared/Pagination";

    export default {
        components: {
            Layout,
            Pagination,
        },
        props: ['orders'],

    }
</script>
