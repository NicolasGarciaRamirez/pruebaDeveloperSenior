<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
defineProps({
	sponsor: Object
})
</script>

<template>
    <AppLayout title="Sponsors">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
				Sponsor
            </h2>
        </template>
		<!-- Contenido del perfil del patrocinador -->
		<div class="container mt-4">
			<div class="row" v-if="sponsor">
				<div class="col-md-4">
					<!-- Información del patrocinador -->
					<div class="card">
						<div class="card-body">
							<h5 class="card-title">Perfil del Patrocinador</h5>
							<div class="d-flex flex-column justify-content-start align-items-start">
								<img class="img-fluid" :src="sponsor?.profile_photo_url" style="width: 5rem;">
								<span class="card-text"><b>Nombre:</b> {{ sponsor?.name }}</span>
								<span class="card-text"><b>Correo Electrónico:</b> {{ sponsor?.email }}</span>
								<span class="card-text"><b>Nivel:</b> {{ sponsor?.level }}</span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-8">
					<!-- Lista de referidos del patrocinador -->
					<h4>Referidos del Patrocinador</h4>
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
							<tr v-for="(referido, index) in sponsor.referidos">
								<td>{{ referido.id }}</td>
								<td>{{ referido.name }}</td>
								<td>{{ referido.email }}</td>
								<td>{{ referido.level }}</td>
							</tr>
							
						</tbody>
					</table>
				</div>
			</div>
			<div v-else>
				No Fuiste Ingresado Por Un Patrocinador
			</div>
		</div>
    </AppLayout>
</template>