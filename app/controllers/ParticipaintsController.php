<?php

namespace App\Controllers;

use App\Models\Participaint;
use App\Core\Controller as Controller;

class ParticipaintsController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = new Participaint('participaints');
    }

    public function index()
    {
        $participaints =    $this->model->select();
        return view('participaints', compact('participaints'));
    }

    public function test()
    {
        return view('phpinfo');
    }

}