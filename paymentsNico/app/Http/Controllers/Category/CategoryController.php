<?php

namespace App\Http\Controllers\Category;

use Inertia\Inertia;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return Inertia::render('Category/Index', [
            'categories' => $categories,
        ]);
    }

    public function create()
    {
        return Inertia::render('Category/Create');
    }

    public function store(Request $request)
    {
        // Valida y guarda el registro en la base de datos
        // ...

        return redirect()->route('categories.index');
    }

    public function show(Category $category)
    {
        return Inertia::render('Category/Show', [
            'category' => $category,
        ]);
    }

    public function edit(Category $category)
    {
        return Inertia::render('Category/Edit', [
            'category' => $category,
        ]);
    }

    public function update(Request $request, Category $category)
    {
        // Valida y actualiza el registro en la base de datos
        // ...

        return redirect()->route('categories.index');
    }

    public function destroy(Category $category)
    {
        // Elimina el registro de la base de datos
        // ...

        return redirect()->route('categories.index');
    }
}
