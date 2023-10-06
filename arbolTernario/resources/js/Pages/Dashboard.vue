<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Clients from '@/Pages/Clients/Clients.vue'
import { ref, onMounted } from "vue";
defineProps({
	clients: Array
})
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
				Dashboard - list Clients
            </h2>
        </template>

		<Clients :clients="clients"></Clients>

    </AppLayout>
</template>
