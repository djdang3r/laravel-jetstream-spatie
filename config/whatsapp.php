<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Modelos Personalizados
    |--------------------------------------------------------------------------
    |
    | Aquí puedes especificar los modelos que el paquete utilizará para las
    | entidades principales. Puedes sobrescribir estos valores en tu archivo
    | .env si estás utilizando modelos personalizados.
    |
    */
    'models' => [
        // Modelo para la cuenta empresarial de WhatsApp
        'business_account' => \ScriptDevelop\WhatsappManager\Models\WhatsappBusinessAccount::class,

        // Modelo de usuario (puede ser personalizado)
        'user_model' => env('AUTH_MODEL', App\Models\User::class),

        // Tabla de usuarios (puede ser personalizada)
        'user_table' => env('AUTH_TABLE', 'users'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Configuración de la API de WhatsApp
    |--------------------------------------------------------------------------
    |
    | Configuración principal para interactuar con la API de WhatsApp Business.
    | Incluye la URL base, la versión de la API, el tiempo de espera y las
    | opciones de reintento en caso de errores.
    |
    */
    'api' => [
        // URL base de la API de WhatsApp
        'base_url' => env('WHATSAPP_API_URL', 'https://graph.facebook.com'),

        // Versión de la API de WhatsApp
        'version' => env('WHATSAPP_API_VERSION', 'v22.0'),

        // Tiempo de espera para las solicitudes (en segundos)
        'timeout' => env('WHATSAPP_API_TIMEOUT', 30),

        // Configuración de reintentos en caso de errores
        'retry' => [
            'attempts' => 3, // Número de intentos
            'delay' => 500, // Tiempo de espera entre intentos (en milisegundos)
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Configuración del Webhook
    |--------------------------------------------------------------------------
    |
    | Configuración para el webhook de WhatsApp. Incluye el token de verificación
    | que se utiliza para validar las solicitudes entrantes desde Meta.
    |
    */
    'webhook' => [
        // Token de verificación para el webhook
        'verify_token' => env('WHATSAPP_VERIFY_TOKEN'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Configuración de Medios
    |--------------------------------------------------------------------------
    |
    | Configuración para la gestión de archivos multimedia. Incluye los tamaños
    | máximos permitidos y los tipos MIME aceptados para cada tipo de archivo.
    |
    */
    'media' => [
        // Directorios de almacenamiento para cada tipo de archivo
        'storage_path' => [
            'images' => storage_path('app/public/whatsapp/images'),
            'audio' => storage_path('app/public/whatsapp/audio'),
            'documents' => storage_path('app/public/whatsapp/documents'),
            'videos' => storage_path('app/public/whatsapp/videos'),
            'stickers' => storage_path('app/public/whatsapp/stickers'),
        ],
        // Tamaño máximo permitido para cada tipo de archivo (en bytes)
        'max_file_size' => [
            'image' => 5 * 1024 * 1024, // 5MB
            'audio' => 16 * 1024 * 1024, // 16MB
            'video' => 16 * 1024 * 1024, // 16MB
            'document' => 100 * 1024 * 1024, // 100MB
            'sticker' => 100 * 1024, // 100KB
        ],

        // Tipos MIME permitidos para cada tipo de archivo
        'allowed_types' => [
            'image' => ['image/jpeg', 'image/png'], // Imágenes
            'audio' => ['audio/aac', 'audio/mp4', 'audio/mpeg', 'audio/amr', 'audio/ogg'], // Audios
            'video' => ['video/mp4', 'video/3gp'], // Videos
            'document' => [ // Documentos
                'text/plain',
                'application/pdf',
                'application/vnd.ms-powerpoint',
                'application/msword',
                'application/vnd.ms-excel',
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'application/vnd.openxmlformats-officedocument.presentationml.presentation',
                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            ],
            'sticker' => ['image/webp'], // Stickers
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Migraciones Automáticas
    |--------------------------------------------------------------------------
    |
    | Controla si las migraciones del paquete deben cargarse automáticamente.
    | Si no deseas que las migraciones se carguen automáticamente, puedes
    | establecer este valor en "false".
    |
    */
    'load_migrations' => true,
];