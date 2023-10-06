<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
defineProps({
	users: Array
})
</script>
<template>
	 <AppLayout title="Referreds">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
				Referreds
            </h2>
        </template>
		<div class="container mt-4">
			<div v-for="(levelUsers, levelIndex) in users" :key="levelIndex" class="row mt-4 justify-content-center">
				<div v-for="(user, userIndex) in levelUsers" :key="userIndex" class="node" :class="`node-level-${levelIndex + 2}`">
					<div class="d-flex flex-column">
						<div class="d-flex justify-content-center align-items-center">
							<img :src="user.profile_photo_url" class="img-fluid my-2" style="border-radius: 100%;"> 
						</div>
						<div class="d-flex flex-column justify-content-center align-items-center">
							<span v-if="user.patrocinador">
								<b>Patrocinador:</b> {{ user.patrocinador?.name }}
							</span>
							<span>
								<b>Level:</b> {{ user.level }}
							</span>
						</div>
					</div>
					<div class="connector"></div>
				</div>
			</div>
  		</div>
	</AppLayout>	
</template>