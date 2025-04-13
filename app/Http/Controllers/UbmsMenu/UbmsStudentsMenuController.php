<?php

namespace App\Http\Controllers\UbmsMenu;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class UbmsStudentsMenuController extends Controller
{
    public function showMenu()
    {
        return view('UbmsMenu.ubms_students_menu');
    }
}