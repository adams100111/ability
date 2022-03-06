<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'EOA\Ability\Http\Controllers'], function(){
    Route::get('role', 'RoleController@index')->name(config('ability.routes.role.index'));
    Route::get('role/create', 'RoleController@create')->name(config('ability.routes.role.create'));
});
