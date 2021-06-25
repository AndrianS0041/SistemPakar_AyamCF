<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gejala;
use App\Models\Penyakit;
use App\Models\Pengetahuan;

class DashboardAdminController extends Controller
{
    public function index()
    {
        $gejala = Gejala::count();
        $penyakit = Penyakit::count();
        $pengetahuan = Pengetahuan::count();
        return view('admin/dashboard', compact('gejala','penyakit','pengetahuan'));
    }
}