<template>
    <layout>

        <div class="mt-8">
            <div class="flex">
                <h2 class="text-3xl text-indigo-500 font-bold">التصنيفات / التصنيفات الفرعية /<span class="text-gray-700"> تعديل</span></h2>
            </div>

            <base-panel class="mt-4">
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
                                v-if="$page.errors.weight_avaliable">{{ $page.errors.weight_avaliable[0] }}</span>
                        </div>

                        <div>
                            <base-input label="الأسم" name="name" v-model="form.name" :error="$page.errors.name"
                                required></base-input>
                        </div>

                    </div>
                    <div class="flex justify-end mt-4">
                        <base-button primary>تعديل التصنيف الفرعي</base-button>
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
        props: ['subcategory', 'categories'],
        data() {
            return {
                form: {
                    name: '',
                    category_id: '',
                }
            }
        },
        created() {
            this.form = this.subcategory;
        },
        methods: {
            submit() {
                this.$inertia.put(this.$route('subcategories.update', this.subcategory.id), this.form);
            },
        }
    }

</script>
