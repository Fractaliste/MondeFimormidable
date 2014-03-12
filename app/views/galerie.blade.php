@extends('layouts.master')

@section('nav')
<div class="ui breadcrumb">
    <a class="item section" href="{{route('home')}}">Accueil</a>
    <i class="right arrow icon divider"></i>
    <a class="active section" href="{{route('galerie')}}">Galerie</a>
</div>
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