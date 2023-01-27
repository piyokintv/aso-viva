<template>
    <BreezeGuestLayout>
        <Head title="Forgot Password" />
        <div class="mb-4 text-sm text-secondary">
            登録時のメールアドレスを入力して下さい。パスワード再設定用のURLをメールでお送りします。
        </div>

        <div v-if="status" class="alert alert-success mb-4">
            {{ status }}
        </div>

        <BreezeValidationErrors class="mb-4" />

        <form @submit.prevent="submit">
            <div class="mb-3">
                <label for="email" class="form-label">メールアドレス</label>
                <input type="email" id="email" class="form-control shadow-sm" v-model="form.email" required autofocus autocomplete="username">
            </div>

            <div class="float-end">
                <button type="submit" class="btn btn-dark ms-3" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    メール送信
                </button>
            </div>
        </form>
    </BreezeGuestLayout>
</template>

<script setup>
import BreezeGuestLayout from '@/Layouts/Guest.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import { Head, useForm } from '@inertiajs/vue3';

defineProps({
    status: String,
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>
