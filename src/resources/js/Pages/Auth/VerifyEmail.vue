<template>
   <BreezeGuestLayout>
        <Head title="Email Verification" />
        <div class="mb-4 text-sm text-muted">
            ご登録ありがとうございます！登録確認メールを送信しましたので、メール内のボタンをクリックし登録メールアドレスが正しい事を確認して下さい。メールが届かない場合は以下のボタンから再送信をお試し下さい。
        </div>

        <div class="alert alert-success mb-4" v-if="verificationLinkSent" >
            確認メールを再送信しました。
        </div>

        <form @submit.prevent="submit">
            <div class="float-end">
                <Link :href="route('logout')" method="post" class="text-dark">ログアウト</Link>

                <button type="submit" class="btn btn-dark ms-3" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    再送信する
                </button>
            </div>
        </form>
   </BreezeGuestLayout>
</template>

<script setup>
import { computed } from 'vue';
import BreezeGuestLayout from '@/Layouts/Guest.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    status: String,
});

const form = useForm();

const submit = () => {
    form.post(route('verification.send'));
};

const verificationLinkSent = computed(() => props.status === 'verification-link-sent');
</script>
