@extends('layouts.master')

@section('nav')
<ul class="breadcrumbs">
    <li><a href="{{route('home')}}">Accueil</a></li>
    <li><a href="{{route('galerie')}}">Galerie</a></li>
</ul>
@stop

@section('content')
<header><h1>Galerie photo</h1></header>
<aside>
    <h2>Accéder au photos par :</h2>
    <ul class="button-bar">
        <li>Mois</li>
        <li>Catégorie</li>
        <li>Tag</li>
        <li>Nom</li>
    </ul>
    <article id="g-mois">

    </article>
    <article id="g-categorie"></article>
    <article id="g-tag"></article>
    <article id="g-nom"></article>
</aside>
<article>
    <div>Précédent</div>
    <div><img src=""/></div>
    <div>Suivant</div>
</article>
@stop

@section('footer')
// Charger suivant / précédent
@stop