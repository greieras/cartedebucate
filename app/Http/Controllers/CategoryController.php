<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
	
	public function index()
	{
		return ['success'=>true, 'code'=> 200, 'categories'=> Category::all()];
	}
    public function upsert(Request $request)
    {
        $this->authorize('manage', 'App\Category');
        $categories = $request->post('categories');
        foreach($categories as $cat){
            if ($cat['id']) {
                Category::where('id', $cat['id'])->update($cat);
            } else {
                Category::create($cat);
            }
        }
        return ['success'=>true, 'categories'=> Category::all()];
    }

    public function destroy(Category $category)
    {
        $this->authorize('delete', $category);
        $category->delete();
        return ['success' => true];
    }

    public function items(Category $category)
    {
        return $category->menuItems->map(function($item){
            return $item->only(['id', 'name', 'image']);
        });
    }
}
