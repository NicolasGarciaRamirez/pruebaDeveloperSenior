<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';

defineProps({
	products:[]
})
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
					Products
					<div class="bg-white rounded-lg shadow-lg overflow-hidden" v-for="product, index in products" :key="index">
						<img class="w-full h-64 object-cover" src="imagen.jpg" alt="Imagen de la tarjeta">
						<div class="px-6 py-4">
							<div class="font-bold text-xl mb-2">{{ product.name }}</div>
							<p class="text-gray-700 text-base">
								{{ product.description }}
							</p>
						</div>
						<div class="px-6 py-4">
							<span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">{{ product.price }}</span>
							<span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">Etiqueta 2</span>
							<span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700">Etiqueta 3</span>
						</div>
					</div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
