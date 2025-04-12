<?php

namespace App\Http\Controllers\AdminMenu;

use Illuminate\Http\Request;    
use App\Http\Controllers\Controller;


class AdminDepartmentsMenuController extends Controller
{
    public function showMenu()
    {
        return view('AdminMenu.admin_departments_menu');
    }
}