<?php

class asset extends \BaseController {

    function add() {
        return Response::json(array(), 404);
        $id_span = Input::get('compteur');
        $id_article = Input::get('article_id');
        $file = Input::file('asset');
        if (Input::hasFile('asset')) {
            $file = Input::file('asset');
            $extension = strtolower($file->getClientOriginalExtension());
            $nom = strtolower($file->getClientOriginalName());
            $taille = strtolower($file->getSize());
            if (!in_array($extension, Config::get('enum.extensions_autorisees'))) {
                return Response::json(array('resultat' => false, 'raison' => 'Le format du fichier n\'est pas autorisé !',
                            'id_span' => $id_span, 'nom' => $nom, 'taille' => $taille));
            } else {
                $path = 'images/' . date('Y/m');
                $i = "";
                $nomT = $nom;
                while (file_exists($path . '/' . $nomT)) {
                    $i++;
                    $nomT = $nom;
                    $temp = explode('.', $nom);
                    $temp[0] = $temp[0] . $i;
                    $nomT = implode('.', $temp);
                }
                $nom = $nomT;
                $file->move($path, $nom);
                $id_asset = DB::table('assets')->insertGetId(array(
                    'nom' => $nom,
                    'url' => $path . '/' . $nom,
                    'extension' => $extension,
                    'taille' => $taille,
                    'date_ajout' => time(),
                    'etat' => 1
                ));
                $id_meta = DB::table('metas')->insertGetId(array(
                    'type' => 3,
                    'nom1' => 'article',
                    'nom2' => 'asset',
                    'id1' => $id_article,
                    'id2' => $id_asset,
                ));
                Queue::later(10, 'asset');
                return Response::json(array('resultat' => true, 'id_span' => $id_span, 'nom' => $nom,
                            'taille' => $taille, 'id_meta' => $id_meta, 'url' => asset($path . '/' . $nom)));
            }
        } else {
            return Response::json(array('resultat' => false, 'raison' => 'Aucun fichier trouvé !',
                        'id_span' => $id_span));
        }
    }

    function detache() {
        $id = Input::get('id');
        DB::table('metas')->where('id', $id)->delete();
        return Response::json(array('resultat' => true, 'id' => $id));
    }

    function fire($job = null, $data = null) {
        $result = DB::table('assets')->where('etat', 1)->get();
        foreach ($result as $raw) {
            $img = Image::make($raw->url);
            $img->interlace();
            if ($img->height > 600 || $img->width > 600) {
                $img->resize(600, 600, true, false);
                $img->save(null, 100);
            }
            $img->resize(100, 100, true, false);
            $pathMin = $img->dirname . '/min';
            if (!is_dir($pathMin)) {
                echo mkdir($pathMin, 0705);
            }
            $img->save($pathMin . '/' . $img->filename . '.png', 70);
            $result = DB::table('assets')->where('id', $raw->id)->update(array('etat' => 2, 'url_miniature' => $pathMin . '/' . $img->filename . '.png'));
        }
        $job->delete();
    }

    public function galerie() {
        return View::make('galerie');
    }

    public function missingMethod($parameters = array()) {
        return Redirect::route('home');
    }

}
