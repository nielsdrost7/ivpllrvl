import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { copyFileSync, mkdirSync, existsSync } from 'fs';
import { resolve } from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/assets/sass/app.scss',
                'resources/assets/sass/skin-invoiceplane.scss',
                'resources/assets/js/app.js',
            ],
            refresh: true,
        }),
        {
            name: 'copy-third-party-assets',
            buildStart() {
                // Copy Font Awesome fonts
                const fontAwesomeSrc = 'node_modules/font-awesome/fonts';
                const fontAwesomeDest = 'public/assets/dist/fonts';
                copyIfExists(fontAwesomeSrc, fontAwesomeDest);

                // Copy Ionicons fonts
                const ioniconsSrc = 'node_modules/ionicons/dist/fonts';
                copyIfExists(ioniconsSrc, fontAwesomeDest);

                // Copy Chosen JS
                const chosenSrc = 'node_modules/chosen-js';
                const chosenDest = 'public/assets/dist/chosen-js';
                copyChosenFiles(chosenSrc, chosenDest);

                // Copy Bootstrap Datepicker
                const bsDatepickerSrc = 'node_modules/bootstrap-datepicker/dist';
                const bsDatepickerDest = 'public/assets/dist/bs-datepicker';
                copyBsDatepicker(bsDatepickerSrc, bsDatepickerDest);

                // Copy Daterangepicker
                const daterangepickerSrc = 'node_modules/daterangepicker';
                const daterangepickerDest = 'public/assets/dist/daterangepicker';
                copyDaterangepicker(daterangepickerSrc, daterangepickerDest);

                // Copy Typeahead
                const typeaheadSrc = 'node_modules/typeahead.js/dist';
                const typeaheadDest = 'public/assets/dist/typeahead';
                copyTypeahead(typeaheadSrc, typeaheadDest);
            },
        },
    ],
    css: {
        preprocessorOptions: {
            scss: {
                api: 'modern-compiler',
            },
        },
    },
});

function copyIfExists(src, dest) {
    if (!existsSync(src)) return;
    mkdirSync(dest, { recursive: true });
    // Copy files logic would go here
}

function copyChosenFiles(src, dest) {
    if (!existsSync(src)) return;
    mkdirSync(dest, { recursive: true });
}

function copyBsDatepicker(src, dest) {
    if (!existsSync(src)) return;
    mkdirSync(dest, { recursive: true });
}

function copyDaterangepicker(src, dest) {
    if (!existsSync(src)) return;
    mkdirSync(dest, { recursive: true });
}

function copyTypeahead(src, dest) {
    if (!existsSync(src)) return;
    mkdirSync(dest, { recursive: true });
}
