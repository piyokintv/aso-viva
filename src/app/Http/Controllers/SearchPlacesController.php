<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class SearchPlacesController extends Controller
{
    public function index()
    {
        return Inertia::render('SearchPlaces/index');
    }
}
