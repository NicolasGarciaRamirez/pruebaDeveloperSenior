<script setup>
import AppLayout from '../../Layouts/AppLayout.vue';
defineProps({
	user:{},
	transactions: [],
})
</script>
<template>
	<AppLayout title="Transactions">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Transactions
            </h2>
        </template>
		<div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
					<table class="min-w-full divide-y divide-gray-200">
						<thead>
							<tr>
								<th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
									Name
								</th>
								<th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
									Amount
								</th>
								<th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
									Description
								</th>
								<th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
									Date
								</th>
							</tr>
						</thead>
						<tbody class="bg-white divide-y divide-gray-200">
							<!-- Aquí agregar filas de datos -->
							<tr  v-for="entry, index in transactions.data" :key="index" >
								<td class="px-6 py-4 whitespace-nowrap">
									{{ entry.name }}
								</td>
								<td class="px-6 py-4 whitespace-nowrap">
									{{ entry.amount }}
								</td>
								<td class="px-6 py-4 whitespace-nowrap">
									{{ entry.description }}
								</td>
								<td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
									{{ entry.created_at }}
								</td>
							</tr>
							<tr class="text-center" v-if="transactions.data.lenght <= 0">
								<td colspan="4">No Has Realizado Ninguna Transaction</td>
							</tr>
							<!-- Agregar más filas según tus datos -->
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</AppLayout>
</template>