<template>
    <layout>

        <div class="mt-8">
            <div class="flex">
                <h2 class="text-3xl text-indigo-500 font-bold"> خدمة العملاء /<span class="text-gray-700"> أنشاء طلب</span></h2>
            </div>
            <!-- md:max-w-3xl -->

            <base-panel class=" mt-4">
                <div class="flex">
                    <button @click="getAllProducts()"
                    class="mx-1 bg-gray-800 text-xs text-white px-2 py-1 font-semibold rounded uppercase
                    hover:bg-gray-700 outline-none focus:bg-indigo-500">
                        All
                    </button>
                    <button v-for="category in categories" :key="category.id" @click="getCategoryProducts(category)"
                        class="mx-1 bg-gray-800 text-xs text-white px-2 py-1 font-semibold rounded uppercase
                        hover:bg-gray-700 outline-none focus:bg-indigo-500">
                        {{category.name}}
                    </button>
                </div>
                <div class="flex">
                    <button v-for="subcategory in subcategories" :key="subcategory.id" @click="getSubcategoryProducts(subcategory.id)"
                        class="mx-1 my-1 bg-gray-800 text-xs text-white px-2 py-1 font-semibold rounded uppercase
                        hover:bg-gray-700 outline-none focus:bg-indigo-500">
                        {{subcategory.name}}
                    </button>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">

                    <div v-for="(product, key) in form.orderDetails" :key="key"
                        class="mt-4 flex flex-col justify-center items-center max-w-sm mx-auto">
                        <div>
                            <img class="bg-gray-300 h-64 w-full rounded-lg shadow-md bg-cover bg-center"
                                :src="product.image">
                        </div>

                        <div class="w-56 md:w-64 bg-white -mt-10 shadow-lg rounded-lg overflow-hidden">
                            <h3 class="py-2 text-center font-bold uppercase tracking-wide text-gray-800">
                                {{product.name}}
                            </h3>

                            <div class="flex items-center justify-between py-2 px-3 bg-gray-200">
                                <span class="text-gray-800 font-bold ">SDG {{product.total_price}}</span>
                                <div v-if="!product.selected">
                                    <button @click="addProduct(key)"
                                        class=" bg-gray-800 text-xs text-white px-2 py-1 font-semibold rounded uppercase hover:bg-gray-700">
                                        Add to cart
                                    </button>
                                </div>
                                <div v-else>
                                    <button @click="increment(key)"
                                        class=" bg-gray-800 text-xs text-white px-2 py-1 font-semibold rounded uppercase hover:bg-gray-700">
                                        +
                                    </button>
                                    <button
                                        class=" bg-gray-800 text-xs text-white px-2 py-1 font-semibold rounded uppercase hover:bg-gray-700">
                                        {{product.quantity}}
                                    </button>
                                    <button @click="decrement(key)"
                                        class="bg-gray-800 text-xs text-white px-2 py-1 font-semibold rounded uppercase hover:bg-gray-700">
                                        -
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </base-panel>
            <base-panel class=" mt-4">
                <form @submit.prevent="submit">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <base-input type="number" label="رقم العميل" name="customer_phone" v-model="form.customer_phone" :error="$page.errors.customer_phone" required></base-input>
                        </div>
                        <div>
                            <base-input type="number" label=" رقم العميل الأضافي" option="أختياري" name="customer_alt_phone" v-model="form.customer_alt_phone" :error="$page.errors.customer_alt_phone"></base-input>
                        </div>
                        <div>
                            <label class="block">
                                <span class="text-gray-700">عنوان العميل</span>
                            </label>
                            <textarea v-model="form.customer_address" class="form-input border-gray-300 focus:border-indigo-400 focus:shadow-none focus:bg-white mt-1 block w-full"></textarea>
                            <span v-if="$page.errors.customer_address" class="text-red-500 text-xs mt-4">
                                {{ $page.errors.customer_address[0] }}
                            </span>
                            <!-- <base-input label="عنوان العميل" name="customer_address" v-model="form.customer_address" :error="$page.errors.customer_address" required></base-input> -->
                        </div>
                        <div>
                            <base-input label="خصم" option="أختياري" name="discount" v-model="form.discount" :error="$page.errors.discount"></base-input>
                        </div>
                        <div>
                            <p class="text-gray-700">
                            المبلغ الكلى : SDG {{total_price - this.form.discount}}
                            </p>
                        </div>
                        <div class="flex justify-end mt-4">
                            <base-button primary>أنشاء طلب</base-button>
                        </div>
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
        props: ['products', 'categories'],
        computed: {

        },
        data() {
            return {

                form: {
                    customer_phone: '',
                    customer_alt_phone: '',
                    category_id: '',
                    customer_address: '',
                    discount: '',
                    orderDetails: [],
                },
                orderDetails: [],
                subcategories: [],
                total_price: 0,
            }

        },
        created() {

            this.form.orderDetails = this.products;

        },
        methods: {
            addProduct(index) {

                this.form.orderDetails[index].selected = !this.form.orderDetails[index].selected;
                this.form.orderDetails[index].quantity++;
                this.total_price += parseFloat(this.form.orderDetails[index].total_price);

            },
            increment(index) {

                ++this.form.orderDetails[index].quantity;
                this.total_price += parseFloat(this.form.orderDetails[index].total_price);

            },
            decrement(index) {

                --this.form.orderDetails[index].quantity;
                this.total_price -=  parseFloat(this.form.orderDetails[index].total_price);
                if (this.form.orderDetails[index].quantity == 0) {
                    this.form.orderDetails[index].selected = !this.form.orderDetails[index].selected;
                }

            },
            submit() {

                this.form.orderDetails = this.products.filter(product => product.selected == true);
                this.$inertia.post('/dashboard/customer/services', this.form);

            },
            getCategoryProducts(category) {

                this.form.orderDetails = this.products.filter(product => product.category_id == category.id);
                this.subcategories = category.subcategories;

            },
            getSubcategoryProducts(id) {

                this.form.orderDetails = this.products.filter(product => product.subcategory_id == id);

            },
            getAllProducts() {

                this.form.orderDetails = this.products;
                this.subcategories = [];

            },

        }
    }

</script>
