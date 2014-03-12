@extends('layouts.master')

@section('nav')
<div class="ui breadcrumb">
    <a class="item section" href="{{route('home')}}">Accueil</a>
    <i class="right arrow icon divider"></i>
    <a class="active section">Erreur 404</a>
</div>
@stop

@section('content')
<h1>Erreur 404 !</h1>
<p>La page que vous avez essayé d'afficher n'existe pas ou plus.</p>
<p>Si vous pensez que l'absence de la page <strong>{{Request::path()}}</strong> est injustifié (bug ou autre), je vous invite à m'en informer via <a href="{{action('contact@index')}}"/>le formulaire de contact.</a></p>
@stop

@section('footer')
@stop