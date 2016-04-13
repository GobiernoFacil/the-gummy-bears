<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/', "Frontend@index");
Route::get('home2', "Frontend@indexv2");

/// contracts
Route::get('v2', "Contracts@index");
Route::get('contratos', "Contracts@index");
Route::get('contrato/{ocid}', "Contracts@show");
/// offices
Route::get('dependencias', "Offices@index");
Route::get('dependencia/{id}', "Offices@show");
/// suppliers
Route::get('proveedor/{id}', "Suppliers@show");
/// glossary
Route::get('que-son', "Frontend@openc");
/// glossary
Route::get('glosario', "Frontend@glossary");
