<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


Route::group(array('prefix' => 'tagada', 'before' => 'login'), function() {

    Route::any('/', array('as' => 'admin', function() {
    return View::make('admin/home');
}));
    Route::resource('bdd', 'bdd');
    Route::resource('article', 'article');
    Route::get('article/{id}/v/{v}', array('uses' => 'article@show'));

    Route::post('downloadAsset', array('as' => 'download_asset', 'uses' => 'asset@add'));
    Route::post('detacheAsset', array('as' => 'detache_asset', 'uses' => 'asset@detache'));
    Route::get('imgTest', array('uses' => 'asset@fire'));
});

Route::post('queue', function() {
    return Queue::marshal();
});
