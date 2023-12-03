<template>
    <layout>

        <div class="mt-8">
            <div class="flex">
                <h2 class="text-3xl text-indigo-500 font-bold"> الطلبات /<span class="text-gray-700"> توصيل الطلب</span></h2>
            </div>
            <!-- md:max-w-3xl -->

            <base-panel class=" mt-4">
                <p class="text-indigo-500 font-bold text-xl">رقم العميل : <span class="text-gray-700">{{order.customer_phone}}</span></p>
                <p class="text-indigo-500 font-bold text-xl">رقم العميل الأضافي : <span class="text-gray-700">{{order.customer_alt_phone}}</span></p>
                <p class="text-indigo-500 font-bold text-xl">عنوان العميل : <span class="text-gray-700">{{order.customer_address}}</span></p>
                <p class="text-indigo-500 font-bold text-xl">الخصم : <span class="text-gray-700">{{order.discount}}</span></p>
                <p class="text-indigo-500 font-bold text-xl">المبلغ الكلى : <span class="text-gray-700">{{order.total_price}}</span></p>
                <p class="text-indigo-500 font-bold text-xl">التاريخ : <span class="text-gray-700">{{order.created_at}}</span></p>
                <p class="text-indigo-500 font-bold text-xl">الحالة :
                    <span
                    :class="[(order.status == 'لم يتم التوصيل' ? 'text-red-600' : ''),
                    (order.status === 'تم التوصيل' ? 'text-green-600' : ''),
                    (order.status === 'تم التأجيل' ? 'text-yellow-600' : ''),
                    (order.status === 'تم الأعادة' ? 'text-gray-600' : ''),]">
                    {{order.status}}
                    </span>
                </p>
            </base-panel>

            <base-panel class=" mt-4">
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">

                    <div v-for="(orderDetail, key) in this.orderDetails" :key="key"
                        class="mt-4 flex flex-col justify-center items-center max-w-sm mx-auto">
                        <div>
                            <img class="bg-gray-300 h-64 w-full rounded-lg shadow-md bg-cover bg-center"
                                :src="orderDetail.image">
                        </div>

                        <div class="w-56 md:w-64 bg-white -mt-10 shadow-lg rounded-lg overflow-hidden">
                            <h3 class="py-2 text-center font-bold uppercase tracking-wide text-gray-800">
                                {{orderDetail.product.name}}
                            </h3>
                            <!-- <p class="py-2 text-center font-bold uppercase tracking-wide text-gray-800">الوزن :
                                {{orderDetail.product.weight}}
                            </p> -->
                            <div class="flex items-center justify-between py-2 px-3 bg-gray-200">
                                <span class="text-gray-800 font-bold ">SDG {{orderDetail.product.total_price}}</span>
                                <div>
                                    <button
                                        class=" bg-gray-800 text-xs text-white px-2 py-1 font-semibold rounded uppercase hover:bg-gray-700">
                                        {{orderDetail.quantity}}
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
                            <label class="block">
                                <span class="text-gray-700">الحالة</span>
                            </label>
                            <select name="status" class="form-input border-gray-300 focus:border-indigo-400 focus:shadow-none focus:bg-white mt-1 block w-full"
                                v-model="form.status" required>
                                <option value="تم التوصيل">
                                    تم التوصيل
                                </option>
                                <option value="لم يتم التوصيل">
                                    لم يتم التوصيل
                                </option>
                                <option value="تم التأجيل">
                                    تم التأجيل
                                </option>
                                <option value="تم الأعادة">
                                    تم الأعادة
                                </option>

                            </select>
                            <span class="text-red-500 text-xs mt-4"
                                v-if="$page.errors.status">{{ $page.errors.status[0] }}
                            </span>
                        </div>
                        <div>
                            <label class="block">
                                <span class="text-gray-700">رجل التوصيل</span>
                            </label>
                            <select class="form-input border-gray-300 focus:border-indigo-400 focus:shadow-none focus:bg-white mt-1 block w-full"
                                name="delivery_man_id" v-model="form.delivery_man_id" required>
                                <option v-for="user in users" :key="user.id" :value="user.id">
                                    {{user.name}}
                                </option>

                            </select>
                            <span class="text-red-500 text-xs mt-4"
                                v-if="$page.errors.delivery_man_id">{{ $page.errors.delivery_man_id[0] }}
                            </span>
                        </div>
                        <div>
                            <base-input label="سعر التوصيل" name="delivery_price"
                                v-model="form.delivery_price" :error="$page.errors.delivery_price" required>
                            </base-input>
                        </div>
                        <div>
                            <base-input label="القيمة المضافة" option="أختياري" name="added_price"
                                v-model="form.added_price" :error="$page.errors.added_price">
                            </base-input>
                        </div>
                        <div>
                            <p class="text-gray-700">
                            المبلغ الكلى : SDG {{+order.total_price + (+this.form.delivery_price + +this.form.added_price)}}
                            </p>
                        </div>
                        <div class="flex justify-end mt-4">
                            <base-button primary>توصيل</base-button>
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
        props: ['order', 'orderDetails', 'users'],
        computed: {

        },
        data() {
            return {
                form: {
                    added_price:'',
                    delivery_price:'',
                    delivery_man_id:'',
                    status: '',
                },
            }

        },
        created() {
            this.form.status = this.order.status;
            this.form.added_price = this.order.added_price;
            this.form.delivery_price = this.order.delivery_price;
            this.form.delivery_man_id = this.order.delivery_man_id;
        },
        methods: {
            submit(){
                this.$inertia.put(this.$route('orders.update', this.order.id), this.form);
            }
        }
    }

</script>
