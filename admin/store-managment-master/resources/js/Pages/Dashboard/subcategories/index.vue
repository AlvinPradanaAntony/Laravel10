<template>
    <layout>

        <div class="mt-8">
            <div class="flex justify-between">
                <h2 class="text-3xl text-gray-700 font-bold">التصنيفات الفرعية</h2>
                <div>
                    <inertia-link href="/dashboard/subcategories/create"
                                  class="px-4 py-2 bg-indigo-500 hover:bg-indigo-600 text-white font-medium rounded">
                        أنشاء تصنيف فرعي
                    </inertia-link>
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
                                            الأسم
                                        </th>
                                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-right text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                                            style="text-align: start">
                                            التصنيف
                                        </th>
                                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50"></th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white text-gray-700">
                                    <tr v-for="subcategory in subcategories.data" :key="subcategory.id">
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            {{ subcategory.name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            {{ subcategory.category.name }}
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 font-medium">
                                            <inertia-link :href="`/dashboard/subcategories/${subcategory.id}/edit`"
                                                class="text-indigo-600 hover:text-indigo-900">تعديل</inertia-link>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <pagination :links="subcategories.links" class="mt-5"></pagination>
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
        props: ['subcategories'],

    }
</script>
