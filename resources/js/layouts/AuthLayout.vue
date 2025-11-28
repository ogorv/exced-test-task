<template>
    <main class="main-container">
        <slot />
    </main>
</template>

<style lang="scss" scoped>
.main-container {
    display: flex;
    align-items: center;
    padding-top: 40px;
    padding-bottom: 40px;
    background-color: #f5f5f5;
    min-height: 100vh;
}
</style>
