<template>
   <BreezeGuestLayout>
        <Head title="Email Verification" />
        <div class="mb-4 text-sm text-muted">
            Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.
        </div>

        <div class="alert alert-success mb-4" v-if="verificationLinkSent" >
            A new verification link has been sent to the email address you provided during registration.
        </div>

        <form @submit.prevent="submit">
            <div class="float-end">
                <Link :href="route('logout')" method="post" class="text-dark">Log Out</Link>

                <button type="submit" class="btn btn-dark ms-3" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Resend Verification Email
                </button>
            </div>
        </form>
   </BreezeGuestLayout>
</template>

<script setup>
import { computed } from 'vue';
import BreezeGuestLayout from '@/Layouts/Guest.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

const props = defineProps({
    status: String,
});

const form = useForm();

const submit = () => {
    form.post(route('verification.send'));
};

const verificationLinkSent = computed(() => props.status === 'verification-link-sent');
</script>
