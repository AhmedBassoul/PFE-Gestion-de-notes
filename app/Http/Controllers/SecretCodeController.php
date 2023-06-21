<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SaisirController;

class SecretCodeController extends Controller
{
    public function saisir_code_secret($ids=1)
    {
        return view('Principale.Code_Secret', ['ids' => $ids]);
    }
    

    

}
