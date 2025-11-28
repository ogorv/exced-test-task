<script setup lang="ts">
import { defineProps } from 'vue';

defineProps({
    headers: {
        type: Array,
        required: true,
    },
    items: {
        type: Array,
        required: true,
    },
});
</script>

<template>
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th v-for="header in headers" :key="header" scope="col">{{ header }}</th>
            </tr>
        </thead>
        <tbody>
        <tr v-for="(row, rowIndex) in items" :key="rowIndex">
            <td v-for="(value, key) in row" :key="key">{{ value }}</td>
        </tr>
        </tbody>
    </table>
</template>
