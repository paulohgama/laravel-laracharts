<?php

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

Route::get('/', 'GraficosController@index');
Route::group(['prefix' => 'grafico'], function () {
    Route::get('/area', 'GraficosController@graficoArea')->name('grafico.area');
    Route::get('/barra', 'GraficosController@graficoBarra')->name('grafico.barra');
    Route::get('/calendario', 'GraficosController@graficoCalendario')->name('grafico.calendario');
    Route::get('/coluna', 'GraficosController@graficoColuna')->name('grafico.coluna');
    Route::get('/combo', 'GraficosController@graficoCombo')->name('grafico.combo');
    Route::get('/donut', 'GraficosController@graficoDonut')->name('grafico.donut');
    Route::get('/gauge', 'GraficosController@graficoGauge')->name('grafico.gauge');
    Route::get('/geo', 'GraficosController@graficoGeo')->name('grafico.geo');
    Route::get('/pizza', 'GraficosController@graficoPizza')->name('grafico.pizza');
    Route::get('/linha', 'GraficosController@graficoLinha')->name('grafico.linha');
    Route::get('/scatter', 'GraficosController@graficoScatter')->name('grafico.scatter');
});

Route::group(['prefix' => 'operatrix'], function () {
    Route::get('/geral', 'OportunidadeController@geral')->name('operatrix.geral');
    Route::get('/performance', 'OportunidadeController@performance')->name('operatrix.performance');
    Route::get('/vendas', 'OportunidadeController@vendas')->name('operatrix.vendas');
});
