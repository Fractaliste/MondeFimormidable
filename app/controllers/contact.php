<?php

class contact extends \BaseController {

    public function __construct() {
        $this->beforeFilter('csrf', array('only' => 'store'));
    }

    /**
     * Reçoit le message envoyé par le formulaire de contact et vérifie s'il
     * est correct.
     *
     * @return Response
     */
    public function store() {
        $rules = array('nom' => 'required|regex:/[a-zA-Zàâäéèêëïîôöûüùÿ][a-zA-Zàâäéèêëïîôöûüùÿ\s\']+/',
            'email' => 'required|email',
            'telephone' => 'regex:/0[0-9]{9}/',
            'motif' => 'required|min:1|max:99',
            'texte' => 'required|min:5|max:500');
        $validator = Validator::make(Input::all(), $rules);
        Log::info('Formulaire de contact utilisé', Input::all());
        if ($validator->fails()) {
            return Redirect::to('contact')->withErrors($validator)->withInput()->with('envoi_contact', 'nok');
        } else {
            $data = array_add(Input::except('_token'), 'date', time());
            DB::table('messages')->insert($data);
            Mail::queue(array('text' => 'emailContactText', 'html' => 'emailContactHtml'), Input::all(), function($message) use ($data) {
                $message
                        ->to($data['email'], $data['nom'])
                        ->bcc('raphael.nourrit@gmail.com', 'Raphaël NOURRIT')
                        ->bcc('amandine.jouin2@gmail.com', 'Amandine JOUIN')
                        ->subject('Votre message sur http://monde-fimormidable.fr a bien été envoyé !');
            });
            return Redirect::to('contact')->with('envoi_contact', 'ok');
        }
    }

    /**
     * Affiche le formulaire de contact
     *
     * @return Response
     */
    public function index() {
        return View::make('contact');
    }

    public function missingMethod($parameters = array()) {
        return Redirect::route('home');
    }

}
