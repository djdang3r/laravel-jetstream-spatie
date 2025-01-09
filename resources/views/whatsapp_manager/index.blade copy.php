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
        document.addEventListener("DOMContentLoaded", function () {
            const buttonsContainer = document.querySelector('.buttons_groug');

            // Ocultar los campos de archivo al cargar la página
            $('#headerTextGroup').hide();
            $('#headerImageGroup').hide();
            $('#headerVideoGroup').hide();
            $('#headerDocumentGroup').hide();

            // Mostrar/ocultar los campos de archivo según el valor del select
            $('#editTemplateHeader').on('change', function () {
                var selectedValue = $(this).val();
                // alert(selectedValue);
                $('#headerTextGroup').hide();
                $('#headerImageGroup').hide();
                $('#headerVideoGroup').hide();
                $('#headerDocumentGroup').hide();

                if (selectedValue === 'TEXT') {
                    $('#headerTextGroup').show();
                } else if (selectedValue === 'IMAGE') {
                    $('#headerImageGroup').show();
                } else if (selectedValue === 'VIDEO') {
                    $('#headerVideoGroup').show();
                } else if (selectedValue === 'DOCUMENT') {
                    $('#headerDocumentGroup').show();
                }
            });

            // Delegación de eventos para elementos dinámicos
            $(document).on('click', '.modal-detailTemplate', function () {
                var templateId = $(this).data('template-id');
                var templateName = $(this).data('template-name');
                var waTemplateId = $(this).data('template-wa-id');
                var json = {}; // Define el JSON que necesitas enviar

                $.ajax({
                    url: '{{ route('template.detail') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        json: json,
                        template_id: templateId,
                        wa_template_id: waTemplateId
                    },
                    success: function (response) {
                        // Manejar la respuesta
                        console.log(response);
                        $('#modal_detail_template_body').html(response);
                        $('#detailTemplateModal').modal('show');
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    }
                });
            });

            // Función para detectar variables y crear campos de texto
            $(document).on('input', '#editHeaderText', function () {
                var text = $(this).val();
                var variablePattern = /@{{\s*([\w_]+)\s*}}/g;
                var match;
                var variables = [];

                // Detectar variables en el texto
                while ((match = variablePattern.exec(text)) !== null) {
                    variables.push(match[1]);
                }

                // Limpiar campos de variables existentes
                $('#variableFields').empty();

                // Crear campos de texto para cada variable detectada
                if (variables.length <= 1) {
                    variables.forEach(function (variable) {
                        createExampleField($('#editHeaderText')[0], variable);
                    });
                }
            });

            // Completar automáticamente las variables
            $(document).on('keyup', '#editHeaderText', function (e) {
                if (e.key === '{') {
                    var cursorPos = this.selectionStart;
                    var text = $(this).val();
                    var beforeCursor = text.substring(0, cursorPos);
                    var afterCursor = text.substring(cursorPos);

                    if (beforeCursor.endsWith('@{{')) {
                        var variableType = $('#editTemplateVariable').val();
                        var variableCount = $('#variableFields .form-group').length + 1;
                        var variableName = variableType === 'number' ? variableCount : 'variable_' + variableCount;

                        $(this).val(beforeCursor + variableName + '}}' + afterCursor);
                        this.selectionStart = this.selectionEnd = cursorPos + variableName.length + 2;
                    }
                }
            });

            // Función para manejar el campo de ejemplo
            function updateExampleField(headerText) {
                // Eliminar el campo de ejemplo existente
                const existingExample = headerText.parentNode.querySelector('.example-field');
                if (existingExample) {
                    existingExample.remove();
                }

                // Verificar si hay una variable en el texto del encabezado
                const variableMatch = headerText.value.match(/@{{\d+}}/);
                if (variableMatch) {
                    // createExampleField(headerText, variableMatch[0]); // Crear un campo de ejemplo con la variable detectada
                }
            }

            function createExampleField(headerText, variable) {
                // Verificar si ya existe un campo de ejemplo para esta variable
                if (!headerText.parentNode.querySelector(`.example-field[data-variable="${variable}"]`)) {
                    const exampleField = document.createElement('input');
                    exampleField.type = 'text';
                    exampleField.placeholder = `Ejemplo para ${variable}`;
                    exampleField.classList.add('form-control', 'mb-2', 'example-field'); // Agregar clases para el estilo
                    exampleField.setAttribute('data-variable', variable); // Agregar atributo para identificar la variable
                    headerText.parentNode.appendChild(exampleField);
                }
            }

            // Validar el texto del encabezado
            function validateHeaderText(headerText, validationMessage) {
                const text = headerText.value;
                const variablePattern = /@{{\s*([\w_]+)\s*}}/g;
                const variables = text.match(variablePattern) || [];

                // Mostrar mensaje de validación si se detecta más de una variable
                if (variables.length > 1) {
                    validationMessage.style.display = "block";
                    // Eliminar variables adicionales
                    const firstVariable = variables[0];
                    const newText = text.replace(variablePattern, (match, p1, offset) => {
                        return offset === text.indexOf(firstVariable) ? match : '';
                    });
                    headerText.value = newText;
                } else {
                    validationMessage.style.display = "none";
                }
            }

            // Inicializar los campos de texto del encabezado
            const headerTextFields = document.querySelectorAll("#editHeaderText, #createHeaderText");

            headerTextFields.forEach((headerText) => {
                const validationMessage = document.createElement("small");
                validationMessage.classList.add("form-text", "text-danger");
                validationMessage.style.display = "none";
                validationMessage.innerText = "El encabezado solo puede contener un parámetro variable.";
                headerText.parentNode.appendChild(validationMessage);

                headerText.addEventListener("input", function () {
                    autoInsertVariable(headerText);
                    validateHeaderText(headerText, validationMessage);
                    updateExampleField(headerText); // Actualizar el campo de ejemplo en la entrada
                });
            });

            // Función para insertar automáticamente la variable
            function autoInsertVariable(field) {
                const cursorPosition = field.selectionStart;
                const textBeforeCursor = field.value.slice(0, cursorPosition);
                const textAfterCursor = field.value.slice(cursorPosition);

                // Detectar apertura de `@{{` sin un número consecutivo
                if (textBeforeCursor.endsWith("@{{") && !textAfterCursor.startsWith("}}")) {
                    // Insertar nueva variable `@{{1}}` (ya que solo se permite una)
                    field.value = `${textBeforeCursor}1}}${textAfterCursor}`;
                    field.selectionStart = field.selectionEnd = cursorPosition + `1}}`.length;

                    // Actualizar el campo de ejemplo
                    updateExampleField(field);
                }
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

            // Función para limpiar los campos del formulario
            // function clearFormFields() {
            //     document.getElementById('editTemplateForm').reset();
            //     $('#variableFields').empty();
            // }

            // Delegación de eventos para abrir el modal de edición
            $(document).on('click', '.modal-editTemplate', function () {
                openEditModal(this);
            });
        });

        document.addEventListener("DOMContentLoaded", function () {
            const bodyTextFields = document.querySelectorAll("#editBodyText, #createBodyText");

            // Funcionalidad para los campos de nombre de plantilla (sin variables)
            const templateNameFields = document.querySelectorAll("#createTemplateName, #editTemplateName");
            templateNameFields.forEach((templateField) => {
                templateField.addEventListener("input", function () {
                    // Convertir a minúsculas y reemplazar espacios por _
                    this.value = this.value.toLowerCase().replace(/\s+/g, '_');
                });
            });

            bodyTextFields.forEach((bodyText) => {
                const validationMessage = document.createElement("small");
                validationMessage.classList.add("form-text", "text-danger");
                validationMessage.style.display = "none";
                validationMessage.innerText = "Esta plantilla contiene demasiados parámetros variables en relación con la longitud del mensaje. Debes disminuir el número de parámetros o aumentar la longitud del mensaje.";
                bodyText.parentNode.appendChild(validationMessage);

                // Function to manage example fields
                function updateExampleFields() {
                    // Remove existing example fields
                    const existingExamples = bodyText.parentNode.querySelectorAll('.example-field');
                    existingExamples.forEach(field => field.remove());

                    // Count the number of variables in the body text
                    const variablesCount = (bodyText.value.match(/@{{\d+}}/g) || []).length;

                    // Create new example fields based on the count
                    for (let i = 1; i <= variablesCount; i++) {
                        createExampleField(i);
                    }
                }

                // Function to create an example field
                function createExampleField(variableNumber) {
                    const exampleField = document.createElement('input');
                    exampleField.type = 'text';
                    exampleField.placeholder = `Ejemplo para @{{${variableNumber}}}`;
                    exampleField.classList.add('form-control', 'mb-2', 'example-field'); // Add classes for styling
                    bodyText.parentNode.appendChild(exampleField);
                }

                bodyText.addEventListener("input", function () {
                    autoInsertVariable(bodyText);
                    validateBodyText(bodyText, validationMessage);
                    updateExampleFields(); // Update example fields on input
                });

                function autoInsertVariable(field) {
                    const cursorPosition = field.selectionStart;
                    const textBeforeCursor = field.value.slice(0, cursorPosition);
                    const textAfterCursor = field.value.slice(cursorPosition);

                    // Detect opening of `@{{` without a consecutive number
                    if (textBeforeCursor.endsWith("@{{") && !textAfterCursor.startsWith("}}")) {
                        const variables = field.value.match(/@{{(\d+)}}/g) || [];
                        const existingNumbers = variables.map(v => parseInt(v.match(/\d+/)[0], 10));
                        const nextVariableNumber = existingNumbers.length > 0 ? Math.max(...existingNumbers) + 1 : 1;

                        // Determine the variable type based on the select value
                        const variableType = document.getElementById('editTemplateVariable').value;
                        const variableName = variableType === 'number' ? nextVariableNumber : `variable_${nextVariableNumber}`;

                        // Insert new variable `@{{variableName}}`
                        field.value = `${textBeforeCursor}@{{${variableName}}}${textAfterCursor}`;
                        field.selectionStart = field.selectionEnd = cursorPosition + `@{{${variableName}}}`.length;

                        // Update example fields
                        updateExampleFields();
                    }
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
            });
        });

        document.addEventListener("DOMContentLoaded", function () {
            const footerTextFields = document.querySelectorAll("#editFooterText, #createFooterText");

            footerTextFields.forEach((footerText) => {
                const validationMessage = document.createElement("small");
                validationMessage.classList.add("form-text", "text-danger");
                validationMessage.style.display = "none";
                validationMessage.innerText = "El pie de página no debe contener variables y debe tener un máximo de 60 caracteres.";
                footerText.parentNode.appendChild(validationMessage);

                // Function to validate footer text
                function validateFooterText() {
                    const text = footerText.value;

                    // Check if the text contains any variable (like {{1}})
                    const hasVariable = /@{{\d+}}/.test(text);
                    const exceedsMaxLength = text.length > 60;

                    // Show validation message if either condition is violated
                    if (hasVariable || exceedsMaxLength) {
                        validationMessage.style.display = "block";
                    } else {
                        validationMessage.style.display = "none";
                    }
                }

                footerText.addEventListener("input", function () {
                    validateFooterText(); // Validate on input
                });
            });
        });

        document.addEventListener("DOMContentLoaded", function () {
            const buttonsContainer = document.querySelector('.buttons_groug');

            // Function to add Quick Reply Button
            function addQuickReplyButton(type) {
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
                                <input type="text" class="form-control" name="quick_replay_button_text">
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
            function addCallToActionButton(actionType) {
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
                                <input type="text" class="form-control" name="call_to_action_button_url">
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
                                <input type="text" class="form-control" name="call_to_action_button_phone">
                            </div>
                        </div>
                    `;
                } else if (actionType === 'Copiar codigo de oferta') {
                    actionFields = `
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="call_to_action_button_code">Codigo de oferta</label>
                                <input type="text" class="form-control" name="call_to_action_button_code">
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
                                <input type="text" class="form-control" name="call_to_action_button_text">
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

            // Function to submit the edit template form
            function submitEditTemplateForm(event) {
                event.preventDefault();

                // Obtener los valores del formulario
                const templateName = document.getElementById('editTemplateName').value;
                const templateLanguage = document.getElementById('editTemplateLanguage').value;
                const headerText = document.getElementById('editHeaderText').value;
                const bodyText = document.getElementById('editBodyText').value;
                const footerText = document.getElementById('editFooterText').value;
                const category = document.getElementById('editCategory').value;
                const templateId = document.getElementById('editTemplateId').value;
                const apiVersion = 'v21.0';

                // Construir la estructura del JSON
                const jsonBody = {
                    name: templateName,
                    components: [],
                    language: templateLanguage,
                    category: category
                };

                // Agregar HEADER si está presente
                if (headerText) {
                    const headerComponent = {
                        type: "HEADER",
                        format: "TEXT",
                        text: headerText
                    };

                    // Verificar si el HEADER contiene un único comodín
                    const matches = headerText.match(/\{\{\d+\}\}/g);
                    if (matches && matches.length === 1) {
                        headerComponent.example = {
                            header_text: ""
                        };
                        const headerExampleField = document.getElementById('editHeaderText').parentNode.querySelector('.example-field');
                        if (headerExampleField) {
                            headerComponent.example.header_text = headerExampleField.value.trim(); // Almacena como string
                        }
                    }

                    jsonBody.components.push(headerComponent);
                }

                // Agregar BODY con validación de variables
                if (bodyText) {
                    const bodyComponent = {
                        type: "BODY",
                        text: bodyText
                    };

                    // Verificar si el BODY contiene variables
                    if (/\{\{\d+\}\}/.test(bodyText)) {
                        bodyComponent.example = {
                            body_text: []
                        };
                        const bodyExamples = document.getElementById('editBodyText').parentNode.querySelectorAll('.example-field');
                        const bodyExampleValues = [];

                        bodyExamples.forEach((exampleField) => {
                            bodyExampleValues.push(exampleField.value.trim());
                        });

                        bodyComponent.example.body_text.push(bodyExampleValues);
                    }

                    jsonBody.components.push(bodyComponent);
                }

                // Agregar FOOTER si está presente
                if (footerText) {
                    jsonBody.components.push({
                        type: "FOOTER",
                        text: footerText
                    });
                }

                // Construcción dinámica del campo de botones
                const buttons = [];

                // Obtener todos los botones dinámicos
                document.querySelectorAll('.quick_replay_button_group, .call_to_action_button_group').forEach(buttonGroup => {
                    const buttonTypeElement = buttonGroup.querySelector('select[name="call_to_action_button_type"], select[name="quick_replay_button_type"]');
                    if (buttonTypeElement) {
                        const buttonType = buttonTypeElement.value;
                        const buttonText = buttonGroup.querySelector('input[name="call_to_action_button_text"], input[name="quick_replay_button_text"]').value;
                        let buttonData = { type: buttonType, text: buttonText };

                        if (buttonType === 'URL') {
                            buttonData.url = buttonGroup.querySelector('input[name="call_to_action_button_url"]').value;
                        } else if (buttonType === 'PHONE_NUMBER') {
                            buttonData.phone_number = buttonGroup.querySelector('input[name="call_to_action_button_phone"]').value;
                        } else if (buttonType === 'COPY_CODE') {
                            buttonData.example = [buttonGroup.querySelector('input[name="call_to_action_button_code"]').value];
                        }

                        buttons.push(buttonData);
                    }
                });

                // Agregar botones a los componentes si existen
                if (buttons.length > 0) {
                    jsonBody.components.push({
                        type: "BUTTONS",
                        buttons: buttons
                    });
                }

                // Enviar la solicitud al controlador de Laravel
                $.ajax({
                    url: '{{ route('template.update') }}', // Ruta de Laravel para actualizar la plantilla
                    type: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({
                        action: 'update_template',
                        apiVersion: apiVersion,
                        templateId: templateId,
                        jsonBody: jsonBody,
                        _token: '{{ csrf_token() }}'
                    }),
                    success: function (data) {
                        console.log('Éxito:', data);
                        alert("Plantilla actualizada con éxito. Se debe esperar por la revisión de META.");
                        $('#modal_edit_template').modal('hide');
                    },
                    error: function (xhr, status, error) {
                        console.error('Error en la solicitud:', error);

                        if (xhr.responseJSON && xhr.responseJSON.error && xhr.responseJSON.error.error_user_msg) {
                            alert(xhr.responseJSON.error.error_user_msg); // Muestra un mensaje específico si está disponible
                        } else {
                            alert("Hubo un error al actualizar la plantilla. Por favor, intenta de nuevo.");
                        }
                    }
                });
            }

            // Attach submit event to the form
            document.getElementById('editTemplateForm').addEventListener('submit', submitEditTemplateForm);
        });
    </script>
@stop
