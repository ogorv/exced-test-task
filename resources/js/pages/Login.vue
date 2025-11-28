<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { Form, Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Log in" />
    <AuthLayout>
        <div class="form-signin">
            <Form action="/login" method="post" :reset-on-success="['password']" v-slot="{ errors, processing }">
                <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

                <div class="form-floating">
                    <input type="text" class="form-control" id="loginInput" name="login" placeholder="Login" />
                    <label for="loginInput">Login</label>
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password" />
                    <label for="floatingPassword">Password</label>
                </div>

                <button :disabled="processing" class="w-100 btn btn-lg btn-primary mb-3" type="submit">Sign in</button>
                <InputError :message="errors.login" />
            </Form>
        </div>
    </AuthLayout>
</template>

<style lang="scss" scoped>
.form-signin {
    width: 100%;
    max-width: 330px;
    padding: 15px;
    margin: auto;
    text-align: center;
}
</style>
