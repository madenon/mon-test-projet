<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use App\Models\Category;
use App\Models\Department;
use App\Models\Offer;
use App\Models\Type;
class AdminController extends Controller
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
        return redirect()->route('platform.main');

    }

    /**
     * Display the login view.
     */
    public function login(): View
    {
        return view('admin.login');
    }

        /**
     * Handle an incoming authentication request.
     */
    public function store(/* `LoginRequest` is a custom request class that handles the validation and
    authorization logic for the login form submission. It extends the
    `Illuminate\Foundation\Http\FormRequest` class and defines the validation
    rules and authorization logic in its `rules()` and `authorize()` methods,
    respectively. The `LoginRequest` class is used in the `store()` method of
    the `AdminController` to validate the login form data before attempting
    authentication. */
    LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->route('admin.index');
    }

}
