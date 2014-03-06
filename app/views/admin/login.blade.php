@extends('layouts.master')

@section('content')
<header>
    <h1>Connexion à l'administration du site</h1>
</header>
<article class="article panel" id="article-16">
    <div>
        {{ Form::open(array('url' => 'login', 'id' => 'form-login'))}}
        {{ Form::label('username', 'Nom d\'utilisateur : ');}}{{ Form::text('username')}}
        {{ Form::label('password', 'Mot de passe : ')}}{{Form::password('password')}}
        {{ Form::submit('Valider')}}
        {{ Form::close();}}
    </div>
</article>
@stop

@section('footer')
@stop