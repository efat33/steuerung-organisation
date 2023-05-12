<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TechnicalController extends Controller
{
    public function list()
    {
        $data = array();

        return view('technical.list', $data);
    }
}
