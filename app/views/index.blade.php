@extends('layouts.master')

@section('nav')
<ul class="breadcrumbs">
    <li><a href="{{route('home')}}">Accueil</a></li>
    @if(isset($nav))
    @foreach($nav as $k => $n)
    @if($k == 'annee')
    <li><a href="{{action('navigation@'.$k, $n)}}">{{$n}}</a></li>
    @elseif ($k == 'mois')
    <li><a href="{{action('navigation@'.$k, array('annee' => $nav['annee'], 'mois' => $n))}}">{{$n}}</a></li>
    @elseif(true)

    @endif
    @endforeach
    @endif
</ul>
@stop

@section('content')
@foreach ($articles as $article)
@include('article')
@endforeach
@stop

@section('footer')
@stop