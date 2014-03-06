<?php

class home extends \BaseController {

    public function home() {
        $articles = DB::table('articles')->where('etat', '>=', '20')->where('etat', '<', '30')->orderBy('date', 'DESC')->get();
        foreach ($articles as $article) {
            article::formater($article);
        }
        return View::make('index', array('articles' => $articles));
    }

    public function popup() {
        return View::make('popup');
    }

    public function missingMethod($parameters = array()) {
        return Redirect::route('home');
    }

}
