<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::where('user_id', auth()->id())->get();
        return view('categoria', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categoriaform');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:category,name',
        ]);

        // Add the user_id to the validated data
        $validated['user_id'] = auth()->id();

        // Create the category
        Category::create($validated);

        return redirect("/category")->with('success', 'Categoria creada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category, $id)
    {
        $category = Category::where('id',$id)->first();
        return view('categoriaform', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        // Validate the input
        $category = Category::where('id',$request->id);
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:category,name',
        ]);

        // Update the category
        $category->update($validated);

        return redirect("/category")->with('success', 'Categoria ha sido actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {

        $category = Category::where('id',$id);
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        $category->delete();

        return redirect("/category")->with('success', 'Categoria ha sido eliminada correctamente');
    }
}
