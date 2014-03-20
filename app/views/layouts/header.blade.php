<div id="titre">
    <h1>
        {{HTML::linkRoute('home', 'Un monde FimOrmidable')}}
    </h1>
</div>	
<div id="navbar">
    <div class="ui menu">
        <a href="{{route('home')}}" class="item"><i class="large home basic icon"></i><span class="nav-text"> Accueil</span></a>
        <a href="{{route('galerie')}}" class="item"><i class="large camera retro icon"></i><span class="nav-text"> Créations</span></a>
        <a class="item"><span class="nav-text">Qui-suis je </span><i class="large help basic icon"></i></a>
        <div class="right menu">
            <a href="{{action('contact@index')}}" class="item"><span id="nav-contact">Contact / Commandes </span><i class="large mail basic icon"></i></a>
        </div>
    </div>
</div>