<?php

namespace App\Http\Controllers\UbmsMenu;

use Illuminate\Http\Request;    
use App\Http\Controllers\Controller;


class UbmsUniFundingMenuController extends Controller
{
    public function showMenu()
    {
        return view('UbmsMenu.ubms_unifundings_menu');
    }
}