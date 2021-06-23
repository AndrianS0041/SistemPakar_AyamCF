<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengetahuanController extends Controller
{
    public function index()
    {
        return view('admin/pengetahuan/index');
    }
}