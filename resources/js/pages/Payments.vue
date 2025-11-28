<script setup lang="ts">
import Table from '@/components/Table.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { Payment, User } from '@/types';
import { Form } from '@inertiajs/vue3';
import { defineProps } from 'vue';

interface Props {
    auth: {
        user: User;
    };
    payments: Payment[];
}

defineProps<Props>();

const lastPaymentsTableHeaders = ['Type', 'Amount', 'Description', 'Date'];
</script>

<template>
    <AppLayout :user="auth.user">
        <h2 class="mb-3 mt-3">Payments</h2>
        <Form
            :options="{
                preserveState: true,
                preserveUrl: true,
            }"
            action="/payments"
            method="get"
            class="mb-4"
        >
            <div class="row g-3 align-items-center">
                <div class="col-auto">
                    <label for="description" class="col-form-label">Description:</label>
                </div>
                <div class="col-auto">
                    <input type="text" name="description" class="form-control form-control-sm" id="description" />
                </div>
            </div>

            <div class="row g-3 align-items-center">
                <div class="col-auto">
                    <label for="sort-by" class="col-form-label">Sort by date:</label>
                </div>
                <div class="col-auto">
                    <select id="sort-by" name="sort" class="form-select form-select-sm">
                        <option selected value="desc">DESC</option>
                        <option value="asc">ASC</option>
                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-sm btn-primary">Search</button>
        </Form>
        <div v-if="payments.length">
            <div class="table-responsive">
                <Table :items="payments" :headers="lastPaymentsTableHeaders" />
            </div>
        </div>
        <div v-else>
            <p class="text-center">No data</p>
        </div>
    </AppLayout>
</template>
