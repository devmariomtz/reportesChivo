<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-20 dark:text-white">
                <div class="input-container">
                    <h2 class="py-4 font-semibold">Subir CSV con Drag and Drop</h2>
                    <div id="drop-zone"
                        class="border-2 border-dashed border-gray-300 p-5 text-center text-gray-500 hover:scale-[1.02] transition flex items-center flex-col hover:cursor-pointer hover:border-indigo-500/75 text-indigo-500/75">
                        <img src="/dragdrop.png" alt="" class="">
                        Arrastra y suelta el archivo aquí o haz clic para seleccionarlo
                    </div>
                    <input type="file" name="file" id="file" accept=".csv">
                </div>
                <div id="output-container" class="hidden">
                    output
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dropZone = document.getElementById('drop-zone');
        const fileInput = document.getElementById('file');
        const form = document.getElementById('upload-form');

        dropZone.addEventListener('click', () => {
            fileInput.click();
        });

        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropZone.classList.add('dragover');
        });

        dropZone.addEventListener('dragleave', (e) => {
            e.preventDefault();
            dropZone.classList.remove('dragover');
        });

        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropZone.classList.remove('dragover');
            fileInput.files = e.dataTransfer.files;
            validateFile();
        });

        fileInput.addEventListener('change', () => {
            validateFile();
        });

        function validateFile() {
            // validatar que el archivo sea CSV o que exita
            const file = fileInput.files[0];

            if (!file) {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Enter a file!"
                });
                return;
            }

            if (fileInput.files.length > 1) {
                Swal.fire({
                    icon: "warning",
                    title: "Oops...",
                    text: "You can only enter one file!"
                });
                // limpiar el input
                fileInput.value = '';
                return;
            }

            if (file.name.split('.').pop() !== 'csv') {
                Swal.fire({
                    icon: "warning",
                    title: "Oops...",
                    text: "You can only enter .csv type files.!"
                });
                // limpiar el input
                fileInput.value = '';
                return;
            }

            submitForm();
        }

        function submitForm() {

            const formData = new FormData();
            formData.append('file', fileInput.files[0]);
            formData.append('_token', '{{ csrf_token() }}');
            fetch('/upload-csv', {
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    console.log(response);
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    });
</script>
