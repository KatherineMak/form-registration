<?php

namespace App\Controllers;
use App\Core\Controller as Controller;

class MainController extends Controller
{

    public function home()
    {
        return view('home');
    }

    public function formIndex()
    {
        return view('formIndex');
    }

    public function formAdditional()
    {
        return view('formIndex');
    }
    public function formShare()
    {
        return view('formIndex');
    }
}