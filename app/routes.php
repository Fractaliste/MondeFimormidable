<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the Closure to execute when that URI is requested.
  |
 */

Route::any('/', array('as' => 'home', 'uses' => 'home@home'));

Route::get('home', array('uses' => 'home@home'));

Route::get('index', array('uses' => 'home@home'));

Route::get('popup', array('as' => 'popup', 'uses' => 'home@popup'));

Route::resource('contact', 'contact');

// Navigation

Route::get('date/{year}', array('uses' => 'navigation@annee'))->where('year', '20[\d]{2}');
Route::get('date/{year}/{mois}', array('uses' => 'navigation@mois'))->where('year', '20[\d]{2}')->where('mois', '[\d]{2}');
Route::get('historique', array('uses'=> 'navigation@historique'));
Route::get('article/{id}', array('uses' => 'article@show'));

// Galerie
Route::get('galerie', array('uses' => 'asset@galerie', 'as' => 'galerie'));

/* Login / logout */
Route::get('login', array('as' => 'login', 'uses' => 'login@getLogin'));

Route::post('login', array('before' => 'csrf', 'uses' => 'login@postLogin'));

Route::get('logout', array('as' => 'logout', 'uses' => 'login@getLogout'));

/* Routes du panneau d'administration */
include 'routesAdmin.php';

/* Missing méthode */
App::missing(function() {
    return Response::view('404', array(), 404);
});
