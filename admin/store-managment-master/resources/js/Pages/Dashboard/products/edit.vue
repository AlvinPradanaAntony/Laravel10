<template>
    <layout>

        <div class="mt-8">
            <div class="flex">
                <h2 class="text-3xl text-indigo-500 font-bold">المنتجات /<span class="text-gray-700"> تعديل</span>
                </h2>
            </div>

            <base-panel class="flex mt-4 justify-center">
                <img :src="this.image" class="w-2/6">
            </base-panel>

            <base-panel class="mt-4">
                <form @submit.prevent="submit">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <base-input label="أسم المنتج" name="name" v-model="form.name" :error="$page.errors.name"
                                required></base-input>
                        </div>
                        <div>
                            <base-input label="الوزن" name="weight" v-model="form.weight"
                                :error="$page.errors.weight" required>
                            </base-input>
                        </div>
                        <div>
                            <label class="block">
                                <span class="text-gray-700">التصنيف الرئيسي</span>
                            </label>
                            <select
                                class="form-input border-gray-300 focus:border-indigo-400 focus:shadow-none focus:bg-white mt-1 block w-full"
                                @change="getSubcategoreis(form.category_id)" name="category_id"
                                v-model="form.category_id" required>
                                <option v-for="category in categories" :key="category.id" :value="category.id">
                                    {{category.name}}
                                </option>

                            </select>
                            <span class="text-red-500 text-xs mt-4"
                                v-if="$page.errors.category_id">{{ $page.errors.category_id[0] }}
                            </span>
                        </div>
                        <div>
                            <label class="block">
                                <span class="text-gray-700">التصنيف الفرعي</span>
                            </label>
                            <select
                                class="form-input border-gray-300 focus:border-indigo-400 focus:shadow-none focus:bg-white mt-1 block w-full"
                                name="subcategory_id" v-model="form.subcategory_id">
                                <option></option>
                                <option v-for="subcategory in subcategories" :key="subcategory.id" :value="subcategory.id">
                                    {{subcategory.name}}
                                </option>
                            </select>
                            <span class="text-red-500 text-xs mt-4"
                                v-if="$page.errors.subcategory_id">{{ $page.errors.subcategory_id[0] }}
                            </span>
                        </div>
                        <div>
                            <base-input label="السعر" name="added_value"
                                v-model="form.price" :error="$page.errors.price" required>
                            </base-input>
                        </div>
                        <div>
                            <base-input label="القيمة المضافة" name="added_value"
                                v-model="form.added_value" :error="$page.errors.added_value" required>
                            </base-input>
                        </div>
                        <div>
                            <base-input label="القيمة المخصومة" name="deducted_value"
                                v-model="form.deducted_value" :error="$page.errors.deducted_value" required>
                            </base-input>
                        </div>
                        <div>
                            <base-input label="الرمز" name="code" v-model="form.code" :error="$page.errors.code"
                                required></base-input>
                        </div>
                        <div>
                            <base-input type="number" label="الكمية" name="stock" v-model="form.stock"
                                :error="$page.errors.stock" required></base-input>
                        </div>
                        <div>
                            <label class="block">
                                <span class="text-gray-700">الصورة</span>
                            </label>
                            <input type="file" name="image" id="image" @change="uploadFile($event)">
                            <span class="text-red-500 text-xs mt-4"
                                v-if="$page.errors.image">{{ $page.errors.image[0] }}
                            </span>
                        </div>

                    </div>
                    <div class="flex justify-end mt-4">
                        <base-button primary>تعديل المنتج</base-button>
                    </div>
                </form>
            </base-panel>

        </div>
        <!-- $donorentity->getMedia('entity') -->

    </layout>
</template>

<script>
    import Layout from "../../../Shared/Layout";

    export default {
        components: {
            Layout
        },
        props: ['product', 'image', 'categories', '_subcategories'],
        data() {
            return {
                form: {
                    id:'',
                    name: '',
                    weight: 1,
                    category_id: '',
                    subcategory_id: null,
                    added_value: '',
                    deducted_value: '',
                    price: '',
                    code: '',
                    stock: '',
                    image: null,
                },
                subcategories: {},
            }
        },
        created() {
            this.form = this.product;
            this.subcategories = this._subcategories;
        },
        methods: {
            submit() {
                const formData = new FormData()
                formData.append('image', this.form.image)
                formData.append('id', this.form.id)
                formData.append('name', this.form.name)
                formData.append('weight', this.form.weight)
                formData.append('category_id', this.form.category_id)
                formData.append('subcategory_id', this.form.subcategory_id)
                formData.append('added_value', this.form.added_value)
                formData.append('deducted_value', this.form.deducted_value)
                formData.append('price', this.form.price)
                formData.append('code', this.form.code)
                formData.append('stock', this.form.stock)

                this.$inertia.post(this.$route('products.update', this.product.id), formData);
            },
            uploadFile(e) {

                this.form.image = e.target.files[0]

            },

            getSubcategoreis(id) {
                axios.get('/dashboard/get/subcategories/' + id)
                .then(res => {
                    console.log(res);
                    this.subcategories = res.data
                })
                .catch(error => {
                    console.log(error)
                });
            }
        }
    }

</script>
