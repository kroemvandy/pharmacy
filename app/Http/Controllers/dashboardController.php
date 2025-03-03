<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MMedicine;

class dashboardController extends Controller
{
    public function index()
    {
        $medicine = MMedicine::latest()->get();
        return view('backend.dashboard.index', compact('medicine'));
    }
}
