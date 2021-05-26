<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        // Prendo i dati dal database
        return view('guest.index');
    }
}
