<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
defineProps({
	history:[]
})
</script>
<template>
	<AppLayout title="History Balance">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Historial de Cargas de Saldo
            </h2>
        </template>
		<table>
			<thead>
				<tr>
					<th>Fecha</th>
					<th>Monto</th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="entry in history" :key="entry.id">
					<td>{{ entry.created_at }}</td>
					<td>{{ entry.amount }}</td>
				</tr>
			</tbody>
		</table>
  	</AppLayout>
</template>