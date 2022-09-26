<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class SearchPlacesController extends Controller
{
    public function index()
    {
        return Inertia::render('SearchPlaces/index');
    }
}
