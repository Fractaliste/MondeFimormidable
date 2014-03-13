@extends('layouts.master')

@section('nav')
<div class="ui breadcrumb">
    <a class="item section" href="{{route('home')}}">Accueil</a>
    <i class="right arrow icon divider"></i>
    <a class="active section">Contact</a>
</div>
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
<div class="ui inverted divider"></div>
<article class="ui small form segment" id="form-contact">
    <h3>Formulaire de contact</h3>
    {{ Form::open(array('url' => 'contact'));}}
    <div class="two fields">
        <p class="field">{{ Form::label('nom', 'Votre nom : ');}}
            {{ Form::text('nom');}}<em>(30 caractères maximum)</em></p>
        <p class="field">{{ Form::label('email', 'Votre email : ');}}
            {{ Form::email('email');}}<em>(entrez une adresse mail valide)</em></p>
    </div>
    <div class="two fields">
        <p class="field">{{ Form::label('telephone', 'Votre tel : ');}}
            {{ Form::text('telephone', '', array( 'placeholder' => 'Champ optionnel'));}}
            <em>(numéro à 10 chiffres commençant par 0)</em></p>
        <div class="field">{{ Form::label('motif', 'Motif : ');}}
            <div class="ui fluid selection dropdown">
                <input type="hidden" id="motif" name="motif">
                <div class="text">Motif</div>
                <i class="dropdown icon"></i>
                <div class="menu">
                    @foreach(Config::get('enum.motif_contact') as $key=>$motif)
                    @if($key == 99)
                    <div class="item active" id="{{$key}}" data-value="{{$key}}">{{$motif}}</div>
                    @else
                    <div class="item" id="{{$key}}" data-value="{{$key}}">{{$motif}}</div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <p class="field">{{ Form::label('texte', 'Message : ');}}{{ Form::textarea('texte');}}</p>
    {{ Form::submit('Envoyer !', array('id' => 'submit-contact', 'class' => 'ui green submit button'));}}
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
    });
    $('#form-contact .field em').hide();
    $('.ui.selection.dropdown').dropdown();
</script>
@stop