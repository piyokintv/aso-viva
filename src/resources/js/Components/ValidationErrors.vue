<template>
    <div v-if="hasErrors" class="alert alert-danger">
        <p>おっと! 問題が発生しました。</p>

        <ul class="mb-0">
            <li v-for="(error, key) in errors" :key="key">{{ error }}</li>
        </ul>
    </div>
</template>

<script setup>
import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';

const errors = computed(() => usePage().props.errors);

const hasErrors = computed(() => Object.keys(errors.value).length > 0);
</script>
