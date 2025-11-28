<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { defineProps } from 'vue';
import { User } from '@/types';
import { inject } from 'vue';

interface Props {
    user: User;
}

defineProps<Props>();

const route = inject('route');
</script>

<template>
    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Company name</a>
        <button
            class="navbar-toggler position-absolute d-md-none collapsed"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#sidebarMenu"
            aria-controls="sidebarMenu"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-info w-100 p-3">
            <span>Hello {{user.login}}</span>
        </div>
        <div class="navbar-nav">
            <div class="nav-item text-nowrap">
                <Link :href="route('logout')" class="nav-link px-3">Sign out</Link>
            </div>
        </div>
    </header>
</template>

<style scoped lang="scss">
/*
 * Navbar
 */
.navbar-brand {
    padding-top: 0.75rem;
    padding-bottom: 0.75rem;
    font-size: 1rem;
    background-color: rgba(0, 0, 0, 0.25);
    box-shadow: inset -1px 0 0 rgba(0, 0, 0, 0.25);
}

.navbar .navbar-toggler {
    top: 0.25rem;
    right: 1rem;
}

.navbar-info {
    color: #fff;
}
</style>
