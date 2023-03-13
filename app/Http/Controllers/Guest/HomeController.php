<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class HomeController extends Controller
{
    public function index()
    {
        $projects = Project::where('is_published', true)->orderBy('updated_at', 'DESC')->paginate(5);

        return view('guest.home', compact('projects'));
    }
}
