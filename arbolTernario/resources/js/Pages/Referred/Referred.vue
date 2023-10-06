<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
defineProps({
	referidos: Array
})
</script>

<template>
    <AppLayout title="Referreds">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
				Referreds
            </h2>
        </template>
		<div class="col-md-12 container mt-4">
			<!-- Lista de referidos del patrocinador -->
			<h4>Tus Referidos</h4>
			<table class="table table-striped table-bordered table-dark">
				<thead>
					<tr>
						<th>ID</th>
						<th>Nombre</th>
						<th>Correo Electrónico</th>
						<th>Nivel</th>
					</tr>
				</thead>
				<tbody>
					<!-- Aquí puedes iterar sobre los referidos del patrocinador y mostrarlos en la tabla -->
					<tr v-for="(referido, index) in referidos">
						<td>{{ referido.id }}</td>
						<td>{{ referido.name }}</td>
						<td>{{ referido.email }}</td>
						<td>{{ referido.level }}</td>
					</tr>
					
				</tbody>
			</table>
		</div>
    </AppLayout>
</template>