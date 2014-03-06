@extends('layouts.master')

@section('nav')
<ul class="breadcrumbs">
    <li><a href="{{route('home')}}">Accueil</a></li>
    <li><a href="{{action('contact@index')}}">Contact</a></li>
</ul>
@stop

@section('content')
<header>
    <h1><a href="contact">Contacter Amandine !</a></h1>
</header>

<article @if(Session::has('envoi_contact')) style="display:none;" @endif>
          <p>Vous souhaitez me contacter ? N'hésitez pas à le faire ici !</p>
    <p>Si vous avez une demande pour une création spécifique, un projet, un événement à organiser, 
        une décoration à changer, un cadeau à trouver, ou tout simplement l'envie
        d'une petite folie, <strong>j'accepte de réaliser des pièces sur-mesure</strong>, mais pas de reproductions d'autres créateurs.</p>
    <p>Bien entendu je me garde le droit de refuser n'importe quelle commande 
        si je suis en manque de temps. Donc <strong>ne vous y prenez pas au 
            dernier moment</strong> pour prendre contact, surtout s'il y a besoin de quantité !</p>
    <p>Vous pouvez aussi me contacter pour m'encourager, me faire passer des 
        suggestions, ça me fait toujours très plaisir de recevoir du courrier 
        plutôt que des factures donc n'hésitez surtout pas à me dire ce qui vous 
        passe par la tête ! Un simple merci suffit généralement à ensoleiller ma journée.</p>
</article>
@if(Session::has('envoi_contact'))
<article>
    @if(Session::get('envoi_contact') == "nok")
    <p class="notice error"><i class="icon-remove-sign icon-large"></i>Erreur lors du remplissage du formulaire</p>
    <ul>
        @foreach ($errors->all() as $message)
        <li>{{$message}}</li>
        @endforeach
    </ul>
    @else
    <p class="notice success"><i class="icon-ok icon-large"></i>Votre message a bien été envoyé</p>
    <p>Vous allez recevoir une copie du mail à l'adresse que 
        vous avez renseigné. Si jamais vous ne le recevez pas vérifiez que vous avez bien entré la bonne adresse mail !</p>
    @endif
</article>
@endif
<hr class='alt1'/>
<article>
    <h3>Formulaire de contact</h3>
    {{ Form::open(array('url' => 'contact', 'id' => 'form-contact'));}}
    <p>{{ Form::label('nom', 'Votre nom : ');}}
        {{ Form::text('nom');}}<em>(30 caractères maximum)</em></p>
    <p>{{ Form::label('email', 'Votre email : ');}}
        {{ Form::email('email');}}<em>(entrez une adresse mail valide)</em></p>
    <p>{{ Form::label('telephone', 'Votre tel : ');}}
        {{ Form::text('telephone', '', array( 'placeholder' => 'Champ optionnel'));}}
        <em>(numéro à 10 chiffres commençant par 0)</em></p>
    <p>{{ Form::label('motif', 'Motif : ');}}
        {{ Form::select('motif', Config::get('enum.motif_contact'), 99);}}</p>
    <p>{{ Form::label('texte', 'Message : ');}}{{ Form::textarea('texte');}}</p>
    <p>{{ Form::submit('Envoyer !', array('id' => 'submit-contact'));}}</p>
    {{ Form::close();}}
</article>
@stop

@section('footer')
<script type="text/javascript">
    $('#form-contact input').focus(function() {
        $(this).parent().children('em').show();
        $(this).blur(function() {
            $(this).parent().children('em').hide();
        });
    });</script>
@stop