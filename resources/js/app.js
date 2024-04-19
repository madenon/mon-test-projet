import "./bootstrap";

import Alpine from "alpinejs";
// import "filepond/dist/filepond.min.css";
// import "filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.css";
import FilePondPluginFileValidateType from "filepond-plugin-file-validate-type";
window.Alpine = Alpine;

Alpine.start();

FilePond.registerPlugin(FilePondPluginFileValidateType);

const inputElement = document.querySelector('input[type="file"]');
FilePond.create(inputElement, {
    acceptedFileTypes: ["image/jpeg", "image/png"],
    server: {
        process: {
            url: "/upload-image", // Créez une route pour gérer le téléchargement d'images.
            headers: {
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
            },
        },
    },
});


