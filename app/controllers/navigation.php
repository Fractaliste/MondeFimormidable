<?php

class navigation extends \BaseController {

    public function annee($annee) {
        $articles = DB::table('articles')->where('etat', '>=', '20')->where('etat', '<', '30')
                        ->where(DB::raw('strftime("%Y", articles.date,  "unixepoch", "localtime") '), $annee)
                        ->orderBy('date', 'DESC')->get();
        foreach ($articles as $article) {
            article::formater($article);
        }
        return View::make('index', array('articles' => $articles, 'nav' => array('annee' => $annee)));
    }

    public function mois($annee, $mois) {
        $articles = DB::table('articles')->where('etat', '>=', '20')->where('etat', '<', '30')
                        ->where(DB::raw('strftime("%Y", articles.date,  "unixepoch", "localtime") '), $annee)
                        ->where(DB::raw('strftime("%m", articles.date,  "unixepoch", "localtime") '), $mois)
                        ->orderBy('date', 'DESC')->get();
        foreach ($articles as $article) {
            article::formater($article);
        }
        return View::make('index', array('articles' => $articles, 'nav' => array('annee' => $annee, 'mois' => $mois)));
    }

    public function historique() {
        return View::make('404');
    }

    public function missingMethod($parameters = array()) {
        return Redirect::route('home');
    }

}
