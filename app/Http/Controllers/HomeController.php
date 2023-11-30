<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Department;
use App\Models\Offer;
use App\Models\Region;
use App\Models\User;
use App\Models\Type;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function index(Request $request)
    {
   // Fetch top categories with offer counts
   $topCategories = Category::select('categories.id', 'categories.name', DB::raw('COUNT(offers.id) as offer_count'))
   ->leftJoin('offers', 'categories.id', '=', 'offers.category_id')
   ->groupBy('categories.id', 'categories.name') // Include all selected columns in GROUP BY
   ->orderByDesc('offer_count')
   ->limit(5)
   ->get();


// Fetch top regions with offer counts
$topRegions = Region::select('regions.id','regions.name', DB::raw('COUNT(offers.id) as offer_count'))
   ->leftJoin('offers', 'regions.id', '=', 'offers.region_id')
   ->groupBy('regions.id','regions.name')
   ->orderByDesc('offer_count')
   ->limit(5)
   ->get();
   // Fetch top 
   $topUsers = User::select('users.id', 'users.name', 'users.profile_photo_path', DB::raw('COUNT(offers.id) as offer_count'))
   ->leftJoin('offers', 'users.id', '=', 'offers.user_id')
   ->groupBy('users.id', 'users.name', 'users.profile_photo_path')
   ->orderByDesc('offer_count')
   ->limit(5)
   ->get();

    return view('home', compact('topCategories', 'topRegions','topUsers'));
    }

    }

