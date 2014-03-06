<ul class="menu"><li><a href="{{route('admin')}}">PDCA</a></li>
    <li><a href="{{action('article@index')}}">Articles</a></li>
    <li><a href="{{action('bdd@index')}}">BDD</a></li>
    <li class="fright">{{HTML::linkRoute('logout','Se déconnecter', array('class' => 'fright'))}}</li>
</ul>