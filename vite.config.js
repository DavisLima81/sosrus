import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
            refreshPaths: [
                'app/**/*.php',
                'resources/views/**/*.php',
                'resources/js/**/*.js',
                'resources/css/**/*.css',
                'resources/sass/**/*.scss',
                'resources/sass/**/*.sass',
                'resources/sass/**/*.less',
                'resources/sass/**/*.styl',
                'resources/sass/**/*.pcss',
                'resources/sass/**/*.postcss',
                'resources/sass/**/*.sss',
                'resources/sass/**/*.css',
                'app/Filament/**/*.php',
                'resources/views/filament/**/*.blade.php',
                'vendor/filament/**/*.blade.php',
                'app/Livewire/**'
            ]
        }),
    ],
});
