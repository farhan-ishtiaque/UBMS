<?php

namespace App\Http\Controllers\ModeratorMenu;

use Illuminate\Http\Request;    
use App\Http\Controllers\Controller;


class ModDepartmentsMenuController extends Controller
{
    public function showMenu()
    {
        return view('ModeratorMenu.mod_departments_menu');
    }
}