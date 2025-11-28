<script setup lang="ts">
import IconHome from '@/components/icon/IconHome.vue';
import IconHomeBarChart2 from '@/components/icon/IconHomeBarChart2.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
        <div class="position-sticky pt-3">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <Link :href="route('dashboard')" :class="{ active: $page.url === '/' }" class="nav-link">
                        <IconHome />
                        Dashboard
                    </Link>
                </li>
                <li class="nav-item">
                    <Link :href="route('payments')" :class="{ active: $page.url === '/payments' }" class="nav-link">
                        <IconHomeBarChart2 />
                        Payments
                    </Link>
                </li>
            </ul>
        </div>
    </nav>
</template>

<style scoped lang="scss">
.feather {
    width: 16px;
    height: 16px;
    vertical-align: text-bottom;
}
.sidebar {
    font-size: 0.875rem;
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    z-index: 100; /* Behind the navbar */
    padding: 48px 0 0; /* Height of navbar */
    box-shadow: inset -1px 0 0 rgba(0, 0, 0, 0.1);
}

@media (max-width: 767.98px) {
    .sidebar {
        top: 5rem;
    }
}

.sidebar .nav-link {
    font-weight: 500;
    color: #333;
}

.sidebar .nav-link .feather {
    margin-right: 4px;
    color: #727272;
}

.sidebar .nav-link.active {
    color: #2470dc;
}

.sidebar .nav-link:hover .feather,
.sidebar .nav-link.active .feather {
    color: inherit;
}
</style>
