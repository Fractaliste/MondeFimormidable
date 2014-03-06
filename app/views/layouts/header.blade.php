<div id="h-titre">
    <h1>
        {{HTML::linkRoute('home', 'Un monde FimOrmidable')}}
    </h1>
</div>	
<div id="h-navbar">
    <ul class="menu">
        <li><a href="{{route('home')}}"><i class="icon-home"></i> Accueil</a></li>
        <li><a href="{{route('galerie')}}"><i class="icon-camera"></i> Créations</a></li>
        <li class="tooltip" title="Non disponible pour le moment"><a>Qui-suis je <i class="icon-question-sign"></i></a></li>
        <li class="fright"><a href="{{action('contact@index')}}">Contact / Commandes <i class="icon-envelope"></i></a></li>
        <!--li><a></a></li-->
    </ul>
    <!--a href="{{action('contact@index')}}">
        {{HTML::image('images/contact.png', 'contact', 
        array('id' => 'h-contact', 'class' => 'img-rounded'))}}</a-->
</div>