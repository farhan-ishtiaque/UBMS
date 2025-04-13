<?php

namespace App\Http\Controllers\UbmsMenu;

use Illuminate\Http\Request;    
use App\Http\Controllers\Controller;


class UbmsJobpostingMenuController extends Controller
{
    public function showMenu()
    {
        return view('UbmsMenu.ubms_jobposting_menu');
    }
}