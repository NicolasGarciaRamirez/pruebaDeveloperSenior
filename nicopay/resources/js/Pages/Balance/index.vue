<template>
	<AppLayout title="Balance">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Balance
            </h2>
        </template>

		<FormSection @submitted="loadBalance" class="p-4">
			<template #title>
				Cargar Balance
			</template>

			<template #description>
				Aca podras cargar el saldo de tu cuenta <br>
				<span v-if="user.balance">
					saldo actual: {{ user.balance.amount }}
				</span>
				
			</template>
			
			<template #form>
				<div class="col-span-6 sm:col-span-4">
					<InputLabel for="Amount" value="Monto A Cargar" />
					<CurrencyInput
						class="mt-1 w-full"
						id="Amount"
						ref="amountInput"
						v-model="form.amount"
						:options="{ currency: 'COP' }"
					/>
					<InputError :message="form.errors.Amount" class="mt-2" />
				</div>
			</template>

			<template #actions>
				<ActionMessage :on="form.recentlySuccessful" class="mr-3">
					Saved.
				</ActionMessage>

				<PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
					Save
				</PrimaryButton>
			</template>
		</FormSection>
	</AppLayout>
</template>
  

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';
import ActionMessage from '@/Components/ActionMessage.vue';
import FormSection from '@/Components/FormSection.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import CurrencyInput from '@/Components/CurrencyInput.vue';

defineProps({
	user:{}
});

const form = useForm({
	amount: 0
});

const loadBalance = () => {
	form.post(route('Balance.store'), {
        errorBag: 'cardSaved',
        preserveScroll: true,
        onSuccess: () => {
			this.$refs.amountInput.focus();
			form.amount = 0
			form.reset()
		}
    });
}

</script>
  