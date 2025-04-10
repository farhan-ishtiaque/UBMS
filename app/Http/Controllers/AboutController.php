<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Display the about page with former chairmen data.
     */
    public function index()
    {
        $formerChairmen = [
            [
                'name' => 'Professor Dr. Farhan Ishtiaque',
                'from' => '2006',
                'to' => '2010',
                'linkedin' => 'https://www.linkedin.com/in/farhan-ishtiaque?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app'
            ],
            [
                'name' => 'Professor Dr. Asfiya Rashid Chowdhury',
                'from' => '2011',
                'to' => '2015',
                'linkedin' => 'https://www.linkedin.com/in/asfiya-chowdhury?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app'
            ],
            [
                'name' => 'Professor Dr. Minhaj Rafi',
                'from' => '2016',
                'to' => '2021',
                'linkedin' => 'https://www.linkedin.com/in/minhaj-rafi-837414314?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app'
            ],
            [
                'name' => 'Professor Dr. Ahmed Kiser',
                'from' => '2022',
                'to' => 'Present',
                'linkedin' => 'https://www.linkedin.com/in/ahmed-11-kiser?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app'
            ],
        ];

        return view('about', [
            'formerChairmen' => $formerChairmen
        ]);
    }
}
