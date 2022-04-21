<template>
    <BreezeGuestLayout>
        <Head title="パスワード確認" />

        <div class="mb-4 text-sm text-muted">
            この操作を続けるにはパスワードの確認が必要です。
        </div>

        <BreezeValidationErrors class="mb-4" />

        <form @submit.prevent="submit">
            <div class="mb-3">
                <label for="password" class="form-label">パスワード</label>
                <input type="password" id="password" class="form-control shadow-sm" v-model="form.password" required autofocus autocomplete="current-password">
            </div>

            <div class="float-end">
                <button type="submit" class="btn btn-dark ms-3" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    確認
                </button>
            </div>
        </form>
    </BreezeGuestLayout>
</template>

<script setup>
import BreezeGuestLayout from '@/Layouts/Guest.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';

const form = useForm({
    password: '',
});

const submit = () => {
    form.post(route('password.confirm'), {
        onFinish: () => form.reset(),
    })
};
</script>
