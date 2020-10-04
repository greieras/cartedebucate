<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::all();
        return view('menu', ['categories'=> $categories]);
    }

    public function menu()
    {
        $categories = Category::with('menuItems')
                            ->orderBy('display_order')
                            ->get();
        return view('admin.menu', [
            'categories' => $categories
        ]);
    }
}
