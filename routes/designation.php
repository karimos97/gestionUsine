<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\DesignationController;

Route::get('designation','DesignationController@index');
Route::post('designation/store','DesignationController@store');
Route::post('designation/update','DesignationController@update');
Route::post('designation/edit','DesignationController@edit');
Route::post('designation/delete','DesignationController@delete');
Route::post('designation/show','DesignationController@show');
