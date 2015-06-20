<?php

Route::get('/', function()
{
	return View::make('hello');
});

Route::get('alertas', 'AlertasController@getList');
Route::get('alertas/create', 'AlertasController@getCreate');
Route::post('alertas/store', 'AlertasController@postStore');
Route::get('alertas/edit/{id}', 'AlertasController@getEdit');
Route::put('alertas/update/{id}', 'AlertasController@putUpdate');
Route::delete('alertas/destroy/{id}', 'AlertasController@deleteDestroy');

Route::get('personas', 'PersonasController@getList');
Route::get('personas/create', 'PersonasController@getCreate');
Route::post('personas/store', 'PersonasController@postStore');
Route::get('personas/edit/{id}', 'PersonasController@getEdit');
Route::delete('personas/destroy/{id}', 'AlertasController@deleteDestroy');



Route::get('nueva_alerta', function()
{
	return View::make('alerta/nueva_alerta');
});

Route::get('ingreso', function()
{
	return View::make('alerta/ingreso');
});

Route::get('registro', function()
{
	return View::make('alerta/registro');
});

Route::get('opciones', function()
{
	return View::make('alerta/opciones');
});

Route::get('nueva_experiencia', function()
{
	return View::make('alerta/nueva_experiencia');
});

Route::get('experiencias', function()
{
	return View::make('alerta/experiencias');
});