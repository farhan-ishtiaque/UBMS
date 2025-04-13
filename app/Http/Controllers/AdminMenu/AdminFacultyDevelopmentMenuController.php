<?php

namespace App\Http\Controllers\AdminMenu;

use Illuminate\Http\Request;    
use App\Http\Controllers\Controller;


class AdminFacultyDevelopmentMenuController extends Controller
{
    public function showMenu()
    {
        return view('AdminMenu.admin_facultydevelopment_menu');
    }
}