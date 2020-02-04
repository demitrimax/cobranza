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

Route::group(['middleware'=>['auth']], function() {
    // BO : Users
    Route::post("/admin/users/deleteAll", "admin\UsersController@deleteAll");
    Route::get("/admin/users", "admin\UsersController@index");
    Route::get("/admin/users/add", "admin\UsersController@getAdd");
    Route::post("/admin/users/add", "admin\UsersController@postAdd");
    Route::get("/admin/users/edit/{id}", "admin\UsersController@getEdit");
    Route::get("/admin/users/status/{field}/{id}", "admin\UsersController@status");
    Route::get("/admin/users/export/{type}", "admin\UsersController@getExport");
    Route::post("/admin/users/edit", "admin\UsersController@postEdit");
    Route::post("/admin/users/delete", "admin\UsersController@delete");
    Route::get("/admin/users/view/{id}", "admin\UsersController@view");
    Route::get("/admin/users/baja/{id}", "admin\UsersController@baja");
    Route::get("/admin/users/alta/{id}", "admin\UsersController@alta");
    //  EO : Users

    // BO : Roles
    Route::post("/admin/roles/deleteAll", "admin\RolesController@deleteAll");
    Route::get("/admin/roles", "admin\RolesController@index");
    Route::get("/admin/roles/add", "admin\RolesController@getAdd");
    Route::post("/admin/roles/add", "admin\RolesController@postAdd");
    Route::get("/admin/roles/edit/{id}", "admin\RolesController@getEdit");
    Route::get("/admin/roles/status/{field}/{id}", "admin\RolesController@status");
    Route::get("/admin/roles/export/{type}", "admin\RolesController@getExport");
    Route::post("/admin/roles/edit", "admin\RolesController@postEdit");
    Route::post("/admin/roles/delete", "admin\RolesController@delete");
    Route::get("/admin/roles/view/{id}", "admin\RolesController@view");
    Route::get("/admin/roles/baja/{id}", "admin\RolesController@view");
    Route::get("/admin/roles/alta/{id}", "admin\RolesController@view");
      //  EO : Roles


    // BO : Prospectos
    Route::post("/admin/prospectos/deleteAll", "admin\ProspectosController@deleteAll");
    Route::get("/admin/prospectos", "admin\ProspectosController@index");
    Route::get("/admin/prospectos/add", "admin\ProspectosController@getAdd");
    Route::post("/admin/prospectos/add", "admin\ProspectosController@postAdd");
    Route::get("/admin/prospectos/edit/{id}", "admin\ProspectosController@getEdit");
    Route::get("/admin/prospectos/status/{field}/{id}", "admin\ProspectosController@status");
    Route::get("/admin/prospectos/export/{type}", "admin\ProspectosController@getExport");
    Route::post("/admin/prospectos/edit", "admin\ProspectosController@postEdit");
    Route::post("/admin/prospectos/delete", "admin\ProspectosController@delete");
    Route::get("/admin/prospectos/view/{id}", "admin\ProspectosController@view");
    Route::get("/admin/prospectos/baja/{id}", "admin\ProspectosController@baja");
    Route::get("/admin/prospectos/alta/{id}", "admin\ProspectosController@alta");
    Route::get("/admin/prospectos/ajax/{id}", "admin\ProspectosController@getAjax");
    Route::get("/admin/prospectos/rechaza/{id}", "admin\ProspectosController@postRechazo");
    Route::get("/admin/prospectos/recupera/{id}", "admin\ProspectosController@postRecupera");
      //  EO : Prospectos



    // BO : Documentos
    Route::post("/admin/documentos/deleteAll", "admin\DocumentosController@deleteAll");
    Route::get("/admin/documentos", "admin\DocumentosController@index");
    Route::get("/admin/documentos/add", "admin\DocumentosController@getAdd");
    Route::post("/admin/documentos/add", "admin\DocumentosController@postAdd");
    Route::get("/admin/documentos/edit/{id}", "admin\DocumentosController@getEdit");
    Route::get("/admin/documentos/status/{field}/{id}", "admin\DocumentosController@status");
    Route::get("/admin/documentos/export/{type}", "admin\DocumentosController@getExport");
    Route::post("/admin/documentos/edit", "admin\DocumentosController@postEdit");
    Route::post("/admin/documentos/delete", "admin\DocumentosController@delete");
    Route::get("/admin/documentos/view/{id}", "admin\DocumentosController@view");
    Route::get("/admin/documentos/baja/{id}", "admin\DocumentosController@baja");
    Route::get("/admin/documentos/alta/{id}", "admin\DocumentosController@alta");
    Route::get("/admin/documentos/ajax/{id}", "admin\DocumentosController@getAjax");
      //  EO : Documentos



    // BO : Plazos
    Route::post("/admin/plazos/deleteAll", "admin\PlazosController@deleteAll");
    Route::get("/admin/plazos", "admin\PlazosController@index");
    Route::get("/admin/plazos/add", "admin\PlazosController@getAdd");
    Route::post("/admin/plazos/add", "admin\PlazosController@postAdd");
    Route::get("/admin/plazos/edit/{id}", "admin\PlazosController@getEdit");
    Route::get("/admin/plazos/status/{field}/{id}", "admin\PlazosController@status");
    Route::get("/admin/plazos/export/{type}", "admin\PlazosController@getExport");
    Route::post("/admin/plazos/edit", "admin\PlazosController@postEdit");
    Route::post("/admin/plazos/delete", "admin\PlazosController@delete");
    Route::get("/admin/plazos/view/{id}", "admin\PlazosController@view");
    Route::get("/admin/plazos/baja/{id}", "admin\PlazosController@baja");
    Route::get("/admin/plazos/alta/{id}", "admin\PlazosController@alta");
    Route::get("/admin/plazos/ajax/{id}", "admin\PlazosController@getAjax");
      //  EO : Plazos



    // BO : Documentos_reglas
    Route::post("/admin/reglas/deleteAll", "admin\Documentos_reglasController@deleteAll");
    Route::get("/admin/reglas", "admin\Documentos_reglasController@index");
    Route::get("/admin/reglas/add", "admin\Documentos_reglasController@getAdd");
    Route::post("/admin/reglas/add", "admin\Documentos_reglasController@postAdd");
    Route::get("/admin/reglas/edit/{id}", "admin\Documentos_reglasController@getEdit");
    Route::get("/admin/reglas/status/{field}/{id}", "admin\Documentos_reglasController@status");
    Route::get("/admin/reglas/export/{type}", "admin\Documentos_reglasController@getExport");
    Route::post("/admin/reglas/edit", "admin\Documentos_reglasController@postEdit");
    Route::post("/admin/reglas/delete", "admin\Documentos_reglasController@delete");
    Route::get("/admin/reglas/view/{id}", "admin\Documentos_reglasController@view");
    Route::get("/admin/reglas/baja/{id}", "admin\Documentos_reglasController@baja");
    Route::get("/admin/reglas/alta/{id}", "admin\Documentos_reglasController@alta");
    Route::get("/admin/reglas/ajax/{id}", "admin\Documentos_reglasController@getAjax");
    Route::get("/admin/productos/info/{id}", "admin\ProductosController@getDetail");
      //  EO : Documentos_reglas



    // BO : Productos
    Route::post("/admin/productos/deleteAll", "admin\ProductosController@deleteAll");
    Route::get("/admin/productos", "admin\ProductosController@index");
    Route::get("/admin/productos/add", "admin\ProductosController@getAdd");
    Route::post("/admin/productos/add", "admin\ProductosController@postAdd");
    Route::get("/admin/productos/edit/{id}", "admin\ProductosController@getEdit");
    Route::get("/admin/productos/status/{field}/{id}", "admin\ProductosController@status");
    Route::get("/admin/productos/export/{type}", "admin\ProductosController@getExport");
    Route::post("/admin/productos/edit", "admin\ProductosController@postEdit");
    Route::post("/admin/productos/delete", "admin\ProductosController@delete");
    Route::get("/admin/productos/view/{id}", "admin\ProductosController@view");
    Route::get("/admin/productos/baja/{id}", "admin\ProductosController@baja");
    Route::get("/admin/productos/alta/{id}", "admin\ProductosController@alta");
    Route::get("/admin/productos/ajax/{id}", "admin\ProductosController@getAjax");
      //  EO : Productos



    // BO : Clientes
    Route::post("/admin/clientes/deleteAll", "admin\ClientesController@deleteAll");
    Route::get("/admin/clientes", "admin\ClientesController@index");
    Route::get("/admin/clientes/add", "admin\ClientesController@getAdd");
    Route::post("/admin/clientes/add", "admin\ClientesController@postAdd");
    Route::get("/admin/clientes/edit/{id}", "admin\ClientesController@getEdit");
    Route::get("/admin/clientes/status/{field}/{id}", "admin\ClientesController@status");
    Route::get("/admin/clientes/export/{type}", "admin\ClientesController@getExport");
    Route::post("/admin/clientes/edit", "admin\ClientesController@postEdit");
    Route::post("/admin/clientes/delete", "admin\ClientesController@delete");
    Route::get("/admin/clientes/view/{id}", "admin\ClientesController@view");
    Route::get("/admin/clientes/baja/{id}", "admin\ClientesController@baja");
    Route::get("/admin/clientes/alta/{id}", "admin\ClientesController@alta");
    Route::get("/admin/clientes/ajax/{id}", "admin\ClientesController@getAjax");
    Route::post('/admin/clientes/telefonos/duplicados', 'admin\ClientesController@BuscarTelefonosDuplicadosAjax');
      //  EO : Clientes



    // BO : Solicitudes
    Route::post("/admin/solicitudes/deleteAll", "admin\SolicitudesController@deleteAll");
    Route::get("/admin/solicitudes", "admin\SolicitudesController@index");
    Route::get("/admin/solicitudes/add", "admin\SolicitudesController@getAdd");
    Route::post("/admin/solicitudes/add", "admin\SolicitudesController@postAdd");

    Route::get('/admin/solicitudes/{id}/refinanciar/{clientid}', 'admin\SolicitudesController@refinanciar');
    Route::post('admin/solicitudes/refinanciar', 'admin\SolicitudesController@refinanciarCredito');

    Route::get("/admin/solicitudes/edit/{id}", "admin\SolicitudesController@getEdit");
    Route::get("/admin/solicitudes/status/{field}/{id}", "admin\SolicitudesController@status");
    Route::get("/admin/solicitudes/export/{type}", "admin\SolicitudesController@getExport");
    Route::post("/admin/solicitudes/edit", "admin\SolicitudesController@postEdit");
    Route::post("/admin/solicitudes/delete", "admin\SolicitudesController@delete");
    Route::get("/admin/solicitudes/view/{id}", "admin\SolicitudesController@view");
    Route::get("/admin/solicitudes/baja/{id}", "admin\SolicitudesController@baja");
    Route::get("/admin/solicitudes/alta/{id}", "admin\SolicitudesController@alta");
    Route::get("/admin/solicitudes/ajax/{id}", "admin\SolicitudesController@getAjax");
    Route::get("/admin/solicitudes/rechazos", "admin\SolicitudesController@rechazos");
    Route::post("/admin/solicitudes/verificarnombre", "admin\SolicitudesController@validarNombrecompleto");
    Route::get("/admin/solicitudes/avanzar/{id}", "admin\SolicitudesController@postAvanza");

    Route::get("/admin/solicitudes/aprobar/{id}", "admin\SolicitudesController@potAprueba");

    Route::get("/admin/solicitudes/documentacion/{producto_id}", "admin\SolicitudesController@getExpediente");


    Route::get("/admin/solicitudes/aprobacion", "admin\SolicitudesController@getPendAprobacion");
    Route::get("/admin/solicitudes/aprobacion/{id}", "admin\SolicitudesController@getAprobacion");
    Route::post("/admin/solicitudes/aprobacion", "admin\SolicitudesController@postAprobacion");

    Route::get("/admin/solicitudes/firma", "admin\SolicitudesController@getPendFirma");
    Route::get("/admin/solicitudes/firmar/{id}", "admin\SolicitudesController@getFirmar");
    Route::post("/admin/solicitudes/firmar", "admin\SolicitudesController@postFirmar");

      //  EO : Solicitudes



    // BO : Dispersion
    Route::get("/admin/dispersion", "admin\SolicitudesController@dispersion");
    Route::get("/admin/solicitudes/dispersion/{id}", "admin\SolicitudesController@dispersionview");
    Route::post("/admin/solicitudes/guardarMovimientoDispersion", "admin\SolicitudesController@guardarMovimientoDispersion");


    Route::post("/admin/dispersion/deleteAll", "admin\DispersionController@deleteAll");
    Route::get("/admin/dispersion/add", "admin\DispersionController@getAdd");
    Route::post("/admin/dispersion/add", "admin\DispersionController@postAdd");
    Route::get("/admin/dispersion/edit/{id}", "admin\DispersionController@getEdit");
    Route::get("/admin/dispersion/status/{field}/{id}", "admin\DispersionController@status");
    Route::get("/admin/dispersion/export/{type}", "admin\DispersionController@getExport");
    Route::post("/admin/dispersion/edit", "admin\DispersionController@postEdit");
    Route::post("/admin/dispersion/delete", "admin\DispersionController@delete");
    Route::get("/admin/dispersion/view/{id}", "admin\DispersionController@view");
    Route::get("/admin/dispersion/baja/{id}", "admin\DispersionController@baja");
    Route::get("/admin/dispersion/alta/{id}", "admin\DispersionController@alta");
    Route::get("/admin/dispersion/ajax/{id}", "admin\DispersionController@getAjax");
      //  EO : Dispersion



    // BO : Creditos
    Route::get("/admin/creditos", "admin\CreditosController@index");
    Route::get("/admin/creditos/vigentes", "admin\CreditosController@index");
    Route::get("/admin/creditos/pagados", "admin\CreditosController@pagados");
    Route::get("/admin/creditos/vencidos", "admin\CreditosController@vencidos");


    Route::get("/admin/creditos/add", "admin\CreditosController@getAdd");
    Route::post("/admin/creditos/add", "admin\CreditosController@postAdd");
    Route::get("/admin/creditos/edit/{id}", "admin\CreditosController@getEdit");
    Route::get("/admin/creditos/status/{field}/{id}", "admin\CreditosController@status");
    Route::get("/admin/creditos/export/{type}", "admin\CreditosController@getExport");
    Route::post("/admin/creditos/edit", "admin\CreditosController@postEdit");
    Route::post("/admin/creditos/delete", "admin\CreditosController@delete");
    Route::get("/admin/creditos/view/{id}", "admin\CreditosController@view");
    Route::get("/admin/creditos/baja/{id}", "admin\CreditosController@baja");
    Route::get("/admin/creditos/alta/{id}", "admin\CreditosController@alta");
    Route::get("/admin/creditos/ajax/{id}", "admin\CreditosController@getAjax");

    Route::get("/admin/creditos/buscar", "admin\CreditosController@getSearch");
    Route::get("/admin/creditos/seleccion/{id}", "admin\CreditosController@getSeleccion");

    Route::get("/admin/creditos/byAsesor/{id}", "admin\CreditosController@getByAsesor");
    Route::get("/admin/creditos/byAgente/{id}", "admin\CreditosController@getByAgente");

      //  EO : Creditos



    // BO : Pagos

    //Aplicar Pago
    Route::get("/admin/pagos/add", "admin\PagosController@getAdd");
    Route::post("/admin/pagos/add", "admin\PagosController@postAdd");

    //Generar Layout
    Route::get("/admin/pagos/layout", "admin\PagosController@getGenerate");
    Route::post("/admin/pagos/layout", "admin\PagosController@postGenerate");

    //Cancelar Pago
    Route::get("/admin/pagos/cancel", "admin\PagosController@getCancel");
    Route::post("/admin/pagos/cancel", "admin\PagosController@postCancel");

    //Utilerias
    Route::get("/admin/pagos/buscar", "admin\PagosController@getSearch");
    Route::get("/admin/pagos/calendario", "admin\PagosController@getCalendar");

    Route::get("/admin/pagos/captura", "admin\PagosController@getAplicar");
    Route::get("/admin/pagos/traeLayouts/{id}", "admin\PagosController@getActiveLayouts");
    Route::get("/admin/pagos/traeCreditos/{id}", "admin\PagosController@getCreditosLayouts");
    Route::post("/admin/pagos/apply", "admin\PagosController@applyLayout");


    Route::post("/admin/pagos/deleteAll", "admin\PagosController@deleteAll");
    Route::get("/admin/pagos", "admin\PagosController@index");
    Route::get("/admin/pagos/edit/{id}", "admin\PagosController@getEdit");
    Route::get("/admin/pagos/status/{field}/{id}", "admin\PagosController@status");
    Route::get("/admin/pagos/export/{type}", "admin\PagosController@getExport");
    Route::post("/admin/pagos/edit", "admin\PagosController@postEdit");
    Route::post("/admin/pagos/delete", "admin\PagosController@delete");
    Route::get("/admin/pagos/view/{id}", "admin\PagosController@view");
    Route::get("/admin/pagos/baja/{id}", "admin\PagosController@baja");
    Route::get("/admin/pagos/alta/{id}", "admin\PagosController@alta");
    Route::get("/admin/pagos/ajax/{id}", "admin\PagosController@getAjax");
      //  EO : Pagos



    // BO : Asesores
    Route::post("/admin/asesores/deleteAll", "admin\AsesoresController@deleteAll");
    Route::get("/admin/asesores", "admin\AsesoresController@index");
    Route::get("/admin/asesores/add", "admin\AsesoresController@getAdd");
    Route::post("/admin/asesores/add", "admin\AsesoresController@postAdd");
    Route::get("/admin/asesores/edit/{id}", "admin\AsesoresController@getEdit");
    Route::get("/admin/asesores/status/{field}/{id}", "admin\AsesoresController@status");
    Route::get("/admin/asesores/export/{type}", "admin\AsesoresController@getExport");
    Route::post("/admin/asesores/edit", "admin\AsesoresController@postEdit");
    Route::post("/admin/asesores/delete", "admin\AsesoresController@delete");
    Route::get("/admin/asesores/view/{id}", "admin\AsesoresController@view");
    Route::get("/admin/asesores/baja/{id}", "admin\AsesoresController@baja");
    Route::get("/admin/asesores/alta/{id}", "admin\AsesoresController@alta");
    Route::get("/admin/asesores/ajax/{id}", "admin\AsesoresController@getAjax");


    Route::get("/admin/asesores/agentes/{id}", "admin\AsesoresController@getAgentes");
      //  EO : Asesores



    // BO : Creditos_cuotas
    Route::post("/admin/creditos_cuotas/deleteAll", "admin\Creditos_cuotasController@deleteAll");
    Route::get("/admin/creditos_cuotas", "admin\Creditos_cuotasController@index");
    Route::get("/admin/creditos_cuotas/add", "admin\Creditos_cuotasController@getAdd");
    Route::post("/admin/creditos_cuotas/add", "admin\Creditos_cuotasController@postAdd");
    Route::get("/admin/creditos_cuotas/edit/{id}", "admin\Creditos_cuotasController@getEdit");
    Route::get("/admin/creditos_cuotas/status/{field}/{id}", "admin\Creditos_cuotasController@status");
    Route::get("/admin/creditos_cuotas/export/{type}", "admin\Creditos_cuotasController@getExport");
    Route::post("/admin/creditos_cuotas/edit", "admin\Creditos_cuotasController@postEdit");
    Route::post("/admin/creditos_cuotas/delete", "admin\Creditos_cuotasController@delete");
    Route::get("/admin/creditos_cuotas/view/{id}", "admin\Creditos_cuotasController@view");
    Route::get("/admin/creditos_cuotas/baja/{id}", "admin\Creditos_cuotasController@baja");
    Route::get("/admin/creditos_cuotas/alta/{id}", "admin\Creditos_cuotasController@alta");
    Route::get("/admin/creditos_cuotas/ajax/{id}", "admin\Creditos_cuotasController@getAjax");
      //  EO : Creditos_cuotas



    // BO : Productos_montos
    Route::post("/admin/productos_montos/deleteAll", "admin\Productos_montosController@deleteAll");
    Route::get("/admin/productos_montos", "admin\Productos_montosController@index");
    Route::get("/admin/productos_montos/add", "admin\Productos_montosController@getAdd");
    Route::post("/admin/productos_montos/add", "admin\Productos_montosController@postAdd");
    Route::get("/admin/productos_montos/edit/{id}", "admin\Productos_montosController@getEdit");
    Route::get("/admin/productos_montos/status/{field}/{id}", "admin\Productos_montosController@status");
    Route::get("/admin/productos_montos/export/{type}", "admin\Productos_montosController@getExport");
    Route::post("/admin/productos_montos/edit", "admin\Productos_montosController@postEdit");
    Route::post("/admin/productos_montos/delete", "admin\Productos_montosController@delete");
    Route::get("/admin/productos_montos/view/{id}", "admin\Productos_montosController@view");
    Route::get("/admin/productos_montos/baja/{id}", "admin\Productos_montosController@baja");
    Route::get("/admin/productos_montos/alta/{id}", "admin\Productos_montosController@alta");
    Route::get("/admin/productos_montos/ajax/{id}", "admin\Productos_montosController@getAjax");
      //  EO : Productos_montos



    // BO : Productos_pagos
    Route::post("/admin/productos_pagos/deleteAll", "admin\Productos_pagosController@deleteAll");
    Route::get("/admin/productos_pagos", "admin\Productos_pagosController@index");
    Route::get("/admin/productos_pagos/add", "admin\Productos_pagosController@getAdd");
    Route::post("/admin/productos_pagos/add", "admin\Productos_pagosController@postAdd");
    Route::get("/admin/productos_pagos/edit/{id}", "admin\Productos_pagosController@getEdit");
    Route::get("/admin/productos_pagos/status/{field}/{id}", "admin\Productos_pagosController@status");
    Route::get("/admin/productos_pagos/export/{type}", "admin\Productos_pagosController@getExport");
    Route::post("/admin/productos_pagos/edit", "admin\Productos_pagosController@postEdit");
    Route::post("/admin/productos_pagos/delete", "admin\Productos_pagosController@delete");
    Route::get("/admin/productos_pagos/view/{id}", "admin\Productos_pagosController@view");
    Route::get("/admin/productos_pagos/baja/{id}", "admin\Productos_pagosController@baja");
    Route::get("/admin/productos_pagos/alta/{id}", "admin\Productos_pagosController@alta");
    Route::get("/admin/productos_pagos/ajax/{id}", "admin\Productos_pagosController@getAjax");
      //  EO : Productos_pagos


    //Expediente_digital
    Route::get("/admin/expediente_digital", "admin\Expediente_digitalController@index");
    Route::get("/admin/expediente_digital/valida_doc/{id}", "admin\Expediente_digitalController@validaDocumento");

    Route::get("/admin/expediente_digital/valida", "admin\Expediente_digitalController@getValidar");
    Route::get("/admin/expediente_digital/aprobado/{id}", "admin\Expediente_digitalController@postValidar");

    Route::get("/admin/expediente_digital/documentos/{id}", "admin\Expediente_digitalController@documentos");
    Route::post("/admin/expediente_digital/upload_file", "admin\Expediente_digitalController@upload_file");
    Route::get("/admin/expediente_digital/delete_file/{id}", "admin\Expediente_digitalController@delete_file");
    Route::post("/admin/expediente_digital/historial_documento", "admin\Expediente_digitalController@historial_documento");
    Route::get("/admin/expediente_digital/validacion/{id}", "admin\Expediente_digitalController@validacion");
    Route::post("/admin/expediente-digital/rechazo", "admin\Expediente_digitalController@setRechazo");
    Route::post("/admin/expediente_digital/get_reglas", "admin\Expediente_digitalController@get_reglas");
    Route::post("/admin/expediente_digital/validar_expediente", "admin\Expediente_digitalController@validar_expediente");



    							// BO : Solicitudes_expediente
    						  Route::post("/admin/solicitudes_expediente/deleteAll", "admin\Solicitudes_expedienteController@deleteAll");
    						  Route::get("/admin/solicitudes_expediente", "admin\Solicitudes_expedienteController@index");
    							Route::get("/admin/solicitudes_expediente/add", "admin\Solicitudes_expedienteController@getAdd");
    							Route::post("/admin/solicitudes_expediente/add", "admin\Solicitudes_expedienteController@postAdd");
    							Route::get("/admin/solicitudes_expediente/edit/{id}", "admin\Solicitudes_expedienteController@getEdit");
    							Route::get("/admin/solicitudes_expediente/status/{field}/{id}", "admin\Solicitudes_expedienteController@status");
    							Route::get("/admin/solicitudes_expediente/export/{type}", "admin\Solicitudes_expedienteController@getExport");
    							Route::post("/admin/solicitudes_expediente/edit", "admin\Solicitudes_expedienteController@postEdit");
    							Route::post("/admin/solicitudes_expediente/delete", "admin\Solicitudes_expedienteController@delete");
    							Route::get("/admin/solicitudes_expediente/view/{id}", "admin\Solicitudes_expedienteController@view");
    							Route::get("/admin/solicitudes_expediente/baja/{id}", "admin\Solicitudes_expedienteController@baja");
    							Route::get("/admin/solicitudes_expediente/alta/{id}", "admin\Solicitudes_expedienteController@alta");
    							Route::get("/admin/solicitudes_expediente/ajax/{id}", "admin\Solicitudes_expedienteController@getAjax");
    						    //  EO : Solicitudes_expediente



    							// BO : Creditos_pagos
    						  Route::post("/admin/creditos_pagos/deleteAll", "admin\Creditos_pagosController@deleteAll");
    						  Route::get("/admin/creditos_pagos", "admin\Creditos_pagosController@index");
    							Route::get("/admin/creditos_pagos/add", "admin\Creditos_pagosController@getAdd");
    							Route::post("/admin/creditos_pagos/add", "admin\Creditos_pagosController@postAdd");
    							Route::get("/admin/creditos_pagos/edit/{id}", "admin\Creditos_pagosController@getEdit");
    							Route::get("/admin/creditos_pagos/status/{field}/{id}", "admin\Creditos_pagosController@status");
    							Route::get("/admin/creditos_pagos/export/{type}", "admin\Creditos_pagosController@getExport");
    							Route::post("/admin/creditos_pagos/edit", "admin\Creditos_pagosController@postEdit");
    							Route::post("/admin/creditos_pagos/delete", "admin\Creditos_pagosController@delete");
    							Route::get("/admin/creditos_pagos/view/{id}", "admin\Creditos_pagosController@view");
    							Route::get("/admin/creditos_pagos/baja/{id}", "admin\Creditos_pagosController@baja");
    							Route::get("/admin/creditos_pagos/alta/{id}", "admin\Creditos_pagosController@alta");
    							Route::get("/admin/creditos_pagos/ajax/{id}", "admin\Creditos_pagosController@getAjax");
    						    //  EO : Creditos_pagos



    							// BO : Creditos_transacciones
    						  Route::post("/admin/creditos_transacciones/deleteAll", "admin\Creditos_transaccionesController@deleteAll");
    						  Route::get("/admin/creditos_transacciones", "admin\Creditos_transaccionesController@index");
    							Route::get("/admin/creditos_transacciones/add", "admin\Creditos_transaccionesController@getAdd");
    							Route::post("/admin/creditos_transacciones/add", "admin\Creditos_transaccionesController@postAdd");
    							Route::get("/admin/creditos_transacciones/edit/{id}", "admin\Creditos_transaccionesController@getEdit");
    							Route::get("/admin/creditos_transacciones/status/{field}/{id}", "admin\Creditos_transaccionesController@status");
    							Route::get("/admin/creditos_transacciones/export/{type}", "admin\Creditos_transaccionesController@getExport");
    							Route::post("/admin/creditos_transacciones/edit", "admin\Creditos_transaccionesController@postEdit");
    							Route::post("/admin/creditos_transacciones/delete", "admin\Creditos_transaccionesController@delete");
    							Route::get("/admin/creditos_transacciones/view/{id}", "admin\Creditos_transaccionesController@view");
    							Route::get("/admin/creditos_transacciones/baja/{id}", "admin\Creditos_transaccionesController@baja");
    							Route::get("/admin/creditos_transacciones/alta/{id}", "admin\Creditos_transaccionesController@alta");
    							Route::get("/admin/creditos_transacciones/ajax/{id}", "admin\Creditos_transaccionesController@getAjax");
    						    //  EO : Creditos_transacciones



    							// BO : Agentes
    						  Route::post("/admin/agentes/deleteAll", "admin\AgentesController@deleteAll");
    						  Route::get("/admin/agentes", "admin\AgentesController@index");
    							Route::get("/admin/agentes/add", "admin\AgentesController@getAdd");
    							Route::post("/admin/agentes/add", "admin\AgentesController@postAdd");
    							Route::get("/admin/agentes/edit/{id}", "admin\AgentesController@getEdit");
    							Route::get("/admin/agentes/status/{field}/{id}", "admin\AgentesController@status");
    							Route::get("/admin/agentes/export/{type}", "admin\AgentesController@getExport");
    							Route::post("/admin/agentes/edit", "admin\AgentesController@postEdit");
    							Route::post("/admin/agentes/delete", "admin\AgentesController@delete");
    							Route::get("/admin/agentes/view/{id}", "admin\AgentesController@view");
    							Route::get("/admin/agentes/baja/{id}", "admin\AgentesController@baja");
    							Route::get("/admin/agentes/alta/{id}", "admin\AgentesController@alta");
    							Route::get("/admin/agentes/ajax/{id}", "admin\AgentesController@getAjax");
    						    //  EO : Agentes

    						   // @@@@@#####@@@@@
                   Route::get('admin/manual', 'HomeController@ManualIndex');
                   Route::get('admin/parametros', 'HomeController@parametros');
                   Route::post('admin/parametros/save', 'HomeController@parametrosave');

                   //RUTAS DE LA CONFIGURACION ROLES Y PERMISOS
                   Route::resource('roles','permissions\RoleController');
                   Route::resource('user','permissions\UserController');
                   Route::resource('permissions', 'permissions\PermissionController');



});





//Home
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@home');
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
