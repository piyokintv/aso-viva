<template>
    <div class="position-absolute top-0 min-vh-100 min-vw-100 bg-light">
        <div class="container">
            <div class="mt-5">
                <div class="row">
                    <div class="col d-flex justify-content-center">
                        <Link href="/">
                            <BreezeApplicationLogo style="width: 100px; height: 100px;" />
                        </Link>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-6 offset-3">
                        <div class="card shadow-sm p-3 mb-5 bg-body rounded">
                            <div class="card-body">
                                <slot />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script setup>
import BreezeApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>
