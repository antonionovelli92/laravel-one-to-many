<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(5);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = new Category();
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'label' => 'required|string|unique:categories|max:15',
            'color' => 'nullable|string|size:7',

        ], [
            'label.required' => 'La categoria deve avere un label',
            'label.max' => 'La categoria deve avere massimo :max caratteri',
            'label.unique' => 'Esiste già una categoria con questo nome',
            'color.size' => 'Il colore deve essere un codice esadecimale con un cancelletto che precede',

        ]);
        $data = $request->all();
        $category = new Category();
        $category->fill($data);
        $category->save();
        return to_route('admin.categories.index')->with('type', 'success')->with('msg', 'Categoria registrata con successo');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        // return view('admin.categories.index', compact('category'));
        return to_route('admin.categories.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'label' => ['required', 'string', Rule::unique('categories')->ignore($category->id), 'max:15'],
            'color' => 'nullable|string|size:7',

        ], [
            'label.required' => 'La categoria deve avere un label',
            'label.max' => 'La categoria deve avere massimo :max caratteri',
            'label.unique' => 'Esiste già una categoria con questo nome',
            'color.size' => 'Il colore deve essere un codice esadecimale con un cancelletto che precede',

        ]);
        $data = $request->all();
        $category->update($data);
        return to_route('admin.categories.index')->with('type', 'success')->with('msg', 'Categoria modificata con successo');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return to_route('admin.categories.index')->with('type', 'danger')->with('msg', "La categoria '$category->label' è stata eliminato con successo");
    }
}
