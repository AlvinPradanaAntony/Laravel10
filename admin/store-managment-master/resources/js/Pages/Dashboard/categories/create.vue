<template>
    <layout>

        <div class="mt-8">
            <div class="flex">
                <h2 class="text-3xl text-indigo-500 font-bold">التصنيفات /<span class="text-gray-700"> أنشاء</span></h2>
            </div>
            <!-- md:max-w-3xl -->
            <base-panel class=" mt-4">
                <form @submit.prevent="submit">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <base-input label="الأسم" name="name" v-model="form.name" :error="$page.errors.name"
                                required></base-input>
                        </div>
                        <div>
                            <base-input label="عمولة الأدمن" name="admin_commission"
                                v-model="form.admin_commission" :error="$page.errors.admin_commission" required>
                            </base-input>
                        </div>
                        <div>
                            <base-input label="عمولة المسوق" name="marketer_commission"
                                v-model="form.marketer_commission" :error="$page.errors.marketer_commission" required>
                            </base-input>
                        </div>
                        <div>
                            <base-input label="سعر التغليف" name="package_price"
                                v-model="form.package_price" :error="$page.errors.package_price" required></base-input>
                        </div>
                        <div>
                            <label class="block">
                                <span class="text-gray-700">الوزن متاح</span>
                            </label>
                                <input type="radio" v-model="form.weight_avaliable" value="1" name="weight_avaliable" id="yes">
                                <label for="نعم">نعم</label><br>
                                <input type="radio" @click="setGramPrice"
                                v-model="form.weight_avaliable" value="0"
                                name="weight_avaliable" id="no">
                                <label for="لا ">لا </label><br>
                                <span class="text-red-500 text-xs mt-4" v-if="$page.errors.weight_avaliable">{{ $page.errors.weight_avaliable[0] }}</span>
                        </div>
                        <div v-if="form.weight_avaliable == '1'">
                            <base-input label="سعر الجرام" name="gram_price" v-model="form.gram_price"
                                :error="$page.errors.gram_price" required></base-input>
                        </div>
                    </div>
                    <div class="flex justify-end mt-4">
                        <base-button primary>أنشاء تصنيف</base-button>
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
        computed: {

        },
        data() {
            return {
                form: {
                    name: '',
                    admin_commission: '',
                    marketer_commission: '',
                    package_price: '',
                    weight_avaliable: '0',
                    gram_price: '',
                }
            }
        },
        methods: {
            submit() {
                this.$inertia.post('/dashboard/categories', this.form);
            },

            setGramPrice() {
                this.form.gram_price = null;
            }
        }
    }

</script>
