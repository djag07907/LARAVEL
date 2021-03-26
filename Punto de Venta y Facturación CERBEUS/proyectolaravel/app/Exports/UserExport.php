<?php

namespace App\Exports;

use App\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class UserExport implements FromView
{

    public function view(): View
    {
        $users = User::join('roles','users.idrol','=','roles.id')
        ->select('users.id','users.nombre','users.tipo_documento','users.num_documento','users.direccion','users.telefono','users.email','users.idrol','roles.nombre as nombre_rol')
        ->orderBy('users.nombre', 'desc')->get(); 

        return view('excel.usersexcel', [
            'users' => $users
        ]);
    }
}
