<?php

Route::get('/', function()
{
	return View::make('hello');
});


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