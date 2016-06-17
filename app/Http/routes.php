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
Route::get('contrato/{ocid}', "Contracts@show");
Route::get('contratos/busqueda', "Search@index");
Route::get('contratos/{page?}/{type?}', "Contracts@index");
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
Route::get('datos-abiertos/documentacion-api-contratos', "Frontend@apicontratos");
Route::get('datos-abiertos/documentacion-api-proveedores', "Frontend@apisuppliers");
Route::get('datos-abiertos/documentacion-api-dependencias', "Frontend@apioffices");
Route::get('datos-abiertos/documentacion-api-licitaciones', "Frontend@apitenders");
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
Route::get('api', "Frontend@opendata");

Route::get('api/contratos/todos', 'ApiCDMX@listAll');
Route::get('api/contratos/ejercicio/{year}', 'ApiCDMX@getByYear');
Route::get('api/proveedores/todos', 'ApiCDMX@listAllProviders');
Route::get('api/proveedor/{rfc}', 'ApiCDMX@showProvider'); // *
Route::get('api/contratos/buscar/{page?}', 'ApiCDMX@search');
Route::get('api/contrato/{key}', 'ApiCDMX@getJSON');
Route::get('api/contrato/historico/{key}', 'ApiCDMX@showContractHistory'); // *
Route::get('api/contrato/actual/{key}', 'ApiCDMX@showContractData'); // *
Route::get('api/dependencias/todas', 'ApiCDMX@showBuyers');
Route::get('api/dependencia-proveedor/{page?}', 'ApiCDMX@showBuyerProviderRelation');
Route::get('api/licitaciones/{page?}', 'ApiCDMX@tenders');

/*
.......................................
. T H E   T E S T   R O U T E S 
.......................................
*/
Route::get('lista/contratos/json', "Contracts@showListRaw");
Route::get('contrato/json/{ocid}', "Contracts@showRaw"); // show JSON with format
Route::get('contrato/text/{ocid}', "Contracts@showFullRaw");
Route::get('test/suppliers', "TestStuff@index");
Route::get('test/supplier/{key}', "TestStuff@supplier");
Route::get('test/providers', "TestStuff@providers");
Route::get('test/buyers/{id}', "TestStuff@buyers");
