<template>
    <layout>

        <div class="mt-8">
            <div class="flex">
                <h2 class="text-3xl text-indigo-500 font-bold">التصنيفات / الفرعية /<span class="text-gray-700"> أنشاء</span></h2>
            </div>
            <!-- md:max-w-3xl -->
            <base-panel class=" mt-4">
                <form @submit.prevent="submit">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

                        <div>
                            <label class="block">
                                <span class="text-gray-700">التصنيف</span>
                            </label>
                            <select class="form-input border-gray-300 focus:border-indigo-400 focus:shadow-none focus:bg-white mt-1 block w-full"
                                name="category_id" v-model="form.category_id" required>
                                <option v-for="category in categories" :key="category.id" :value="category.id">
                                    {{category.name}}
                                </option>
                            </select>
                            <span class="text-red-500 text-xs mt-4"
                                v-if="$page.errors.category_id">{{ $page.errors.category_id[0] }}
                            </span>
                        </div>

                        <div>
                            <base-input label="الأسم" name="name" v-model="form.name" :error="$page.errors.name"
                                required></base-input>
                        </div>

                    </div>
                    <div class="flex justify-end mt-4">
                        <base-button primary>أنشاء تصنيف فرعي</base-button>
                    </div>
                </form>
            </base-panel>

        </div>

    </layout>
</template>

<script>
    import Layout from "../../../Shared/Layout";

    export default {
        components: {
            Layout
        },
        props: ['categories'],
        data() {
            return {
                form: {
                    name: '',
                    category_id: '',
                }
            }
        },
        methods: {
            submit() {
                this.$inertia.post('/dashboard/subcategories', this.form);
            },

        }
    }

</script>
