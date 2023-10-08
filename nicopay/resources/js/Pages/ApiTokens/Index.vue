<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Api Tokens {{ apiToken.name }}
            </h2>
        </template>
        <div class="flex flex-col space-y-4 p-4">
            <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4">
                <div class="w-full md:w-1/2">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        Clave API Pública: 
                    </label>
                    <div class="relative">
                        <input
                            v-model="apiKeyPublic"
                            class="border rounded-lg py-2 px-3 w-full bg-gray-100 focus:outline-none focus:ring focus:border-blue-300"
                            @blur="onBlur('apiKeyPublic')"
                            readonly
                        />
                        <button
                            class="absolute top-0 right-0 mt-2 mx-3 p-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:ring focus:bg-blue-600"
                            @click="toggleApiKeyVisibility"
                        >
							<i v-if="showApiKeyPublic" class="fa-solid fa-eye"></i>
							<i v-else class="fa-solid fa-eye-slash"></i>
                        </button>
                        <button
                            class="absolute top-0 right-12 mt-2 mx-3 p-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:ring focus:bg-blue-600"
                            @click="copyToClipboard(apiToken.key_public)"
                        >
							<i class="fa-solid fa-copy"></i>
                        </button>
                    </div>
                </div>
                <div class="w-full md:w-1/2">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        Clave Secreta API:
                    </label>
					<div class="relative w-full">
						<input
							v-model="apiSecretPublic"
							class="border rounded-lg py-2 px-3 w-full bg-gray-100 focus:outline-none focus:ring focus:border-blue-300"
							@blur="onBlur('apiSecretPublic')"
							readonly
						/>
						<button
							class="absolute top-2 right-2 p-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:ring focus:bg-blue-600"
							@click="toggleApiSecretVisibility"
						>
							<i v-if="showApiSecretPublic" class="fa-solid fa-eye"></i>
							<i v-else class="fa-solid fa-eye-slash"></i>
						</button>
						<button
							class="absolute top-2 right-10 p-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:ring focus:bg-blue-600"
							@click="copyToClipboard(apiToken.key_secret)"
						>
							<i class="fa-solid fa-copy"></i>
						</button>
					</div>
				</div>
            </div>
            <div v-if="showCopiedMessage" class="text-green-600">
                Clave copiada al portapapeles
            </div>
        </div>
    </AppLayout>
</template>

<script>
import { ref } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';

export default {
    props: {
        apiToken: Object,
		user: Object
    },
    components: { AppLayout },
    setup(props) {
        const apiKeyPublic = ref('*************************************************************************');
        const apiSecretPublic = ref('*************************************************************************');
        const showApiKeyPublic = ref(false);
        const showApiSecretPublic = ref(false);
        const showCopiedMessage = ref(false);

        const onBlur = (fieldName) => {
            // Aquí puedes realizar alguna acción cuando el campo pierde el foco
            console.log(`Campo ${fieldName} perdió el foco`);
        };

        const toggleApiKeyVisibility = () => {
            showApiKeyPublic.value = !showApiKeyPublic.value;
			if (showApiKeyPublic.value){
				apiKeyPublic.value = props.apiToken.key_public
			}else{
				apiKeyPublic.value = '*************************************************************************'
			}

        };

        const toggleApiSecretVisibility = () => {
            showApiSecretPublic.value = !showApiSecretPublic.value;
			if (showApiSecretPublic.value){
				apiSecretPublic.value = props.apiToken.key_secret
			}else{
				apiSecretPublic.value = '*************************************************************************'
			}
        };

        const copyToClipboard = (text) => {
			console.log(text)
            const textField = document.createElement('textarea');
            textField.innerText = text;
            document.body.appendChild(textField);
            textField.select();
            document.execCommand('copy');
            textField.remove();
            showCopiedMessage.value = true;
            setTimeout(() => {
                showCopiedMessage.value = false;
            }, 3000);
        };

        return {
            apiKeyPublic,
            apiSecretPublic,
            showApiKeyPublic,
            showApiSecretPublic,
            showCopiedMessage,
            onBlur,
            toggleApiKeyVisibility,
            toggleApiSecretVisibility,
            copyToClipboard
        };
    },
};
</script>