<script setup lang="ts">
import SidebarMenu from '@/components/SidebarMenu.vue';
import Navbar from '@/components/Navbar.vue';
import { User } from '@/types';
import { defineProps } from 'vue';

interface Props {
    user: User;
}

defineProps<Props>();
</script>

<template>
    <Navbar :user="user" />
    <div class="container-fluid">
        <div class="row">
            <SidebarMenu />

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <slot />
            </main>
        </div>
    </div>
</template>

