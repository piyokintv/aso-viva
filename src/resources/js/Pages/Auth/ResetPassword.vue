<template>
    <BreezeGuestLayout>
        <Head title="Reset Password" />

        <BreezeValidationErrors class="mb-4" />

        <form @submit.prevent="submit">
            <div class="mb-3">
                <label for="email" class="form-label">メールアドレス</label>
                <input type="email" id="email" class="form-control shadow-sm" v-model="form.email" required autofocus autocomplete="username">
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
                    パスワード再設定
                </button>
            </div>
        </form>

    </BreezeGuestLayout>
</template>

<script setup>
import BreezeGuestLayout from '@/Layouts/Guest.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
    email: String,
    token: String,
});

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('password.update'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>
