<template>
    <BreezeGuestLayout>
        <Head title="Log in" />

        <BreezeValidationErrors class="mb-4" />

        <div v-if="status" class="alert alert-success mb-4">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div class="mb-3">
                <label for="email" class="form-label">メールアドレス</label>
                <input type="email" id="email" class="form-control shadow-sm" v-model="form.email" required autofocus autocomplete="username">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">パスワード</label>
                <input type="password" id="password" class="form-control shadow-sm" v-model="form.password" required autofocus autocomplete="current-password">
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember" :checked="form.remember">
                <label class="form-check-label" for="remember">次回から自動的にログインする</label>
            </div>

            <div class="float-end">
                <Link v-if="canResetPassword" :href="route('password.request')" class="text-dark">パスワードを忘れた場合</Link>
                <button type="submit" class="btn btn-dark ms-3" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Log in
                </button>
            </div>

        </form>
    </BreezeGuestLayout>
</template>

<script setup>
import BreezeGuestLayout from '@/Layouts/Guest.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>
