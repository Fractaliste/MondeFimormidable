<header>
    <h1><a href="{{action('article@show', $article->article_id)}}">{{$article->titre}}</a></h1>
</header>

<article class="" id="article-{{$article->article_id}}">
    {{$article->texte}}
</article>
<footer>
    <p class="right"><em>Le {{date('d/m/Y à H\h i', $article->date)}}</em></p>
</footer>