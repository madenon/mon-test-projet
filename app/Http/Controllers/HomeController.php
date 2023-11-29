<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Department;
use App\Models\Offer;
use App\Models\Type;
class HomeController extends Controller
{

    public function index(Request $request)
    {
        
        return view('home');
    }

    }

