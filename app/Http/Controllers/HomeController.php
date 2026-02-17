<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Service;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProjects = Project::latest()->take(3)->get();
        $services = Service::active()->ordered()->get();

        return view('home', [
            'featuredProjects' => $featuredProjects,
            'services' => $services,
        ]);
    }
}
