@extends('layouts.admin')

@section('content')
<section  id="ad_article_edit" class="clearfix grid flex">
    <header class="bordure">
        <h1>Edition d'un article</h1>
    </header>
    @if(isset($article))
    {{ Form::open(array('action' => array('article@update', $article->article_id),'class' =>'clearfix ' , 'id' => 'form-article-edit', 'method' => 'put'));
    $c = true;}}
    {{ Form::hidden('id', $article->article_id, array('id'=>'article_id'))}}
    @else
    {{ Form::open(array('action' => array('article@store'),'class' =>'clearfix ' , 'id' => 'form-article-edit', 'method' => 'post'));
    $c = false;}}
    @endif
    <fieldset id="fleft" class="col_9">
        <legend>Contenu</legend>
        <p>
            {{ Form::label('titre', 'Titre de l\'article :')}} 
            {{ Form::submit('Enregistrer les modifications', array('class' => 'green small'))}} 
            {{ Form::text('titre',($c) ? $article->titre : '', array('class'=>'large', 'placeholder' => 'Le titre de l\'article'))}}
        </p>
        <p>
            {{ Form::label('texte', 'Contenu : ')}}
            {{ Form::textarea('texte', ($c) ? $article->texte : '', array('placeholder' => 'Ecrivez votre article ici.'))}}
        </p>
        <p>
            {{ Form::label('resume', 'Résumé : ')}}
            <span class="fright">{{ Form::label('idem', 'Pas de résumé  : ', array('class' => 'right'))}}
                {{ Form::checkbox('idem')}}</span>
            {{ Form::textarea('resume', ($c) ? $article->resume : 'texte', array('placeholder' => 'Un cours résumé de l\'article (visible sur la page principale)',
                        'rows' => 3))}}
        </p>
    </fieldset>
    <fieldset id="fright" class="col_3">
        <legend>Métadonnées</legend>
        <p>
            <button id="ajouter_options" class="yellow small fright">Options</button>

            {{ Form::label('article_view', 'N° de l\'article / version : ')}}
            @if($c)
            {{ Form::text('article_view', $article->article_id.' / '.$article->version_id, array('disabled' => 'disabled'))}}
            {{ Form::hidden('article', $article->article_id.' / '.$article->version_id)}}
            @else
            {{ Form::text('article_view', 'Indéterminé / 1', array('disabled' => 'disabled'))}}
            {{ Form::hidden('article', '0 / 1')}}
            @endif            
        </p>
        <p>
            {{ Form::label('date', 'Date : ')}}
            {{ Form::text('date', date('d/m/Y H:i:s', (($c) ? $article->date : time())), array('disabled' => 'disabled'))}}
        </p>
        <p>
            {{ Form::label('etat', 'Etat : ')}}
            {{ Form::select('etat', Config::get('enum.article_etat'),($c) ? $article->etat : 1)}}
        </p>
        <p>
            {{ Form::label('auteur', 'Auteur : ')}}
            {{ Form::select('auteur_id', $editeurs,($c) ? $article->idUser : Auth::user()->getAuthIdentifier())}}
        </p>
        <p>
            {{ Form::label('tags', 'Tags : ')}}
            {{ Form::text('tags', ($c) ? $article->tags : '', array('placeholder' => 'Les tags de l\'article.'))}}
        </p>
        <p>
            {{ Form::label('article_parent', 'Article parent : ')}}
            {{ Form::text('parent_id', ($c) ? $article->parent_id : '')}}
        </p>
    </fieldset>
    {{Form::close()}}
    <fieldset class="col_12">
        <legend>Images liées à l'article</legend>
        @if($c)
        <div id="assetConteneur" class="clearfix"></div>
        {{Form::file('asset', array('id' => 'realFile', 'class' => 'realFile', 'name' => 'asset', 'data-url'=>route('download_asset')))}}
        <button class="fakeFile small">Ajouter un fichier</button>
        <button class="small" disabled="disable">Ajouter une image déjà sur le site</button>
        <div id="warnings">

        </div>
        @else
        <p>Enregistrez l'article une première fois afin de pouvoir ajouter des images !</p>
        @endif
    </fieldset>
    <fieldset class="col_12">
        <legend>Historique</legend>
        @if(isset($versions))
        <?php $nb = strlen($versions[0]->texte); ?>
        @foreach($versions as $version)
        <p><a>Version : {{$version->version_id}} - date : {{date('d/m/Y H:i:s', $version->date)}} {{strlen($version->texte) - $nb}}</a></p>
        @endforeach
        @else
        <p>Aucun historique.</p>
        @endif
    </fieldset>
</section>
<img id="target"/>
<section id="popup">
    <section class="container">
        <a id="p-remove" href="#close"  class="icon-remove-sign icon-large fright"> Fermer</a>
        <aside class="fleft">
            <ul>
                @foreach(Config::get('enum.type_meta') as $meta)
                @if (is_array($meta))
                @if (isset($meta['show']) && !$meta['show'])

                @continue

                @else
                <li>{{$meta['nom']}}</li>
                @endif
                @else
                <li>{{$meta}}</li>
                @endif
                @endforeach
            </ul>
        </aside>
        <article class="fright">
            <header>Titre</header>
        </article>
    </section>
</section>
@stop

@section('footer')
{{HTML::script('jquery-file-upload/vendor/jquery.ui.widget.js')}}
{{HTML::script('jquery-file-upload/jquery.fileupload.js')}}
{{HTML::script('jquery-file-upload/jquery.iframe-transport.js')}}
<script type="text/javascript">
    // Gestion du résumé et de la checkbox attenante
    {
        resume = $('#resume');
        idem = $('#idem');
        if (resume.html() === 'texte') {
            resume.prop('disabled', true).html('');
            idem.prop('checked', true);
        }
        idem.click(function() {
            resume.prop('disabled', idem.is(':checked'))
            resume.focus();
        });
        resume.focusout(function() {
            if (resume.val() === '') {
                resume.prop('disabled', true).html('');
                idem.prop('checked', true);
            }
        });
    }

    // Gestion du file input
    @if($c)
    {
        var compteur = 0;
        $('.fakeFile').click(function() {
            $('#realFile').click()
        })
        $('#realFile').fileupload({
            forceIframeTransport: true,
            dataType: 'json',
            acceptFileTypes: '/(\.|\/)(gif|jpe?g|png)$/i',
            formData: function() {
                return [{
                        name: "compteur",
                        value: compteur
                    }, {
                        name: "article_id",
                        value: $('#article_id').val()
                    }];
            },
            add: function(e, data) {
                console.log(data);
                var nom = data.files[0].name;
                var taille = data.files[0].size;
                if (taille > 8388608) {
                    $('#warnings').append('<p  class="notice error"><i class="icon-remove-sign icon-large"></i>Le fichier ' + nom + ' (' + tailleToString(taille) + ' ) est trop volumineux (8Mo maximum)<a href="#close" class="icon-remove"></a></p>');
                } else {
                    compteur++;
                    $('#warnings').append('<p id="notice_' + compteur + '" name="' + nom + '" class="notice warning"><i class="icon-download-alt icon-large"></i>Téléchargement du fichier ' + nom + ' (' + tailleToString(taille) + ') en cours...</p>');
                    data.submit();
                }
            }
            ,
            done: function(e, data) {
                console.log(data);
                r = data.result;
                if (r.resultat) {
                    $('#notice_' + r.id_span).replaceWith('<p id="notice_' + r.id_span + '" name="' + r.nom + '" class="notice success"><i class="icon-download-alt icon-large"></i>Téléchargement du fichier ' + r.nom + ' (' + tailleToString(r.taille) + ') terminé !<a href="#close" class="icon-remove"></a></p>');
                    addMiniature(r);
                } else {
                    $('#asset_' + r.id_span).replaceWith('<p  id="notice_' + r.id_span + '" name="' + r.nom + '" class="notice error"><i class="icon-remove-sign icon-large"></i>Le fichier ' + r.nom + ' (' + tailleToString(r.taille) + ' ) n\'a pas pu être téléchargé pour la raison suivante : <em>' + r.raison + '</em><a href="#close" class="icon-remove"></a></p>');
                }
            },
            fail: function(e, data) {
                console.log(data);
                console.log("Failed");
                // $('#asset_' + data.result.id).replaceWith('<p  id="notice_' + data.result.id + '" name="' + data.result.nom + '" class="notice error"><i class="icon-remove-sign icon-large"></i>Le fichier ' + data.result.nom + ' (' + tailleToString(data.result.taille) + ' ) n\'a pas pu être téléchargé pour la raison suivante : <em>' + data.result.raison + '</em><a href="#close" class="icon-remove"></a></p>');

            }
        });
        function tailleToString(taille) {
            var u = 'o';
            while (taille > 1024) {
                switch (u) {
                    case 'o':
                        u = 'Ko';
                        break;
                    case 'Ko':
                        u = 'Mo';
                        break;
                }
                taille = (taille / 1024).toFixed(2);
            }
            return taille + ' ' + u;
        }

        function addMiniature(r) {
            $('#assetConteneur').append('<div id="asset_' + r.id_meta + '" title="' + r.nom + '" class="minImg fleft"><p><em>' + r.nom + '</em></p><img src="' + r.url + '"/><p><em>[' + r.id_meta + ']</em></p><a href="#close" id="close_' + r.id_meta + '" class="icon-remove-circle" title="Détacher cette image de l\'article"></a></div>');
        }

        @if(sizeof($assets) > 0)
        @foreach ($assets as $asset)
                addMiniature({
                    id_meta: '{{$asset->id_meta}}',
                    nom: '{{$asset->nom}}',
                    url: '{{asset(($asset->url_miniature=="")?$asset->url:$asset->url_miniature)}}'
                });
        @endforeach
        @endif

        $('#assetConteneur').on('click', '.minImg a', function() {
            console.log($(this).prop('id').replace('close_', ''));
            $.ajax({
                url: "{{route('detache_asset')}}",
                method: 'post',
                data: {
                    id: $(this).prop('id').replace('close_', '')
                },
            }).success(function(data) {
                if (data.resultat)
                {
                    $('#asset_' + data.id).remove();
                }
            });
        });
    }
    @endif

    // Gestion des options
    {
        $
        f_resize = function() {
            $('#popup .container').css('top', ($(window).height() - $('#popup .container').height()) / 2);
        };
        $('#ajouter_options').click(function(event) {
            event.preventDefault();
            $('#popup').show();
            f_resize();
            $(window).on('resize', f_resize);
            $('#p-remove').click(function() {
                $('#popup').hide();
                $(window).off('resize', f_resize);
            })
        });
//        $( "#ajouter_options" ).trigger( "click" );
    }
</script>
@stop