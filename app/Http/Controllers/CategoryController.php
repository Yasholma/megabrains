<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate(10);
        return view('vendor.multiauth.category.index')->with('categories', $categories);
    }

    public function create()
    {
        return view('vendor.multiauth.category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:150|unique:categories',
            'status' => 'required'
        ]);



        Category::create($request->all());

        return redirect(route('admin.categories.index'))->with('message', 'New Category is stored successfully');
    }

    public function show(Category $category)
    {
        //
    }

    public function edit(Category $category)
    {

    }

    public function update(Request $request, Category $category)
    {
        //
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->back()->with('message', 'You have deleted Category successfully');
    }
}
