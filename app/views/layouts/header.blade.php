<div id="titre">
    <h1>
        {{HTML::linkRoute('home', 'Un monde FimOrmidable')}}
    </h1>
</div>	
<div id="navbar">
    <div class="ui menu">
        <a href="{{route('home')}}" class="item"><i class="large home basic icon"></i> Accueil</a>
        <a href="{{route('galerie')}}" class="item"><i class="large camera retro icon"></i> Créations</a>
        <a class="item">Qui-suis je <i class="large help basic icon"></i></a>
        <div class="right menu">
            <a href="{{action('contact@index')}}" class="item">Contact / Commandes <i class="large mail basic icon"></i></a>
        </div>
    </div>
</div>