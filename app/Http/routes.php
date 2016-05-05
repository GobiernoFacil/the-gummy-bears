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


Route::get('/', "Frontend@indexv2");
Route::get('home2', "Frontend@indexv2");

/// contracts
Route::get('v2', "Contracts@index");
Route::get('contratos', "Contracts@index");
Route::get('contrato/{ocid}', "Contracts@show");
Route::get('descargar/contrato/{ocid}', "ContractGetter@getJSON"); // donwload JSON
/// offices
Route::get('dependencias', "Offices@index");
Route::get('dependencia/{id}', "Offices@show");
/// suppliers
Route::get('proveedores', "Suppliers@index");
Route::get('proveedor/{id}', "Suppliers@show");
/// what
Route::get('por-que', "Frontend@whatis");
/// open data
Route::get('datos-abiertos', "Frontend@opendata");
/// contacto
Route::get('contacto', "Frontend@contact");
/// terms
Route::get('privacidad', "Frontend@terms");
/// glossary
Route::get('glosario', "Frontend@glossary");

/*
.......................................
. T H E   A P I   M I D D L E W A R E .
.......................................
*/
Route::get('api/contratos/todos', 'ApiCDMX@listAll');
Route::get('api/contratos/ejercicio/{year}', 'ApiCDMX@getByYear');
Route::get('api/proveedores/todos', 'ApiCDMX@listAllProviders');
Route::get('api/proveedor/{rfc}', 'ApiCDMX@showProvider'); // *
Route::get('api/contratos/buscar/{page?}', 'ApiCDMX@search');
Route::get('api/contrato/{key}', 'ApiCDMX@getJSON');
Route::get('api/contrato/historico/{key}', 'ApiCDMX@showContractHistory'); // *
Route::get('api/contrato/actual/{key}', 'ApiCDMX@showContractData'); // *

/*
.......................................
. T H E   T E S T   R O U T E S 
.......................................
*/
Route::get('contrato/json/{ocid}', "Contracts@showRaw"); // show JSON with format
Route::get('test/suppliers', "TestStuff@index");
Route::get('test/supplier/{key}', "TestStuff@supplier");
