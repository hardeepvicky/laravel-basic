<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\DeveloperController;
use App\Http\Controllers\Backend\PermissionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\PublicController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\HomeController;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;

Route::get('/', function () {
    return redirect()->route("home");
});

Route::get('/phpinfo', function () {
    phpinfo();
});

Auth::routes();

Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::get('/theme', [HomeController::class, 'theme']);
Route::get('/developer-components', [HomeController::class, 'developer_components']);
Route::get('/test', [HomeController::class, 'test']);


Route::group(['prefix' => 'public', 'as' => 'public.'], function () {
    Route::post('ajax_upload', [PublicController::class, 'ajax_upload']);
    Route::post('ajax_upload_base64', [PublicController::class, 'ajax_upload_base64']);
});

Route::group(['middleware' => ['auth']], function () {

    $name = "dashboard";
    Route::get($name, [DashboardController::class, 'index'])->name($name);

    $route_prefix = "user";
    $controllerClass = UserController::class;
    Route::resource($route_prefix, $controllerClass)->except("show");
    Route::group(['prefix' => $route_prefix, 'as' => $route_prefix . '.'], function () use($controllerClass) {

        $name = "activate";
        Route::get($name . "/{id}", [$controllerClass, $name])->name($name);

        $name = "de_activate";
        Route::get($name . "/{id}", [$controllerClass, $name])->name($name);

        Route::get("my-profile", [$controllerClass, 'my_profile'])->name("my.profile");

        Route::any("change-password", [$controllerClass, 'change_password'])->name("change.password");
    });

    $route_prefix = "role";
    $controllerClass = RoleController::class;
    Route::resource($route_prefix, $controllerClass);
    Route::group(['prefix' => $route_prefix, 'as' => $route_prefix . '.'], function () use($controllerClass) {
        
        $name = "activate";
        Route::get($name . "/{id}", [$controllerClass, $name])->name($name);

        $name = "de_activate";
        Route::get($name . "/{id}", [$controllerClass, $name])->name($name);
    });


    Route::group(['prefix' => 'permissions', 'as' => 'permissions.'], function () {

        $name = "index";
        Route::get($name, [PermissionController::class, $name])->name($name);

        $name = "assign";
        Route::any($name, [PermissionController::class, $name])->name($name);

        $name = "assign_to_many";
        Route::any($name, [PermissionController::class, $name])->name($name);

        $name = "ajax_get_permissions";
        Route::get("$name/{id}", [PermissionController::class, $name])->name($name);

        $name = "ajax_delete";
        Route::post($name, [PermissionController::class, $name])->name($name);

        $name = "ajax_request_access";
        Route::any($name . "/{route_name}", [PermissionController::class, $name])->name($name);
    });

    Route::group(['prefix' => 'logs', 'as' => 'logs.'], function () {
        $name = "email";
        Route::get($name, [DeveloperController::class, $name])->name($name);
    });

    Route::group(['prefix' => "developer", 'as' => "developer."], function () {

        $name = "sql_log";
        Route::get($name, [DeveloperController::class, $name])->name($name);

        $name = "laravel_routes_index";
        Route::get($name, [DeveloperController::class, $name])->name($name);
    });
   
    
});
Route::get('verify-otp/{email}',[UserController::class,'otp_verified_view'])->name('verify.otp')->middleware('auth');

