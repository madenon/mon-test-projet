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
        // Get the list of departments
        $departments = Department::all();
        $types=Type::all();
        $query = $request->input('query');
        $category = $request->input('category'); // Retrieve the selected category
        $department = $request->input('department');
        $region = $request->input('region');
        $type = $request->input('type');


        $queryBuilder = Offer::with('preposition')
        ->orderBy('created_at', 'DESC')
        ->where('active_offer', 1);
        if ($query) {
            $queryBuilder->where('title', 'like', '%' . $query . '%');
        }

        if ($category) {
            $queryBuilder->where('category_id', $category); // Filter by category ID
        }
        if ($department) {
            $queryBuilder->where('department_id', $department); // Filter by category ID
        }
        if ($type) {
            $queryBuilder->where('type_id', $type); // Filter by category ID
        }
        if ($region) {
            $queryBuilder->where('region_id', $region); // Filter by category ID
        }
        $offers = $queryBuilder->paginate(10);
        $categoryName = Category::where('id', $category)->value('name');
        return view('home', compact('offers','departments','types','categoryName'));
    }

    }

