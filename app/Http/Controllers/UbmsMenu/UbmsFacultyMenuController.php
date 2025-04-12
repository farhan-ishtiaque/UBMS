<?php

namespace App\Http\Controllers\UbmsMenu;

use Illuminate\Http\Request;    
use App\Http\Controllers\Controller;


class UbmsFacultyMenuController extends Controller
{
    public function showMenu()
    {
        return view('UbmsMenu.ubms_faculties_menu');
    }
}