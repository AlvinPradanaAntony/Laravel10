<template>
    <layout>

        <div class="mt-8">
            <div class="flex">
                <h2 class="text-3xl text-indigo-500 font-bold">المستخدمين /<span class="text-gray-700"> تعديل</span></h2>
            </div>

            <base-panel class="mt-4">
                <form @submit.prevent="submit">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="col-md-2 control-label">الصلاحيات</label>
                            <select class="form-input border-gray-300 focus:border-indigo-400 focus:shadow-none focus:bg-white mt-1 block w-full"
                                name="permission" v-model="form.permission" required>
                                <option v-for="(permission, key) in permissions" :key="key" :value="permission"
                                :selected="permission === 'admin'">
                                    {{permission}}
                                </option>
                            </select>
                        </div>
                        <base-input label="الأسم الكامل" name="name" v-model="form.name" :error="$page.errors.name" required></base-input>
                        <base-input label="اسم المستخدم" name="username" v-model="form.username" :error="$page.errors.username" required></base-input>
                        <base-input type="number" label="رقم الهاتف" name="phone" v-model="form.phone" :error="$page.errors.phone" required></base-input>
                        <base-input type="number" label="رقم الهاتف الأضافي" name="alt_phone" v-model="form.alt_phone" :error="$page.errors.alt_phone" required></base-input>
                        <base-input label="العنوان" name="address" v-model="form.address" :error="$page.errors.address" required></base-input>
                        <base-input label="الرصيد" name="balance" v-model="form.balance" :error="$page.errors.balance" required></base-input>
                        <base-input label="كلمة المرور" option="أختياري" type="password" v-model="form.password" :error="$page.errors.password"></base-input>
                        <base-input label="تأكيد كلمة المرور" option="أختياري" type="password"
                                    v-model="form.password_confirmation" :error="$page.errors.password_confirmation"></base-input>
                    </div>
                    <div class="flex justify-end mt-4">
                        <base-button primary>تعديل المستخدم</base-button>
                    </div>
                </form>
            </base-panel>

        </div>

    </layout>
</template>

<script>
    import Layout from "../../../Shared/Layout";

    export default {
        components: {Layout},
        props: ['permissions', 'user'],
        data() {
            return {
                form: {
                    name: '',
                    username: '',
                    phone:'',
                    alt_phone:'',
                    address:'',
                    balance:'',
                    password: '',
                    password_confirmation: '',
                    permission: '',
                }
            }
        },
        created() {
            this.form = this.user;
        },
        methods: {
            submit() {
                this.$inertia.put(this.$route('users.update', this.user.id), this.form);
            }
        }
    }
</script>
