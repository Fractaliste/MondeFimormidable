<?php

class login extends \BaseController {

    public function getLogin() {
        return View::make('admin/login');
    }

    public function postLogin() {
        $username = Input::get('username');
        $password = Input::get('password');
        if (Auth::attempt(array('username' => $username, 'password' => $password)))
            return Redirect::intended('tagada');
        else
            return Redirect::to('login');
    }

    public function getLogout() {
        Auth::logout();
        return Redirect::route('home');
    }

    public function missingMethod($parameters = array()) {
        return Redirect::route('home');
    }

}
