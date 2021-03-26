<?php

function login(Request $request)
{
    $this->validator($request);

    // check many attempts
    if ($this->hasTooManyLoginAttempts($request)){
        $this->fireLockoutEvent($request);

        // redirect
        return $this->sendLockoutResponse($request);
    }

    // intentar login
    if(Auth::guard('admin')->attempt($request->only('usuario','password'), $request->filled('remember'))){

        // autenticado
        return redirect()
        ->intended(rout('admin.home'))
        ->with('status','Has ingresado como admin');
    }

    // llevar registro de intentos de login del usuario
    $this->incrementLoginAttempts($request);

    // auth fallida
    return $this->loginFailed();
}

// intentos permitidos

 $maxAttempts = 5;


// tiempo de bloqueo
 $decayMinutes = 3;