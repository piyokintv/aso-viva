<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <div class="card shadow-sm">
            <div class="card-body">
                You're logged in!
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
</script>
