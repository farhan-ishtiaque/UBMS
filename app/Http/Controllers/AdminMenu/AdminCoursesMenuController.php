<?php

namespace App\Http\Controllers\AdminMenu;


use App\Http\Controllers\Controller;


class AdminCoursesMenuController extends Controller
{
    public function showMenu()
    {
        return view('AdminMenu.admin_courses_menu');
    }
}