<script setup lang="ts">
defineProps<{
    message?: string;
}>();
</script>

<template>
    <div v-show="message">
        <p class="text-danger">
            {{ message }}
        </p>
    </div>
</template>
