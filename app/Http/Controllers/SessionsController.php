<?php

namespace App\Http\Controllers;
use Illuminate\Validation\ValidationException;



class SessionsController extends Controller
{
    public function create()
    {
        return view('sessions.create');
    }

    public function store()
    {
        // validate the request
        $attributes = request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // attempt to authenticate and log in the user
        // based on the provided credential
        if (! auth()->attempt($attributes)) {
            // auth failed
            throw ValidationException::withMessages([
                'email' => 'Your provided credentials could not be verified.'
            ]);
        }
        // SAME THING AS ValidationException
        // return back()
        //     ->withInput()
        //     ->withErrors(['email' => 'Your provided credentials could not be verified.']);
        session()->regenerate();  // to prevent malicious users from exploiting a session fixation attack on application
        // redirect with a success flash message
        return redirect('/')->with('success', 'Welcome Back!');
    }

    public function destroy()
    {
        auth()->logout();

        return redirect('/')->with('success', 'Goodbye!');
    }
}
