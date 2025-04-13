<?php

namespace App\Http\Controllers\UbmsMenu;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class UbmsUniMenuController extends Controller
{
    public function showMenu()
    {
        return view('UbmsMenu.ubms_uni_menu');
    }
}
