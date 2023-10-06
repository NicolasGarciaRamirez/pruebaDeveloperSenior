<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import ModalClient from '@/Pages/Clients/Components/ModalClient.vue'
import { ref, onMounted } from "vue";

	defineProps({
		clients: Array
	});

	

	const initializeDataTable = () => {
		console.log()
		$("#clientesTable").DataTable({
			processing: true,
			serverSide: true,
			ajax: '/Clients',
			columns: [
				{ data: "id" },
				{ data: "name" },
				{ data: "email" },
				{ data: "patrocinador_name" }
			],
		});
		return {};

	};

	const openModal = () => {
		const MODAL = newModal('modalClient', {
			keyboard: false,
			backdrop: true
		});
		console.log(MODAL, 'openModal')
		MODAL.show()
	};

	const closeModal = () => {
		MODAL.toggle()
	};


	onMounted(() => {
		initializeDataTable()
	});


</script>

<template>
	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="bg-white p-4 overflow-hidden shadow-xl sm:rounded-lg">
				<div class="table-responsive">
					<button type="button" class="btn btn-primary m-2" @click="openModal()">New Client</button>
					<table id="clientesTable" class="table table-striped table-bordered table-dark">
						<thead>
							<tr>
								<th>Id</th>
								<th>Nombre</th>
								<th>Correo Electrónico</th>
								<th>Patrocinador</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
	<modal-client></modal-client>
</template>
