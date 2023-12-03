<?php

namespace App\Http\Controllers\Usr;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        return Inertia::render('Usr/Dashboard');
    }

    public function profile()
    {
        return Inertia::render('Profiles/Usr');
    }
}
