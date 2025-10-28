<?php

use Modules\Core\Http\Controllers\SessionsController;

Route::group(['middleware' => 'web', 'prefix' => 'core', 'namespace' => 'Modules\Core\Http\Controllers'], function()
{
    Route::get('/', 'CoreController@index');
});

Route::middleware('web')->group(function () {
    Route::get('sessions', [SessionsController::class, 'index'])->name('sessions.index');
    Route::get('sessions/login', [SessionsController::class, 'login'])->name('sessions.login');
    Route::post('sessions/login', [SessionsController::class, 'loginPost'])->name('sessions.login.post');
    Route::get('sessions/authenticate', [SessionsController::class, 'authenticate'])->name('sessions.authenticate');
    Route::get('sessions/logout', [SessionsController::class, 'logout'])->name('sessions.logout');
    Route::get('sessions/passwordreset', [SessionsController::class, 'passwordreset'])->name('sessions.passwordreset');
    Route::post('sessions/passwordreset', [SessionsController::class, 'passwordreset'])->name('sessions.passwordreset.post');
});
