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
            const createVariableField = document.getElementById('createTemplateVariable');
            const editVariableField = document.getElementById('editTemplateVariable');
            const createTextFields = ['createHeaderText', 'createBodyText', 'createFooterText'];
            const editTextFields = ['editHeaderText', 'editBodyText', 'editFooterText'];

            let createVariableCounter = 1;
            let editVariableCounter = 1;

            createTextFields.forEach(fieldId => {
                const field = document.getElementById(fieldId);
                field.addEventListener('input', handleInput.bind(null, createVariableField, createVariableCounter));
                field.addEventListener('blur', handleBlur.bind(null, createVariableField, createVariableCounter));
            });

            editTextFields.forEach(fieldId => {
                const field = document.getElementById(fieldId);
                field.addEventListener('input', handleInput.bind(null, editVariableField, editVariableCounter));
                field.addEventListener('blur', handleBlur.bind(null, editVariableField, editVariableCounter));
            });

            function handleInput(variableField, variableCounter, event) {
                const field = event.target;
                const cursorPosition = field.selectionStart;
                const textBeforeCursor = field.value.substring(0, cursorPosition);
                const textAfterCursor = field.value.substring(cursorPosition);

                if (textBeforeCursor.endsWith('@{{')) {
                    const variableType = variableField.value;
                    var variableCount = $('#variableFields .form-group').length + 1;
                    var variableName = variableType === 'number' ? variableCount : 'variable_' + variableCount;
                    let variableText = '';

                    // $(this).val(beforeCursor + variableName + '}}' + afterCursor);
                    //     this.selectionStart = this.selectionEnd = cursorPos + variableName.length + 2;

                    if (variableType === 'number') {
                        variableText = `@{{${variableCounter}}}`;
                    } else if (variableType === 'name') {
                        variableText = `@{{variable_${variableCounter}}}`;
                    }

                    field.value = textBeforeCursor.slice(0, -3) + variableText + textAfterCursor;
                    field.selectionStart = field.selectionEnd = cursorPosition + variableText.length - 3;
                    variableCounter++;
                }
            }

            function handleBlur(variableField, variableCounter, event) {
                const field = event.target;
                const variableType = variableField.value;
                let variableText = '';

                if (variableType === 'number') {
                    variableText = `@{{${variableCounter}}}`;
                } else if (variableType === 'name') {
                    variableText = `@{{variable_${variableCounter}}}`;
                }

                field.value = field.value.replace(/@{{\s*}}/g, variableText);
            }
        });
    </script>
@stop
