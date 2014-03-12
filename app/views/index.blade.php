@extends('layouts.master')

@section('nav')
<div class="ui breadcrumb">
    <a class="item section" href="{{route('home')}}">Accueil</a>
    <i class="right arrow icon divider"></i>
    @if(isset($nav))
    @foreach($nav as $k => $n)
    @if($k == 'annee')
    @if(array_key_exists('mois', $nav))
    <a class="section" href="{{action('navigation@'.$k, $n)}}">{{$n}}</a>
    @else
    <a class="active section" href="{{action('navigation@'.$k, $n)}}">{{$n}}</a>
    @endif
    @elseif ($k == 'mois')
    <i class="right arrow icon divider"></i>
    <a class="active section" href="{{action('navigation@'.$k, array('annee' => $nav['annee'], 'mois' => $n))}}">{{$n}}</a>
    @elseif(true)

    @endif
    @endforeach
    @endif
</div>
@stop

@section('content')
@foreach ($articles as $article)
@include('article')
@endforeach
@stop

@section('footer')
@stop