<?php

namespace App\Http\Controllers\ModeratorMenu;

use Illuminate\Http\Request;    
use App\Http\Controllers\Controller;


class ModUniFundingMenuController extends Controller
{
    public function showMenu()
    {
        return view('ModeratorMenu.mod_unifundings_menu');
    }
}