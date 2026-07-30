<?php

use App\Domains\Authorization\Http\Controllers\Permission\PermissionController;
use App\Domains\Authorization\Http\Controllers\Permission\SyncUserPermissionsController;
use App\Domains\Authorization\Http\Controllers\Roles\RolesController;
use App\Domains\Authorization\Http\Controllers\Roles\SyncRolePermissionsController;
use App\Domains\Authorization\Http\Controllers\Roles\SyncUserRolesController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:api')->group(function () {
    Route::apiResource('/roles', RolesController::class);
    Route::apiresource('/permissions', PermissionController::class);
    Route::post('/assign_role_permissions', SyncRolePermissionsController::class);
    Route::post('/assign_role_to_user', SyncUserRolesController::class);
    Route::post('/assign_permissions_to_user', SyncUserPermissionsController::class);
});
