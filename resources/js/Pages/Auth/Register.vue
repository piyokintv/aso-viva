<template>
    <BreezeGuestLayout>
        <Head title="Register" />

        <BreezeValidationErrors class="mb-4" />

        <form @submit.prevent="submit">
            <div class="mb-3">
                <label for="name" class="form-label">ユーザー名</label>
                <input type="text" id="name" class="form-control shadow-sm" v-model="form.name" required autofocus autocomplete="name">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">メールアドレス</label>
                <input type="email" id="email" class="form-control shadow-sm" v-model="form.email" required autocomplete="username">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">パスワード</label>
                <input type="password" id="password" class="form-control shadow-sm" v-model="form.password" required autocomplete="new-password">
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">パスワード（確認）</label>
                <input type="password" id="password_confirmation" class="form-control shadow-sm" v-model="form.password_confirmation" required autocomplete="new-password">
            </div>

            <div class="float-end">
                <Link :href="route('login')" class="text-dark">登録済みの場合はこちら</Link>
                <button type="submit" class="btn btn-dark ms-3" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    登録
                </button>
            </div>

        </form>
    </BreezeGuestLayout>
</template>

<script setup>
import BreezeGuestLayout from '@/Layouts/Guest.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    terms: false,
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>
