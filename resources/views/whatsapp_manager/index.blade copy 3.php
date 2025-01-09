@extends('adminlte::page')

@section('title', 'Whatsapp API Cloud Manager')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Whatsapp API Cloud Manager</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Whatsapp API Cloud Manager</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    <!-- Main content -->
    {{-- @livewire('whatsapp.index') --}}
    <livewire:whatsapp.index />
    <!-- /.content -->
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <style>
        .message-content {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 200px; /* Ajusta el ancho según tus necesidades */
            display: inline-block;
            vertical-align: middle;
        }


        /* .plantillas {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 10px;
        } */

        .plantilla-card {
            /* background-color: #ffffff; */
            background: beige;
            margin-bottom: 10px;
            border-radius: 10px;
            padding: 15px;
            width: 300px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            font-family: Arial, sans-serif;
            color: #333;
            /* flex: 1 1 calc(33% - 10px);
            min-width: 250px;
            box-sizing: border-box; */
        }

        .plantilla-card-header {
            /* background: green;  */
            color: white;
            width: 100%;
        }

        .plantilla-card-content {
            width: 100%;
        }

        .plantilla-title {
            background-color: green;
            color: white;
        }

        .plantilla-header {
            font-weight: bold;
            margin-bottom: 10px;
            font-size: 16px;
        }

        .plantilla-header span {
            overflow-wrap: break-word;
            text-align: initial;
        }

        .plantilla-body {
            font-size: 14px;
            line-height: 1.6;
        }

        .plantilla-body span {
            overflow-wrap: break-word;
            text-align: initial;
        }

        .plantilla-footer {
            margin-top: 10px;
            font-size: 12px;
            color: #777;
        }

        .plantilla-time {
            font-size: 12px;
            color: #999;
            text-align: right;
            margin-top: 10px;
        }

        .plantilla-button {
            background-color: #25d366;
            color: white;
            text-align: center;
            padding: 10px;
            border-radius: 5px;
            margin-top: 10px;
            cursor: pointer;
            text-decoration: none;
            display: block;
        }

        .plantilla-button a {
            color: white;
            cursor: pointer;
            text-decoration: none;
        }

        .plantilla-button:hover {
            background-color: #1eb954;
        }

        .wb-template {
            /* width: 250px; */
            /* background: beige; */
            /* padding: 20px; */
        }
    </style>
    <!-- Scripts -->
    @vite(['resources/css/app.css'])
@stop

@section('js')
    @vite(['resources/js/app.js'])

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const editTemplateVariable = document.getElementById('editTemplateVariable');
            const createTemplateVariable = document.getElementById('createTemplateVariable');
            const variableFields = document.querySelectorAll('.variable');
            const bodyTextFields = document.querySelectorAll('#editBodyText, #createBodyText');
            const editTemplateHeader = document.getElementById('editTemplateHeader');
            const createTemplateHeader = document.getElementById('createTemplateHeader');
            const buttonsContainer = document.querySelector('.buttons_groug');

            bodyTextFields.forEach(field => {
                const validationMessage = document.createElement('div');
                validationMessage.className = 'text-danger mt-2';
                validationMessage.style.display = 'none';
                validationMessage.textContent = 'El texto debe contener un mínimo de palabras según el número de variables.';
                field.parentNode.insertBefore(validationMessage, field.nextSibling);
            });

            variableFields.forEach(field => {
                let variableCounter = 0;

                field.addEventListener('input', function (e) {
                    const value = e.target.value;
                    const cursorPosition = e.target.selectionStart;
                    const variableType = field.closest('form').id === 'editTemplateForm' ? editTemplateVariable.value : createTemplateVariable.value;

                    if (value.includes('@{{', cursorPosition - 2)) {
                        variableCounter++;
                        let variable = '';
                        if (variableType === 'number') {
                            variable = `@{{${variableCounter}}}`;
                        } else if (variableType === 'name') {
                            variable = `@{{variable_${variableCounter}}}`;
                        }

                        e.target.value = value.slice(0, cursorPosition - 2) + variable + value.slice(cursorPosition);
                        e.target.setSelectionRange(cursorPosition + variable.length - 2, cursorPosition + variable.length - 2);

                        const maxVariables = getMaxVariables(field);

                        if (field.classList.contains('variable-1') || field.classList.contains('variable-5') || field.classList.contains('variable-0')) {
                            const variables = e.target.value.match(/@{{[^}]+}}/g);
                            if (variables && variables.length > maxVariables) {
                                e.target.value = variables.slice(0, maxVariables).join(' ');
                            }
                        }

                        if (field.classList.contains('variable-0')) {
                            e.target.value = e.target.value.replace(/@{{[^}]+}}/g, '');
                        }

                        // Reemplazar @{{ por {{
                        e.target.value = e.target.value.replace(/@{{/g, '{{');
                    }

                    updateExampleFields(field, variableType);

                    if (field.id === 'editBodyText' || field.id === 'createBodyText') {
                        validateBodyText(field, field.nextElementSibling);
                    }
                });
            });

            function getMaxVariables(field) {
                if (field.classList.contains('variable-1')) return 1;
                if (field.classList.contains('variable-5')) return 5;
                if (field.classList.contains('variable-10')) return 10;
                if (field.classList.contains('variable-0')) return 0;
                return Infinity; // For variable-n or no specific limit
            }

            function updateExampleFields(field, variableType) {
                const variables = field.value.match(/{{[^}]+}}/g) || [];
                const exampleContainer = field.nextElementSibling;

                // Clear existing example fields
                while (exampleContainer && exampleContainer.firstChild) {
                    exampleContainer.removeChild(exampleContainer.firstChild);
                }

                variables.forEach((variable, index) => {
                    const exampleFieldId = `${field.id}_example_${index + 1}`;
                    if (!document.getElementById(exampleFieldId)) {
                        const exampleField = document.createElement('input');
                        exampleField.type = 'text';
                        exampleField.id = exampleFieldId;
                        exampleField.name = `${field.name}_example_${index + 1}`;
                        exampleField.className = 'form-control mt-2';
                        exampleField.placeholder = `Texto de ejemplo para ${variable}`;

                        exampleContainer.appendChild(exampleField);
                    }
                });
            }

            function validateBodyText(bodyText, validationMessage) {
                const text = bodyText.value;
                const cleanText = text.replace(/@{{\d+}}/g, '').trim();
                const wordsCount = cleanText.split(/\s+/).filter(Boolean).length;
                const variablesCount = (text.match(/@{{\d+}}/g) || []).length;

                let minWordsRequired;
                switch (variablesCount) {
                    case 1: minWordsRequired = 2; break;
                    case 2: minWordsRequired = 5; break;
                    case 3: minWordsRequired = 7; break;
                    case 4: minWordsRequired = 9; break;
                    case 5: minWordsRequired = 11; break;
                    default: minWordsRequired = 0;
                }

                validationMessage.style.display = variablesCount > 0 && wordsCount < minWordsRequired ? "block" : "none";
            }

            // function handleHeaderChange(event) {
            //     const selectedValue = event.target.value;
            //     const formId = event.target.closest('form').id;

            //     const headerTextGroup = document.querySelector(`#${formId} #headerTextGroup`);
            //     const headerImageGroup = document.querySelector(`#${formId} #headerImageGroup`);
            //     const headerVideoGroup = document.querySelector(`#${formId} #headerVideoGroup`);
            //     const headerDocumentGroup = document.querySelector(`#${formId} #headerDocumentGroup`);

            //     headerTextGroup.style.display = 'none';
            //     headerImageGroup.style.display = 'none';
            //     headerVideoGroup.style.display = 'none';
            //     headerDocumentGroup.style.display = 'none';

            //     if (selectedValue === 'TEXT') {
            //         headerTextGroup.style.display = 'block';
            //     } else if (selectedValue === 'IMAGE') {
            //         headerImageGroup.style.display = 'block';
            //     } else if (selectedValue === 'VIDEO') {
            //         headerVideoGroup.style.display = 'block';
            //     } else if (selectedValue === 'DOCUMENT') {
            //         headerDocumentGroup.style.display = 'block';
            //     }
            // }

            editTemplateHeader.addEventListener('change', handleHeaderChange);
            createTemplateHeader.addEventListener('change', handleHeaderChange);

            // Function to open edit modal and load data
            function openEditModal(button) {
                // Limpiar el formulario antes de cargar nuevos datos
                clearFormFields();

                const templateId = button.getAttribute("data-template-id");

                $.ajax({
                    url: '{{ route('template.json') }}', // Ruta de Laravel para obtener los detalles de la plantilla
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: templateId
                    },
                    success: function (data) {
                        // Mapea los datos del JSON a los campos del formulario
                        console.log(data);
                        document.getElementById('editTemplateName').value = data.name;
                        document.getElementById('editTemplateLanguage').value = data.language;
                        document.getElementById('editTemplateId').value = data.id;

                        // Buscar y asignar datos de header, body y footer
                        data.components.forEach(component => {
                            if (component.type === "HEADER") {
                                // Cargar imagen de la plantilla si existe
                                if (component.format === "IMAGE" && component.example.header_handle) {
                                    document.querySelector('#previewImage img').src = component.example.header_handle;
                                }

                                $('#editTemplateHeader').val(component.format).trigger('change');
                                document.getElementById('editHeaderText').value = component.text || '';
                                const headerText = document.getElementById('editHeaderText');

                                // Remove existing example fields
                                const existingExamples = headerText.parentNode.querySelectorAll('.example-field');
                                existingExamples.forEach(field => field.remove());

                                // Crear nuevos campos de ejemplo basados en los datos del JSON
                                const headerExamples = component.example?.header_text || [];
                                headerExamples.forEach((example, index) => {
                                    const exampleField = document.createElement('input');
                                    exampleField.type = 'text';
                                    exampleField.placeholder = `Ejemplo para @{{${index + 1}}}`;
                                    exampleField.value = example; // Llenar con el ejemplo correspondiente
                                    exampleField.classList.add('form-control', 'mb-2', 'example-field'); // Add classes for styling
                                    headerText.parentNode.appendChild(exampleField);
                                });

                            } else if (component.type === "BODY") {
                                document.getElementById('editBodyText').value = component.text || '';
                                const bodyText = document.getElementById('editBodyText');

                                // Remove existing example fields
                                const existingExamples = bodyText.parentNode.querySelectorAll('.example-field');
                                existingExamples.forEach(field => field.remove());

                                // Crear nuevos campos de ejemplo basados en los datos del JSON
                                const bodyExamples = component.example?.body_text || [];
                                bodyExamples.forEach((exampleArray, index) => {
                                    exampleArray.forEach((example, exampleIndex) => {
                                        const exampleField = document.createElement('input');
                                        exampleField.type = 'text';
                                        exampleField.placeholder = `Ejemplo para @{{${index + 1}}}`;
                                        exampleField.value = example; // Llenar con el ejemplo correspondiente
                                        exampleField.classList.add('form-control', 'mb-2', 'example-field'); // Add classes for styling
                                        bodyText.parentNode.appendChild(exampleField);
                                    });
                                });

                            } else if (component.type === "FOOTER") {
                                document.getElementById('editFooterText').value = component.text || '';
                            } else if (component.type === "BUTTONS" && component.buttons) {
                                // Asigna los datos de los botones si existen
                                component.buttons.forEach(button => {
                                    if (button.type === "QUICK_REPLY") {
                                        addQuickReplyButton('Respuesta preconfigurada', button.text);
                                    } else if (button.type === "URL") {
                                        addCallToActionButton('Ir a Web', button.text, button.url);
                                    } else if (button.type === "PHONE_NUMBER") {
                                        addCallToActionButton('Llamar a numero de telefono', button.text, '', button.phone_number);
                                    } else if (button.type === "COPY_CODE") {
                                        addCallToActionButton('Copiar codigo de oferta', button.text, '', '', button.example[0]);
                                    }
                                });
                            }
                        });

                        // Mostrar el modal después de cargar los datos
                        $('#modal_edit_template').modal('show');
                    },
                    error: function (xhr, status, error) {
                        console.error('Error en la solicitud:', error);
                        alert("Hubo un error al cargar los datos de la plantilla. Por favor, intenta de nuevo.");
                    }
                });
            }

            // Function to clear form fields
            function clearFormFields() {
                // Clear input fields
                document.getElementById('editTemplateName').value = '';
                document.getElementById('editTemplateLanguage').value = '';
                document.getElementById('editTemplateId').value = '';
                document.getElementById('editHeaderText').value = '';
                document.getElementById('editBodyText').value = '';
                document.getElementById('editFooterText').value = '';

                // Remove dynamically created example fields
                const exampleFields = document.querySelectorAll('.example-field');
                exampleFields.forEach(field => field.remove());

                // Remove dynamically created buttons
                const quickReplyButtonGroups = document.querySelectorAll('.quick_replay_button_group');
                quickReplyButtonGroups.forEach(group => group.remove());

                const callToActionButtonGroups = document.querySelectorAll('.call_to_action_button_group');
                callToActionButtonGroups.forEach(group => group.remove());
            }

            // Delegación de eventos para abrir el modal de edición
            $(document).on('click', '.modal-editTemplate', function () {
                openEditModal(this);
            });

            // Function to add Quick Reply Button
            function addQuickReplyButton(type, text = '') {
                const quickReplyButtonGroup = document.createElement('div');
                quickReplyButtonGroup.classList.add('quick_replay_button_group');

                quickReplyButtonGroup.innerHTML = `
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="quick_replay_button_type">Type</label>
                                <select class="custom-select form-control-border" name="quick_replay_button_type">
                                    <option value="QUICK_REPLY" ${type === 'Personalizado' ? 'selected' : ''}>Personalizado</option>
                                    <option value="QUICK_REPLY" ${type === 'Respuesta preconfigurada' ? 'selected' : ''}>Respuesta preconfigurada</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="form-group">
                                <label for="quick_replay_button_text">Texto del Boton</label>
                                <input type="text" class="form-control" name="quick_replay_button_text" value="${text}">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <button type="button" class="btn btn-danger btn-sm remove-button">Eliminar</button>
                        </div>
                    </div>
                `;

                buttonsContainer.appendChild(quickReplyButtonGroup);
            }

            // Function to add Call to Action Button
            function addCallToActionButton(actionType, text = '', url = '', phoneNumber = '', code = '') {
                const callToActionButtonGroup = document.createElement('div');
                callToActionButtonGroup.classList.add('call_to_action_button_group');

                let actionFields = '';

                if (actionType === 'Ir a Web') {
                    actionFields = `
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="call_to_action_button_type">URL Type</label>
                                <select class="custom-select form-control-border" name="call_to_action_button_type">
                                    <option>Estatica</option>
                                    <option>Dinamica</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="call_to_action_button_url">URL del sitio web</label>
                                <input type="text" class="form-control" name="call_to_action_button_url" value="${url}">
                            </div>
                        </div>
                    `;
                } else if (actionType === 'Llamar a numero de telefono') {
                    actionFields = `
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="call_to_action_button_country">Pais</label>
                                <select class="custom-select form-control-border" name="call_to_action_button_country">
                                    <option>+57</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="call_to_action_button_phone">Numero de telefono</label>
                                <input type="text" class="form-control" name="call_to_action_button_phone" value="${phoneNumber}">
                            </div>
                        </div>
                    `;
                } else if (actionType === 'Copiar codigo de oferta') {
                    actionFields = `
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="call_to_action_button_code">Codigo de oferta</label>
                                <input type="text" class="form-control" name="call_to_action_button_code" value="${code}">
                            </div>
                        </div>
                    `;
                }

                callToActionButtonGroup.innerHTML = `
                    <div class="row">
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="call_to_action_button_type">Tipo de accion</label>
                                <select class="custom-select form-control-border" name="call_to_action_button_type">
                                    <option value="URL" ${actionType === 'Ir a Web' ? 'selected' : ''}>Ir a Web</option>
                                    <option value="PHONE_NUMBER" ${actionType === 'Llamar a numero de telefono' ? 'selected' : ''}>Llamar a numero de telefono</option>
                                    <option value="COPY_CODE" ${actionType === 'Copiar codigo de oferta' ? 'selected' : ''}>Copiar codigo de oferta</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="call_to_action_button_text">Texto del Boton</label>
                                <input type="text" class="form-control" name="call_to_action_button_text" value="${text}">
                            </div>
                        </div>
                        ${actionFields}
                        <div class="col-lg-2">
                            <button type="button" class="btn btn-danger btn-sm remove-button">Eliminar</button>
                        </div>
                    </div>
                `;

                buttonsContainer.appendChild(callToActionButtonGroup);
            }

            // Event listeners for dropdown items
            document.getElementById('quick_replay_button').addEventListener('click', function () {
                addQuickReplyButton('Respuesta preconfigurada');
            });

            document.getElementById('quick_replay_custon_button').addEventListener('click', function () {
                addQuickReplyButton('Personalizado');
            });

            document.getElementById('go_to_web_button').addEventListener('click', function () {
                addCallToActionButton('Ir a Web');
            });

            document.getElementById('call_button').addEventListener('click', function () {
                addCallToActionButton('Llamar a numero de telefono');
            });

            document.getElementById('copy_code_button').addEventListener('click', function () {
                addCallToActionButton('Copiar codigo de oferta');
            });

            // Event delegation for remove buttons
            buttonsContainer.addEventListener('click', function (e) {
                if (e.target.classList.contains('remove-button')) {
                    e.target.closest('.row').remove();
                }
            });
        });
    </script>
@stop
