<script setup>
import { useForm } from '@inertiajs/vue3';
import ActionMessage from '@/Components/ActionMessage.vue';
import FormSection from '@/Components/FormSection.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const createProductForm = useForm({
    name: '',
    permissions: props.defaultPermissions,
});
const createApiToken = () => {
    createProductForm.post(route('products.store'), {
        preserveScroll: true,
        onSuccess: () => {
            displayingToken.value = true;
            createProductForm.reset();
        },
    });
};
</script>
<template>
	<FormSection @submitted="createApiToken">
		<template #title>
		</template>

		<template #description>
		</template>

		<template #form>
			<!-- Token Name -->
			<div class="col-span-6 sm:col-span-4">
				<InputLabel for="name" value="Name" />
				<TextInput
					id="name"
					v-model="createApiTokenForm.name"
					type="text"
					class="mt-1 block w-full"
					autofocus
				/>
				<InputError :message="createApiTokenForm.errors.name" class="mt-2" />
			</div>
		</template>

		<template #actions>
			<ActionMessage :on="createApiTokenForm.recentlySuccessful" class="mr-3">
				Created.
			</ActionMessage>

			<PrimaryButton :class="{ 'opacity-25': createApiTokenForm.processing }" :disabled="createApiTokenForm.processing">
				Create
			</PrimaryButton>
		</template>
	</FormSection>
</template>