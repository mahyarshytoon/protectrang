<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Service;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class HomeController extends Controller
{
   public function index()
{
    $services = Service::where('is_active', true)->orderBy('order')->get();
    $projects = Project::where('is_active', true)->orderBy('order')->orderBy('id', 'desc')->get();
    $testimonials = Testimonial::where('is_approved', true)->orderBy('id', 'desc')->limit(10)->get();

    return view('home.index', compact('services', 'projects', 'testimonials'));
}}