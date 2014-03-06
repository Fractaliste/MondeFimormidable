<li>Liens</li>
<ul>
    <li>
        <a href="http://www.alittlemarket.com/boutique/un_monde_fimormidable-929863.html"  title="Ma boutique sur A Little Market">Ma boutique</a>
        {{imageTag('alm.png')}}
    </li>
</ul>

<?php $c = false; ?>
<li><a href="{{action('navigation@historique')}}">Historique</a></li>
@foreach (DB::table('articles')->select(DB::raw('strftime("%Y", articles.date,  "unixepoch", "localtime") as annee'),DB::raw('strftime("%m", articles.date,  "unixepoch", "localtime") as mois'))->where('etat', '>=', '20')->where('etat', '<', '30')->groupby('annee')->groupby('mois')->orderby('annee', 'DESC')->orderby('mois', 'DESC')->limit(4)->get() as $temp )
@if(!$c)
<ul><li><a href="{{action('navigation@annee',$temp->annee)}}">Tout {{$temp->annee; $c = $temp->annee}}</a></li><ul>
        @elseif ($c != $temp->annee)
    </ul><li><a href="{{action('navigation@annee', $temp->annee)}}">Tout {{$temp->annee; $c = $temp->annee}}</a></li><ul>
        @endif
        <li><a href="{{action('navigation@mois', array($temp->annee, $temp->mois))}}">{{ucfirst(Config::get('enum.date.'.$temp->mois)).' '.$temp->annee}}</a></li>
        @endforeach
        <li><em><a href="{{action('navigation@historique')}}">Afficher la suite...</a></em></li>
    </ul>
</ul>

<!--<li>Statistiques</li>
<ul>
    <li>3 articles disponibles</li>
    <li><em>Suite à venir...</em></li>
</ul>-->