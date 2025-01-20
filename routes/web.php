<?php

use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WhatsappChatController;
use App\Http\Controllers\WhatsappWebhookController;
use App\Http\Controllers\WhatsappAPICLoudController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Route;

Route::post('/webhook-app', [WhatsappWebhookController::class, 'handle']);
Route::get('/webhook-app', [WhatsappWebhookController::class, 'handle']);


Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/user', [UserController::class, 'index']);
    Route::get('/users/{user}', [UserController::class, 'profile']);
    Route::get('/profile', [UserController::class, 'profile']);

    Route::post('/users/{user}/assign-permission', [UserController::class, 'assignPermission'])->name('users.assign-permission')->middleware('can:give permission');

    Route::get('/roles', [RoleController::class, 'index']);
    Route::get('/roles/{role}', [RoleController::class, 'roleDetail']);
    Route::post('/roles/{role}/update-permission', [RoleController::class, 'updateRolePermission'])->name('roles.update-permission')->middleware('can:give permission');

    // Whatsapp management
    Route::get('/whatsapp_manager', [WhatsappAPICLoudController::class, 'whatsappManager'])->name('whatsapp.manager');

    // Templates
    Route::get('/templates', [WhatsappAPICLoudController::class, 'templatesList'])->name('templates.list');
    Route::post('/template-detail', [WhatsappAPICLoudController::class, 'getTemplateDetail'])->name('template.detail');
    Route::post('/template-json', [WhatsappAPICLoudController::class, 'getTemplateJson'])->name('template.json');
    Route::post('/template-create', [WhatsappAPICLoudController::class, 'createTemplate'])->name('template.create');
    Route::post('/template-update', [WhatsappAPICLoudController::class, 'updateTemplate'])->name('template.update');
    Route::post('/send-template', [WhatsappAPICLoudController::class, 'sendTemplate'])->name('template.send');
    //Route::get('/templates/{template}', [WhatsappAPICLoudController::class, 'templateDetail'])->name('templates.detail');

    // Whatsapp Chat
    Route::get('/whatsapp_chat', [WhatsappChatController::class, 'whatsappIndex'])->name('whatsapp.index');
});
