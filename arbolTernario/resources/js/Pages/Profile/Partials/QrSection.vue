<script setup>
import { Link, router, useForm } from '@inertiajs/vue3';
import FormSection from '@/Components/FormSection.vue';
import ActionMessage from '@/Components/ActionMessage.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import QRCodeVue3 from "qrcode-vue3";

const props = defineProps({
    user: Object,
});

const form = useForm({
    _method: 'PUT',
    name: props.user?.name,
    email: props.user?.email,
    photo: null,
});
</script>

<template>
	<FormSection >
        <template #title>
			Codigo De Referido
        </template>

        <template #description>
            Comparte este codigo con tus amigos para obtener ganancias!!
        </template>

        <template #body>
			<div class="d-flex justify-content-center align-items-center">
				<QRCodeVue3
					:width="200"
					:height="200"
					:value="`localhost:8031/Register/1`"
					fileExt="png"
					:download="true"
					myclass="my-qur"
					imgclass="img-qr"
					downloadButton="my-button"
					:downloadOptions="{ name: 'qrCode', extension: 'png' }"
				/>
			</div>

        </template>

        <template #actions>
            <ActionMessage :on="form.recentlySuccessful" class="mr-3">
                Download.
            </ActionMessage>

            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Download
            </PrimaryButton>
        </template>
    </FormSection>
</template>