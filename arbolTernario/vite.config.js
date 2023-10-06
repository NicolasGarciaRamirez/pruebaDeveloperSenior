import { defineConfig } from 'vite';
import laravel, {refreshPaths} from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import path from 'path';

export default defineConfig({
	resolve: {
		alias: {
			'@~': path.resolve(__dirname, '/'),
		  	'@': path.resolve(__dirname, 'resources/js'),
			'vue': 'vue/dist/vue.esm-bundler.js',
			'~images': path.resolve(__dirname, 'public/images'),
			'~fonts' : path.resolve(__dirname, 'public/fonts'),
			'~' : path.resolve(__dirname, 'node_modules/'),

		},
	},
	server: {
        hmr: {
            host: 'localhost',
        },
    },
    plugins: [
        laravel({
            input: [
				'resources/sass/app.scss',
				'resources/js/app.js',
			],
			refresh: [
                ...refreshPaths,
                'app/Http/Livewire/**',
            ],
        }),
        vue(),
    ],
});
