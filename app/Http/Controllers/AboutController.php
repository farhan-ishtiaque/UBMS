<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Display the about page with former chairmen data
     */
    public function index()
    {
        $formerChairmen = [
            ['name' => 'Professor Dr. Muzaffar Ahmed Chowdhury', 'from' => '13-04-1973', 'to' => '25-01-1975'],
            ['name' => 'Professor ABM Habibullah', 'from' => '12-02-1975', 'to' => '05-07-1977'],
            ['name' => 'Professor Dr. M A Naser', 'from' => '06-07-1977', 'to' => '17-02-1981'],
            // Add all other chairmen...
        ];

        return view('about', [
            'formerChairmen' => $formerChairmen
        ]);
    }
}