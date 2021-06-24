<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pakar;
use DB;

class PakarController extends Controller
{
    public function index()
    {
        return view('admin/pakar/index');
    }
    
}