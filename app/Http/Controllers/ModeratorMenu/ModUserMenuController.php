<?php

namespace App\Http\Controllers\ModeratorMenu;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class ModUserMenuController extends Controller
{
    public function showMenu()
    {
        return view('ModeratorMenu.mod_user_menu');
    }
}