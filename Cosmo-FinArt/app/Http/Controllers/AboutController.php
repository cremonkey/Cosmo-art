<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\View\View;

class AboutController extends Controller
{
    public function index(): View
    {
        $about = About::query()->latest()->first();

        return view('about', compact('about'));
    }
}

