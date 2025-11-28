<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { router } from '@inertiajs/vue3';
import { defineProps, onMounted, onUnmounted } from 'vue';
import { Payment, User } from '@/types';
import Table from '@/components/Table.vue';

interface Props {
    auth: {
        user: User;
    };
    balance: string;
    payments: Payment[];
}

defineProps<Props>();

let autoReloadInterval: number;

onMounted(() => {
    autoReloadInterval = setInterval(() => router.reload(), 5000);
});

onUnmounted(() => {
    clearInterval(autoReloadInterval);
});

const lastPaymentsTableHeaders = ['Type', 'Amount', 'Description', 'Date'];
</script>

<template>
    <AppLayout :user="auth.user">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <p class="border border-info p-2">
                Current balance: <span class="balance">{{ balance }}</span>
            </p>
        </div>

        <div v-if="payments.length">
            <h2 class="mb-3">Last payments</h2>
            <div class="table-responsive">
                <Table :items="payments" :headers="lastPaymentsTableHeaders" />
            </div>
        </div>
    </AppLayout>
</template>

<style scoped>
.balance {
    font-weight: bold;
}
</style>
