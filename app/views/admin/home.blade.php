@extends('layouts.admin')

@section('content')
<header>
    <h1>Panneau d'administration</h1>
</header>
<article class="article panel" id="pan_admin">
    <div>
        Ici c'est le pabbeau d'administration, va falloir attendre avant de voir arriver ici les prochaines fonctionnalités :

        <ul>
            <li>/login => taille btn et présentation</li>
            <li>Menu générique de gauche</li>
            <li>fonts => articles</li>
            <li>404 page / missing méthode</li>
            <li>Punaise sur les images des articles</li>
            <li>Queue
                <ul>
                    <li> Finder: http://symfony.com/doc/current/components/finder.html</li>
                    <li>Supprimer les images non utilisées</li>
                </ul>
            </li>
            <li>Images non récupérable depuis d'autre sites</li>
            <li>BDD => dernière utilisation de l'image</li>
            <li>Images de travers sur iphone</li>
            <li>Askimet</li>
            <li>Articles -> MAJ date publication</li>
            <!--<li></li>-->
            <!--<li></li>-->
            <!--<li></li>-->
            <!--<li></li>-->
        </ul>
    </div>
</article>
@stop

@section('footer')
@stop