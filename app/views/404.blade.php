@extends('layouts.master')

@section('nav')
<ul class="breadcrumbs">
    <li><a href="{{route('home')}}">Accueil</a></li>
    <li><a href="#">404</a></li>
</ul>
@stop

@section('content')
<h1>Erreur 404 !</h1>
<p>La page que vous avez essayé d'afficher n'existe pas ou plus.</p>
<p>Si vous pensez que l'absence de la page <strong>{{Request::path()}}</strong> est injustifié (bug ou autre), je vous invite à m'en informer via <a href="{{action('contact@index')}}"/>le formulaire de contact.</a></p>
@stop

@section('footer')
@stop