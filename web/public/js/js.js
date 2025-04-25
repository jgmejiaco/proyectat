// js.js

$(document).ready(function () {
    // Inicializa Select2
    $('.select2').select2({
        allowClear: false,
        width: '100%'
    });

    // Abrir el calendario desde el ícono
    $('.input-group-text').on('click', function () {
        const input = $(this).siblings('input[type="date"]');
        input.trigger('focus');
        if (typeof input[0].showPicker === "function") {
            input[0].showPicker();
        }
    });
}); // FIN document.ready

// ===================================================================

// Función global para mostrar nombre de archivo seleccionado
function displaySelectedFile(inputId, displayElementId) {
    const input = document.getElementById(inputId);
    const selectedFile = input.files[0];
    const displayElement = document.getElementById(displayElementId);

    displayElement.textContent = '';
    displayElement.classList.add('hidden');

    if (!selectedFile) return;

    const selectedFileName = selectedFile.name;
    const fileExtension = selectedFileName.split('.').pop().toLowerCase();

    // Paso 1: definir extensiones válidas
    const allowedExtensions = ['pdf', 'doc', 'docx', 'png', 'jpg', 'jpeg'];

    if (!allowedExtensions.includes(fileExtension)) {
        const errorMessage = 'Tipo de archivo no permitido. Solo se permiten: ' + allowedExtensions.join(', ');
        input.value = ''; // limpiar el input
        displayElement.textContent = errorMessage;
        displayElement.classList.remove('hidden');
        return;
    }

    displayElement.textContent = selectedFileName;
    displayElement.classList.remove('hidden');
}
