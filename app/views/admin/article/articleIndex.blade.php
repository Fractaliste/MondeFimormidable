@extends('layouts.admin')

@section('content')
<header>
    <h1>Liste des articles</h1>
</header>
<article class="article panel" id="ad_article_index">
    {{Form::open(array('action' => 'article@create', 'method' => 'get'))}}
    <button type="submit" class="green small">Nouvel article <i class="icon-plus-sign"/></i></button>
    {{Form::close()}}
    <table class="striped sortable">
        <thead>
            <tr>
                <th>N°</th>
                <th>Titre</th>
                <th>Date</th>
                <th>Tags</th>
                <th>Etat</th>
                <th>Auteur</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($articles as $row) 
            <tr>
                <td><div title="{{$row->article_id}}">{{$row->article_id}}</div></td>
                <td><div title="{{$row->titre}}">{{$row->titre}}</div></td>
                <td><div title="{{$row->date}}">{{date("d/m/Y H:i:s", $row->date)}}</div></td>
                <td><div title="{{$row->tags}}">{{$row->tags}}</div></td>
                <td><div title="{{$row->etat}}">{{Config::get('enum.article_etat.'.$row->etat)}}</div></td>
                <td><div title="{{$row->username}}">{{$row->username}}</div></td>
                <td>
                    {{Form::open(array( 'action' => array('article@edit', $row->article_id), 'method' => 'get'))}}<button type = "submit" class = "small"><span class = "icon-pencil"></span></button>{{Form::close()}}
                    {{Form::open(array( 'action' => array('article@show', $row->article_id), 'method' => 'get'))}}<button type = "submit" class = "small"><span class = "icon-eye-open"></span></button>{{Form::close()}}
                    {{Form::open(array( 'action' => array('article@destroy', $row->article_id), 'method' => 'delete'))}}<button type = "submit" class = "small"><span class = "icon-ban-circle"></span></button>{{Form::close()}}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <em class="right">Il y a {{$supprimes}} articles dans la corbeille. <a id="afficher_article_supprime" href="#">Les afficher.</a></em>
</article>
<aside></aside>
@stop

@section('footer')
<script type="text/javascript">
    $('#afficher_article_supprime').click(function(e) {
        e.preventDefault();
        $.ajax({
            type: "GET",
            url: "{{action('article@index')}}",
            dataType: "json "
        }).success(function(data) {
            t = "";
            for (raws in data) {
                t += '<tr>';
                t += '<td><div>' + data[raws].article_id + '</div></td>';
                t += '<td><div>' + data[raws].titre + '</div></td>';
                d = new Date();
                d.setTime(parseInt(data[raws].date) * 1000);
                t += '<td><div>' + d.toLocaleString() + '</div></td>';
                t += '<td><div>' + data[raws].tags + '</div></td>';
                t += '<td><div>{{Config::get('enum.article_etat.98')}}</div></td>';
                t += '<td><div>' + data[raws].username + '</div></td>';
                t += '<td><div>' + getBouttons(data[raws].article_id) + '</div></td></tr>';
            }
            $('tbody').append(t);
            $('#afficher_article_supprime').parent().hide();
        });
    })

    function getBouttons(id) {
        return '<form method="GET" action="http://test.famillenourrit.net/laravel/public/tagada/article/' + id + '/edit" accept-charset="UTF-8"><button type="submit" class="small"><span class="icon-pencil"></span></button></form>' +
                '<form method="GET" action="http://test.famillenourrit.net/laravel/public/tagada/article/' + id + '" accept-charset="UTF-8"><button type="submit" class="small"><span class="icon-eye-open"></span></button></form>'
    }
</script>
@stop