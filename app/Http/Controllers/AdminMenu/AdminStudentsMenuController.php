<?php

namespace App\Http\Controllers\AdminMenu;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class AdminStudentsMenuController extends Controller
{
    public function showMenu()
    {
        return view('AdminMenu.admin_students_menu');
    }
}