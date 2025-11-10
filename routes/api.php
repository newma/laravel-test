<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\CertificateController;

Route::apiResource('property', PropertyController::class);
Route::get('property/{property}/certificate', [PropertyController::class, 'certificates']);
Route::get('property/{property}/note', [PropertyController::class, 'notes']);
Route::post('property/{property}/note', [PropertyController::class, 'storeNote']);

Route::apiResource('certificate', CertificateController::class)->only(['index', 'show', 'store']);
Route::get('certificate/{certificate}/note', [CertificateController::class, 'notes']);
Route::post('certificate/{certificate}/note', [CertificateController::class, 'storeNote']);
