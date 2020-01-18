<?php

if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
    // Ignores notices and reports all other kinds... and warnings
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
}

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::post('/login', 'LoginController@index');

Route::get('/logout', function (){
    Auth::logout();
    Session::flush();
    return redirect('/');
});

Route::get('/generator', 'GeneratorController@index');

Route::post('/generator/add', 'GeneratorController@add');

Route::post('/generator/getKeyValue', 'GeneratorController@getKeyValue');

Route::post('/generator/getFields', 'GeneratorController@getFields');

// BO : Users
Route::post("/admin/users/deleteAll", "admin\UsersController@deleteAll")->middleware('auth');
Route::get("/admin/users", "admin\UsersController@index")->middleware('auth');
Route::get("/admin/users/add", "admin\UsersController@getAdd")->middleware('auth');
Route::post("/admin/users/add", "admin\UsersController@postAdd")->middleware('auth');
Route::get("/admin/users/edit/{id}", "admin\UsersController@getEdit")->middleware('auth');
Route::get("/admin/users/status/{field}/{id}", "admin\UsersController@status")->middleware('auth');
Route::get("/admin/users/export/{type}", "admin\UsersController@getExport")->middleware('auth');
Route::post("/admin/users/edit", "admin\UsersController@postEdit")->middleware('auth');
Route::post("/admin/users/delete", "admin\UsersController@delete")->middleware('auth');
Route::get("/admin/users/view/{id}", "admin\UsersController@view")->middleware('auth');
Route::get("/admin/users/baja/{id}", "admin\UsersController@baja")->middleware('auth');
Route::get("/admin/users/alta/{id}", "admin\UsersController@alta")->middleware('auth');
//  EO : Users

// BO : Roles
Route::post("/admin/roles/deleteAll", "admin\RolesController@deleteAll")->middleware('auth');
Route::get("/admin/roles", "admin\RolesController@index")->middleware('auth');
Route::get("/admin/roles/add", "admin\RolesController@getAdd")->middleware('auth');
Route::post("/admin/roles/add", "admin\RolesController@postAdd")->middleware('auth');
Route::get("/admin/roles/edit/{id}", "admin\RolesController@getEdit")->middleware('auth');
Route::get("/admin/roles/status/{field}/{id}", "admin\RolesController@status")->middleware('auth');
Route::get("/admin/roles/export/{type}", "admin\RolesController@getExport")->middleware('auth');
Route::post("/admin/roles/edit", "admin\RolesController@postEdit")->middleware('auth');
Route::post("/admin/roles/delete", "admin\RolesController@delete")->middleware('auth');
Route::get("/admin/roles/view/{id}", "admin\RolesController@view")->middleware('auth');
Route::get("/admin/roles/baja/{id}", "admin\RolesController@view")->middleware('auth');
Route::get("/admin/roles/alta/{id}", "admin\RolesController@view")->middleware('auth');
  //  EO : Roles



// BO : Prospectos
Route::post("/admin/prospectos/deleteAll", "admin\ProspectosController@deleteAll")->middleware('auth');
Route::get("/admin/prospectos", "admin\ProspectosController@index")->middleware('auth');
Route::get("/admin/prospectos/add", "admin\ProspectosController@getAdd")->middleware('auth');
Route::post("/admin/prospectos/add", "admin\ProspectosController@postAdd")->middleware('auth');
Route::get("/admin/prospectos/edit/{id}", "admin\ProspectosController@getEdit")->middleware('auth');
Route::get("/admin/prospectos/status/{field}/{id}", "admin\ProspectosController@status")->middleware('auth');
Route::get("/admin/prospectos/export/{type}", "admin\ProspectosController@getExport")->middleware('auth');
Route::post("/admin/prospectos/edit", "admin\ProspectosController@postEdit")->middleware('auth');
Route::post("/admin/prospectos/delete", "admin\ProspectosController@delete")->middleware('auth');
Route::get("/admin/prospectos/view/{id}", "admin\ProspectosController@view")->middleware('auth');
Route::get("/admin/prospectos/baja/{id}", "admin\ProspectosController@baja")->middleware('auth');
Route::get("/admin/prospectos/alta/{id}", "admin\ProspectosController@alta")->middleware('auth');
Route::get("/admin/prospectos/ajax/{id}", "admin\ProspectosController@getAjax")->middleware('auth');
Route::get("/admin/prospectos/rechaza/{id}", "admin\ProspectosController@postRechazo")->middleware('auth');
Route::get("/admin/prospectos/recupera/{id}", "admin\ProspectosController@postRecupera")->middleware('auth');
  //  EO : Prospectos



// BO : Documentos
Route::post("/admin/documentos/deleteAll", "admin\DocumentosController@deleteAll")->middleware('auth');
Route::get("/admin/documentos", "admin\DocumentosController@index")->middleware('auth');
Route::get("/admin/documentos/add", "admin\DocumentosController@getAdd")->middleware('auth');
Route::post("/admin/documentos/add", "admin\DocumentosController@postAdd")->middleware('auth');
Route::get("/admin/documentos/edit/{id}", "admin\DocumentosController@getEdit")->middleware('auth');
Route::get("/admin/documentos/status/{field}/{id}", "admin\DocumentosController@status")->middleware('auth');
Route::get("/admin/documentos/export/{type}", "admin\DocumentosController@getExport")->middleware('auth');
Route::post("/admin/documentos/edit", "admin\DocumentosController@postEdit")->middleware('auth');
Route::post("/admin/documentos/delete", "admin\DocumentosController@delete")->middleware('auth');
Route::get("/admin/documentos/view/{id}", "admin\DocumentosController@view")->middleware('auth');
Route::get("/admin/documentos/baja/{id}", "admin\DocumentosController@baja")->middleware('auth');
Route::get("/admin/documentos/alta/{id}", "admin\DocumentosController@alta")->middleware('auth');
Route::get("/admin/documentos/ajax/{id}", "admin\DocumentosController@getAjax")->middleware('auth');
  //  EO : Documentos



// BO : Plazos
Route::post("/admin/plazos/deleteAll", "admin\PlazosController@deleteAll")->middleware('auth');
Route::get("/admin/plazos", "admin\PlazosController@index")->middleware('auth');
Route::get("/admin/plazos/add", "admin\PlazosController@getAdd")->middleware('auth');
Route::post("/admin/plazos/add", "admin\PlazosController@postAdd")->middleware('auth');
Route::get("/admin/plazos/edit/{id}", "admin\PlazosController@getEdit")->middleware('auth');
Route::get("/admin/plazos/status/{field}/{id}", "admin\PlazosController@status")->middleware('auth');
Route::get("/admin/plazos/export/{type}", "admin\PlazosController@getExport")->middleware('auth');
Route::post("/admin/plazos/edit", "admin\PlazosController@postEdit")->middleware('auth');
Route::post("/admin/plazos/delete", "admin\PlazosController@delete")->middleware('auth');
Route::get("/admin/plazos/view/{id}", "admin\PlazosController@view")->middleware('auth');
Route::get("/admin/plazos/baja/{id}", "admin\PlazosController@baja")->middleware('auth');
Route::get("/admin/plazos/alta/{id}", "admin\PlazosController@alta")->middleware('auth');
Route::get("/admin/plazos/ajax/{id}", "admin\PlazosController@getAjax")->middleware('auth');
  //  EO : Plazos



// BO : Documentos_reglas
Route::post("/admin/reglas/deleteAll", "admin\Documentos_reglasController@deleteAll")->middleware('auth');
Route::get("/admin/reglas", "admin\Documentos_reglasController@index")->middleware('auth');
Route::get("/admin/reglas/add", "admin\Documentos_reglasController@getAdd")->middleware('auth');
Route::post("/admin/reglas/add", "admin\Documentos_reglasController@postAdd")->middleware('auth');
Route::get("/admin/reglas/edit/{id}", "admin\Documentos_reglasController@getEdit")->middleware('auth');
Route::get("/admin/reglas/status/{field}/{id}", "admin\Documentos_reglasController@status")->middleware('auth');
Route::get("/admin/reglas/export/{type}", "admin\Documentos_reglasController@getExport")->middleware('auth');
Route::post("/admin/reglas/edit", "admin\Documentos_reglasController@postEdit")->middleware('auth');
Route::post("/admin/reglas/delete", "admin\Documentos_reglasController@delete")->middleware('auth');
Route::get("/admin/reglas/view/{id}", "admin\Documentos_reglasController@view")->middleware('auth');
Route::get("/admin/reglas/baja/{id}", "admin\Documentos_reglasController@baja")->middleware('auth');
Route::get("/admin/reglas/alta/{id}", "admin\Documentos_reglasController@alta")->middleware('auth');
Route::get("/admin/reglas/ajax/{id}", "admin\Documentos_reglasController@getAjax")->middleware('auth');
Route::get("/admin/productos/info/{id}", "admin\ProductosController@getDetail")->middleware('auth');
  //  EO : Documentos_reglas



// BO : Productos
Route::post("/admin/productos/deleteAll", "admin\ProductosController@deleteAll")->middleware('auth');
Route::get("/admin/productos", "admin\ProductosController@index")->middleware('auth');
Route::get("/admin/productos/add", "admin\ProductosController@getAdd")->middleware('auth');
Route::post("/admin/productos/add", "admin\ProductosController@postAdd")->middleware('auth');
Route::get("/admin/productos/edit/{id}", "admin\ProductosController@getEdit")->middleware('auth');
Route::get("/admin/productos/status/{field}/{id}", "admin\ProductosController@status")->middleware('auth');
Route::get("/admin/productos/export/{type}", "admin\ProductosController@getExport")->middleware('auth');
Route::post("/admin/productos/edit", "admin\ProductosController@postEdit")->middleware('auth');
Route::post("/admin/productos/delete", "admin\ProductosController@delete")->middleware('auth');
Route::get("/admin/productos/view/{id}", "admin\ProductosController@view")->middleware('auth');
Route::get("/admin/productos/baja/{id}", "admin\ProductosController@baja")->middleware('auth');
Route::get("/admin/productos/alta/{id}", "admin\ProductosController@alta")->middleware('auth');
Route::get("/admin/productos/ajax/{id}", "admin\ProductosController@getAjax")->middleware('auth');
  //  EO : Productos



// BO : Clientes
Route::post("/admin/clientes/deleteAll", "admin\ClientesController@deleteAll")->middleware('auth');
Route::get("/admin/clientes", "admin\ClientesController@index")->middleware('auth');
Route::get("/admin/clientes/add", "admin\ClientesController@getAdd")->middleware('auth');
Route::post("/admin/clientes/add", "admin\ClientesController@postAdd")->middleware('auth');
Route::get("/admin/clientes/edit/{id}", "admin\ClientesController@getEdit")->middleware('auth');
Route::get("/admin/clientes/status/{field}/{id}", "admin\ClientesController@status")->middleware('auth');
Route::get("/admin/clientes/export/{type}", "admin\ClientesController@getExport")->middleware('auth');
Route::post("/admin/clientes/edit", "admin\ClientesController@postEdit")->middleware('auth');
Route::post("/admin/clientes/delete", "admin\ClientesController@delete")->middleware('auth');
Route::get("/admin/clientes/view/{id}", "admin\ClientesController@view")->middleware('auth');
Route::get("/admin/clientes/baja/{id}", "admin\ClientesController@baja")->middleware('auth');
Route::get("/admin/clientes/alta/{id}", "admin\ClientesController@alta")->middleware('auth');
Route::get("/admin/clientes/ajax/{id}", "admin\ClientesController@getAjax")->middleware('auth');
Route::post('/admin/clientes/telefonos/duplicados', 'admin\ClientesController@BuscarTelefonosDuplicadosAjax')->middleware('auth');
  //  EO : Clientes



// BO : Solicitudes
Route::post("/admin/solicitudes/deleteAll", "admin\SolicitudesController@deleteAll")->middleware('auth');
Route::get("/admin/solicitudes", "admin\SolicitudesController@index")->middleware('auth');
Route::get("/admin/solicitudes/add", "admin\SolicitudesController@getAdd")->middleware('auth');
Route::post("/admin/solicitudes/add", "admin\SolicitudesController@postAdd")->middleware('auth');
Route::get("/admin/solicitudes/edit/{id}", "admin\SolicitudesController@getEdit")->middleware('auth');
Route::get("/admin/solicitudes/status/{field}/{id}", "admin\SolicitudesController@status")->middleware('auth');
Route::get("/admin/solicitudes/export/{type}", "admin\SolicitudesController@getExport")->middleware('auth');
Route::post("/admin/solicitudes/edit", "admin\SolicitudesController@postEdit")->middleware('auth');
Route::post("/admin/solicitudes/delete", "admin\SolicitudesController@delete")->middleware('auth');
Route::get("/admin/solicitudes/view/{id}", "admin\SolicitudesController@view")->middleware('auth');
Route::get("/admin/solicitudes/baja/{id}", "admin\SolicitudesController@baja")->middleware('auth');
Route::get("/admin/solicitudes/alta/{id}", "admin\SolicitudesController@alta")->middleware('auth');
Route::get("/admin/solicitudes/ajax/{id}", "admin\SolicitudesController@getAjax")->middleware('auth');
Route::get("/admin/solicitudes/rechazos", "admin\SolicitudesController@rechazos")->middleware('auth');
Route::post("/admin/solicitudes/verificarnombre", "admin\SolicitudesController@validarNombrecompleto")->middleware('auth');
Route::get("/admin/solicitudes/avanzar/{id}", "admin\SolicitudesController@postAvanza")->middleware('auth');

Route::get("/admin/solicitudes/aprobar/{id}", "admin\SolicitudesController@potAprueba")->middleware('auth');

Route::get("/admin/solicitudes/documentacion/{producto_id}", "admin\SolicitudesController@getExpediente")->middleware('auth');


Route::get("/admin/solicitudes/aprobacion", "admin\SolicitudesController@getPendAprobacion")->middleware('auth');
Route::get("/admin/solicitudes/aprobacion/{id}", "admin\SolicitudesController@getAprobacion")->middleware('auth');
Route::post("/admin/solicitudes/aprobacion", "admin\SolicitudesController@postAprobacion")->middleware('auth');

Route::get("/admin/solicitudes/firma", "admin\SolicitudesController@getPendFirma")->middleware('auth');
Route::get("/admin/solicitudes/firmar/{id}", "admin\SolicitudesController@getFirmar")->middleware('auth');
Route::post("/admin/solicitudes/firmar", "admin\SolicitudesController@postFirmar")->middleware('auth');

  //  EO : Solicitudes



// BO : Dispersion
Route::get("/admin/dispersion", "admin\SolicitudesController@dispersion")->middleware('auth');
Route::get("/admin/solicitudes/dispersion/{id}", "admin\SolicitudesController@dispersionview")->middleware('auth');
Route::post("/admin/solicitudes/guardarMovimientoDispersion", "admin\SolicitudesController@guardarMovimientoDispersion")->middleware('auth');


Route::post("/admin/dispersion/deleteAll", "admin\DispersionController@deleteAll")->middleware('auth');
Route::get("/admin/dispersion/add", "admin\DispersionController@getAdd")->middleware('auth');
Route::post("/admin/dispersion/add", "admin\DispersionController@postAdd")->middleware('auth');
Route::get("/admin/dispersion/edit/{id}", "admin\DispersionController@getEdit")->middleware('auth');
Route::get("/admin/dispersion/status/{field}/{id}", "admin\DispersionController@status")->middleware('auth');
Route::get("/admin/dispersion/export/{type}", "admin\DispersionController@getExport")->middleware('auth');
Route::post("/admin/dispersion/edit", "admin\DispersionController@postEdit")->middleware('auth');
Route::post("/admin/dispersion/delete", "admin\DispersionController@delete")->middleware('auth');
Route::get("/admin/dispersion/view/{id}", "admin\DispersionController@view")->middleware('auth');
Route::get("/admin/dispersion/baja/{id}", "admin\DispersionController@baja")->middleware('auth');
Route::get("/admin/dispersion/alta/{id}", "admin\DispersionController@alta")->middleware('auth');
Route::get("/admin/dispersion/ajax/{id}", "admin\DispersionController@getAjax")->middleware('auth');
  //  EO : Dispersion



// BO : Creditos
Route::get("/admin/creditos", "admin\CreditosController@index")->middleware('auth');
Route::get("/admin/creditos/vigentes", "admin\CreditosController@index")->middleware('auth');
Route::get("/admin/creditos/pagados", "admin\CreditosController@pagados")->middleware('auth');
Route::get("/admin/creditos/vencidos", "admin\CreditosController@vencidos")->middleware('auth');


Route::get("/admin/creditos/add", "admin\CreditosController@getAdd")->middleware('auth');
Route::post("/admin/creditos/add", "admin\CreditosController@postAdd")->middleware('auth');
Route::get("/admin/creditos/edit/{id}", "admin\CreditosController@getEdit")->middleware('auth');
Route::get("/admin/creditos/status/{field}/{id}", "admin\CreditosController@status")->middleware('auth');
Route::get("/admin/creditos/export/{type}", "admin\CreditosController@getExport")->middleware('auth');
Route::post("/admin/creditos/edit", "admin\CreditosController@postEdit")->middleware('auth');
Route::post("/admin/creditos/delete", "admin\CreditosController@delete")->middleware('auth');
Route::get("/admin/creditos/view/{id}", "admin\CreditosController@view")->middleware('auth');
Route::get("/admin/creditos/baja/{id}", "admin\CreditosController@baja")->middleware('auth');
Route::get("/admin/creditos/alta/{id}", "admin\CreditosController@alta")->middleware('auth');
Route::get("/admin/creditos/ajax/{id}", "admin\CreditosController@getAjax")->middleware('auth');

Route::get("/admin/creditos/buscar", "admin\CreditosController@getSearch")->middleware('auth');
Route::get("/admin/creditos/seleccion/{id}", "admin\CreditosController@getSeleccion")->middleware('auth');

Route::get("/admin/creditos/byAsesor/{id}", "admin\CreditosController@getByAsesor")->middleware('auth');

  //  EO : Creditos



// BO : Pagos

//Aplicar Pago
Route::get("/admin/pagos/add", "admin\PagosController@getAdd")->middleware('auth');
Route::post("/admin/pagos/add", "admin\PagosController@postAdd")->middleware('auth');

//Generar Layout
Route::get("/admin/pagos/layout", "admin\PagosController@getGenerate")->middleware('auth');
Route::post("/admin/pagos/layout", "admin\PagosController@postGenerate")->middleware('auth');

//Cancelar Pago
Route::get("/admin/pagos/cancel", "admin\PagosController@getCancel")->middleware('auth');
Route::post("/admin/pagos/cancel", "admin\PagosController@postCancel")->middleware('auth');

//Utilerias
Route::get("/admin/pagos/buscar", "admin\PagosController@getSearch")->middleware('auth');
Route::get("/admin/pagos/calendario", "admin\PagosController@getCalendar")->middleware('auth');

Route::get("/admin/pagos/captura", "admin\PagosController@getAplicar")->middleware('auth');
Route::get("/admin/pagos/traeLayouts/{id}", "admin\PagosController@getActiveLayouts")->middleware('auth');
Route::get("/admin/pagos/traeCreditos/{id}", "admin\PagosController@getCreditosLayouts")->middleware('auth');
Route::post("/admin/pagos/apply", "admin\PagosController@applyLayout")->middleware('auth');


Route::post("/admin/pagos/deleteAll", "admin\PagosController@deleteAll")->middleware('auth');
Route::get("/admin/pagos", "admin\PagosController@index")->middleware('auth');
Route::get("/admin/pagos/edit/{id}", "admin\PagosController@getEdit")->middleware('auth');
Route::get("/admin/pagos/status/{field}/{id}", "admin\PagosController@status")->middleware('auth');
Route::get("/admin/pagos/export/{type}", "admin\PagosController@getExport")->middleware('auth');
Route::post("/admin/pagos/edit", "admin\PagosController@postEdit")->middleware('auth');
Route::post("/admin/pagos/delete", "admin\PagosController@delete")->middleware('auth');
Route::get("/admin/pagos/view/{id}", "admin\PagosController@view")->middleware('auth');
Route::get("/admin/pagos/baja/{id}", "admin\PagosController@baja")->middleware('auth');
Route::get("/admin/pagos/alta/{id}", "admin\PagosController@alta")->middleware('auth');
Route::get("/admin/pagos/ajax/{id}", "admin\PagosController@getAjax")->middleware('auth');
  //  EO : Pagos



// BO : Asesores
Route::post("/admin/asesores/deleteAll", "admin\AsesoresController@deleteAll")->middleware('auth');
Route::get("/admin/asesores", "admin\AsesoresController@index")->middleware('auth');
Route::get("/admin/asesores/add", "admin\AsesoresController@getAdd")->middleware('auth');
Route::post("/admin/asesores/add", "admin\AsesoresController@postAdd")->middleware('auth');
Route::get("/admin/asesores/edit/{id}", "admin\AsesoresController@getEdit")->middleware('auth');
Route::get("/admin/asesores/status/{field}/{id}", "admin\AsesoresController@status")->middleware('auth');
Route::get("/admin/asesores/export/{type}", "admin\AsesoresController@getExport")->middleware('auth');
Route::post("/admin/asesores/edit", "admin\AsesoresController@postEdit")->middleware('auth');
Route::post("/admin/asesores/delete", "admin\AsesoresController@delete")->middleware('auth');
Route::get("/admin/asesores/view/{id}", "admin\AsesoresController@view")->middleware('auth');
Route::get("/admin/asesores/baja/{id}", "admin\AsesoresController@baja")->middleware('auth');
Route::get("/admin/asesores/alta/{id}", "admin\AsesoresController@alta")->middleware('auth');
Route::get("/admin/asesores/ajax/{id}", "admin\AsesoresController@getAjax")->middleware('auth');


Route::get("/admin/asesores/agentes/{id}", "admin\AsesoresController@getAgentes")->middleware('auth');
  //  EO : Asesores



// BO : Creditos_cuotas
Route::post("/admin/creditos_cuotas/deleteAll", "admin\Creditos_cuotasController@deleteAll")->middleware('auth');
Route::get("/admin/creditos_cuotas", "admin\Creditos_cuotasController@index")->middleware('auth');
Route::get("/admin/creditos_cuotas/add", "admin\Creditos_cuotasController@getAdd")->middleware('auth');
Route::post("/admin/creditos_cuotas/add", "admin\Creditos_cuotasController@postAdd")->middleware('auth');
Route::get("/admin/creditos_cuotas/edit/{id}", "admin\Creditos_cuotasController@getEdit")->middleware('auth');
Route::get("/admin/creditos_cuotas/status/{field}/{id}", "admin\Creditos_cuotasController@status")->middleware('auth');
Route::get("/admin/creditos_cuotas/export/{type}", "admin\Creditos_cuotasController@getExport")->middleware('auth');
Route::post("/admin/creditos_cuotas/edit", "admin\Creditos_cuotasController@postEdit")->middleware('auth');
Route::post("/admin/creditos_cuotas/delete", "admin\Creditos_cuotasController@delete")->middleware('auth');
Route::get("/admin/creditos_cuotas/view/{id}", "admin\Creditos_cuotasController@view")->middleware('auth');
Route::get("/admin/creditos_cuotas/baja/{id}", "admin\Creditos_cuotasController@baja")->middleware('auth');
Route::get("/admin/creditos_cuotas/alta/{id}", "admin\Creditos_cuotasController@alta")->middleware('auth');
Route::get("/admin/creditos_cuotas/ajax/{id}", "admin\Creditos_cuotasController@getAjax")->middleware('auth');
  //  EO : Creditos_cuotas



// BO : Productos_montos
Route::post("/admin/productos_montos/deleteAll", "admin\Productos_montosController@deleteAll")->middleware('auth');
Route::get("/admin/productos_montos", "admin\Productos_montosController@index")->middleware('auth');
Route::get("/admin/productos_montos/add", "admin\Productos_montosController@getAdd")->middleware('auth');
Route::post("/admin/productos_montos/add", "admin\Productos_montosController@postAdd")->middleware('auth');
Route::get("/admin/productos_montos/edit/{id}", "admin\Productos_montosController@getEdit")->middleware('auth');
Route::get("/admin/productos_montos/status/{field}/{id}", "admin\Productos_montosController@status")->middleware('auth');
Route::get("/admin/productos_montos/export/{type}", "admin\Productos_montosController@getExport")->middleware('auth');
Route::post("/admin/productos_montos/edit", "admin\Productos_montosController@postEdit")->middleware('auth');
Route::post("/admin/productos_montos/delete", "admin\Productos_montosController@delete")->middleware('auth');
Route::get("/admin/productos_montos/view/{id}", "admin\Productos_montosController@view")->middleware('auth');
Route::get("/admin/productos_montos/baja/{id}", "admin\Productos_montosController@baja")->middleware('auth');
Route::get("/admin/productos_montos/alta/{id}", "admin\Productos_montosController@alta")->middleware('auth');
Route::get("/admin/productos_montos/ajax/{id}", "admin\Productos_montosController@getAjax")->middleware('auth');
  //  EO : Productos_montos



// BO : Productos_pagos
Route::post("/admin/productos_pagos/deleteAll", "admin\Productos_pagosController@deleteAll")->middleware('auth');
Route::get("/admin/productos_pagos", "admin\Productos_pagosController@index")->middleware('auth');
Route::get("/admin/productos_pagos/add", "admin\Productos_pagosController@getAdd")->middleware('auth');
Route::post("/admin/productos_pagos/add", "admin\Productos_pagosController@postAdd")->middleware('auth');
Route::get("/admin/productos_pagos/edit/{id}", "admin\Productos_pagosController@getEdit")->middleware('auth');
Route::get("/admin/productos_pagos/status/{field}/{id}", "admin\Productos_pagosController@status")->middleware('auth');
Route::get("/admin/productos_pagos/export/{type}", "admin\Productos_pagosController@getExport")->middleware('auth');
Route::post("/admin/productos_pagos/edit", "admin\Productos_pagosController@postEdit")->middleware('auth');
Route::post("/admin/productos_pagos/delete", "admin\Productos_pagosController@delete")->middleware('auth');
Route::get("/admin/productos_pagos/view/{id}", "admin\Productos_pagosController@view")->middleware('auth');
Route::get("/admin/productos_pagos/baja/{id}", "admin\Productos_pagosController@baja")->middleware('auth');
Route::get("/admin/productos_pagos/alta/{id}", "admin\Productos_pagosController@alta")->middleware('auth');
Route::get("/admin/productos_pagos/ajax/{id}", "admin\Productos_pagosController@getAjax")->middleware('auth');
  //  EO : Productos_pagos


//Expediente_digital
Route::get("/admin/expediente_digital", "admin\Expediente_digitalController@index")->middleware('auth');
Route::get("/admin/expediente_digital/valida_doc/{id}", "admin\Expediente_digitalController@validaDocumento")->middleware('auth');

Route::get("/admin/expediente_digital/valida", "admin\Expediente_digitalController@getValidar")->middleware('auth');
Route::get("/admin/expediente_digital/aprobado/{id}", "admin\Expediente_digitalController@postValidar")->middleware('auth');

Route::get("/admin/expediente_digital/documentos/{id}", "admin\Expediente_digitalController@documentos")->middleware('auth');
Route::post("/admin/expediente_digital/upload_file", "admin\Expediente_digitalController@upload_file")->middleware('auth');
Route::get("/admin/expediente_digital/delete_file/{id}", "admin\Expediente_digitalController@delete_file")->middleware('auth');
Route::post("/admin/expediente_digital/historial_documento", "admin\Expediente_digitalController@historial_documento")->middleware('auth');
Route::get("/admin/expediente_digital/validacion/{id}", "admin\Expediente_digitalController@validacion")->middleware('auth');
Route::post("/admin/expediente-digital/rechazo", "admin\Expediente_digitalController@setRechazo")->middleware('auth');
Route::post("/admin/expediente_digital/get_reglas", "admin\Expediente_digitalController@get_reglas")->middleware('auth');
Route::post("/admin/expediente_digital/validar_expediente", "admin\Expediente_digitalController@validar_expediente")->middleware('auth');



							// BO : Solicitudes_expediente
						  Route::post("/admin/solicitudes_expediente/deleteAll", "admin\Solicitudes_expedienteController@deleteAll")->middleware('auth');
						  Route::get("/admin/solicitudes_expediente", "admin\Solicitudes_expedienteController@index")->middleware('auth');
							Route::get("/admin/solicitudes_expediente/add", "admin\Solicitudes_expedienteController@getAdd")->middleware('auth');
							Route::post("/admin/solicitudes_expediente/add", "admin\Solicitudes_expedienteController@postAdd")->middleware('auth');
							Route::get("/admin/solicitudes_expediente/edit/{id}", "admin\Solicitudes_expedienteController@getEdit")->middleware('auth');
							Route::get("/admin/solicitudes_expediente/status/{field}/{id}", "admin\Solicitudes_expedienteController@status")->middleware('auth');
							Route::get("/admin/solicitudes_expediente/export/{type}", "admin\Solicitudes_expedienteController@getExport")->middleware('auth');
							Route::post("/admin/solicitudes_expediente/edit", "admin\Solicitudes_expedienteController@postEdit")->middleware('auth');
							Route::post("/admin/solicitudes_expediente/delete", "admin\Solicitudes_expedienteController@delete")->middleware('auth');
							Route::get("/admin/solicitudes_expediente/view/{id}", "admin\Solicitudes_expedienteController@view")->middleware('auth');
							Route::get("/admin/solicitudes_expediente/baja/{id}", "admin\Solicitudes_expedienteController@baja")->middleware('auth');
							Route::get("/admin/solicitudes_expediente/alta/{id}", "admin\Solicitudes_expedienteController@alta")->middleware('auth');
							Route::get("/admin/solicitudes_expediente/ajax/{id}", "admin\Solicitudes_expedienteController@getAjax")->middleware('auth');
						    //  EO : Solicitudes_expediente



							// BO : Creditos_pagos
						  Route::post("/admin/creditos_pagos/deleteAll", "admin\Creditos_pagosController@deleteAll")->middleware('auth');
						  Route::get("/admin/creditos_pagos", "admin\Creditos_pagosController@index")->middleware('auth');
							Route::get("/admin/creditos_pagos/add", "admin\Creditos_pagosController@getAdd")->middleware('auth');
							Route::post("/admin/creditos_pagos/add", "admin\Creditos_pagosController@postAdd")->middleware('auth');
							Route::get("/admin/creditos_pagos/edit/{id}", "admin\Creditos_pagosController@getEdit")->middleware('auth');
							Route::get("/admin/creditos_pagos/status/{field}/{id}", "admin\Creditos_pagosController@status")->middleware('auth');
							Route::get("/admin/creditos_pagos/export/{type}", "admin\Creditos_pagosController@getExport")->middleware('auth');
							Route::post("/admin/creditos_pagos/edit", "admin\Creditos_pagosController@postEdit")->middleware('auth');
							Route::post("/admin/creditos_pagos/delete", "admin\Creditos_pagosController@delete")->middleware('auth');
							Route::get("/admin/creditos_pagos/view/{id}", "admin\Creditos_pagosController@view")->middleware('auth');
							Route::get("/admin/creditos_pagos/baja/{id}", "admin\Creditos_pagosController@baja")->middleware('auth');
							Route::get("/admin/creditos_pagos/alta/{id}", "admin\Creditos_pagosController@alta")->middleware('auth');
							Route::get("/admin/creditos_pagos/ajax/{id}", "admin\Creditos_pagosController@getAjax")->middleware('auth');
						    //  EO : Creditos_pagos



							// BO : Creditos_transacciones
						  Route::post("/admin/creditos_transacciones/deleteAll", "admin\Creditos_transaccionesController@deleteAll")->middleware('auth');
						  Route::get("/admin/creditos_transacciones", "admin\Creditos_transaccionesController@index")->middleware('auth');
							Route::get("/admin/creditos_transacciones/add", "admin\Creditos_transaccionesController@getAdd")->middleware('auth');
							Route::post("/admin/creditos_transacciones/add", "admin\Creditos_transaccionesController@postAdd")->middleware('auth');
							Route::get("/admin/creditos_transacciones/edit/{id}", "admin\Creditos_transaccionesController@getEdit")->middleware('auth');
							Route::get("/admin/creditos_transacciones/status/{field}/{id}", "admin\Creditos_transaccionesController@status")->middleware('auth');
							Route::get("/admin/creditos_transacciones/export/{type}", "admin\Creditos_transaccionesController@getExport")->middleware('auth');
							Route::post("/admin/creditos_transacciones/edit", "admin\Creditos_transaccionesController@postEdit")->middleware('auth');
							Route::post("/admin/creditos_transacciones/delete", "admin\Creditos_transaccionesController@delete")->middleware('auth');
							Route::get("/admin/creditos_transacciones/view/{id}", "admin\Creditos_transaccionesController@view")->middleware('auth');
							Route::get("/admin/creditos_transacciones/baja/{id}", "admin\Creditos_transaccionesController@baja")->middleware('auth');
							Route::get("/admin/creditos_transacciones/alta/{id}", "admin\Creditos_transaccionesController@alta")->middleware('auth');
							Route::get("/admin/creditos_transacciones/ajax/{id}", "admin\Creditos_transaccionesController@getAjax")->middleware('auth');
						    //  EO : Creditos_transacciones



							// BO : Agentes
						  Route::post("/admin/agentes/deleteAll", "admin\AgentesController@deleteAll")->middleware('auth');
						  Route::get("/admin/agentes", "admin\AgentesController@index")->middleware('auth');
							Route::get("/admin/agentes/add", "admin\AgentesController@getAdd")->middleware('auth');
							Route::post("/admin/agentes/add", "admin\AgentesController@postAdd")->middleware('auth');
							Route::get("/admin/agentes/edit/{id}", "admin\AgentesController@getEdit")->middleware('auth');
							Route::get("/admin/agentes/status/{field}/{id}", "admin\AgentesController@status")->middleware('auth');
							Route::get("/admin/agentes/export/{type}", "admin\AgentesController@getExport")->middleware('auth');
							Route::post("/admin/agentes/edit", "admin\AgentesController@postEdit")->middleware('auth');
							Route::post("/admin/agentes/delete", "admin\AgentesController@delete")->middleware('auth');
							Route::get("/admin/agentes/view/{id}", "admin\AgentesController@view")->middleware('auth');
							Route::get("/admin/agentes/baja/{id}", "admin\AgentesController@baja")->middleware('auth');
							Route::get("/admin/agentes/alta/{id}", "admin\AgentesController@alta")->middleware('auth');
							Route::get("/admin/agentes/ajax/{id}", "admin\AgentesController@getAjax")->middleware('auth');
						    //  EO : Agentes

						   // @@@@@#####@@@@@










//Home
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');
Route::get('/admin/home', 'HomeController@index');
//Home

Auth::routes();


Route::get('storage/{name}/{folder}/{image}', function($name, $folder, $image){

  $path = storage_path().'/app/public/'.$name .'/'. $folder. '/'. $image ;

  if (file_exists($path)) {
  	header("Content-type: image/jpeg");
  	readfile($path);
  }else{
  	return $path;
  }

});
