<?php

namespace App\Http\Controllers\Auth;

use Wave\Http\Controllers\Auth\RegisterController as AuthRegisterController;

class RegisterController extends AuthRegisterController
{
    // Override the redirectTo property
    protected $redirectTo = '/login';

    // Override the registered method to add a success message
    protected function registered($request, $user)
    {
        // Add a flash message to the session
        session()->flash('success', 'Registratie succesvol! Log in om door te gaan.');

        // Call the parent method to complete the registration process
        return redirect($this->redirectTo);
    }
}
