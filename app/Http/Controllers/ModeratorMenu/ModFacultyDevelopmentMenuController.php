<?php

namespace App\Http\Controllers\ModeratorMenu;

use Illuminate\Http\Request;    
use App\Http\Controllers\Controller;


class ModFacultyDevelopmentMenuController extends Controller
{
    public function showMenu()
    {
        return view('ModeratorMenu.mod_facultydevelopment_menu');
    }
}