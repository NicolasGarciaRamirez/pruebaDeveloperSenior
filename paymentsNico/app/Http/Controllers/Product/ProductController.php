<?php

namespace App\Http\Controllers\Product;

use Inertia\Inertia;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
	public function index()
    {
        $products = Product::all();

        return Inertia::render('Product/Index', [
            'products' => $products,
        ]);
    }

    public function create()
    {
        $categories = Category::all();

        return Inertia::render('Product/Create', [
            'categories' => $categories,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => [
                'required',
                Rule::exists('categories', 'id'),
            ],
        ]);

        $imagePath = $request->file('image')->store('products', 'public');

        Product::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'stock' => $request->input('stock'),
            'image' => $imagePath,
            'user_id' => auth()->id(), // Opcional: Asigna el ID del usuario actual
            'category_id' => $request->input('category_id'),
        ]);

        return redirect()->route('products.index');
    }

    public function show(Product $product)
    {
        return Inertia::render('Product/Show', [
            'product' => $product,
        ]);
    }

    public function edit(Product $product)
    {
        $categories = Category::all();

        return Inertia::render('Product/Edit', [
            'product' => $product,
            'categories' => $categories,
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'category_id' => [
                'required',
                Rule::exists('categories', 'id'),
            ],
        ]);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($product->image); // Elimina la imagen anterior
            $imagePath = $request->file('image')->store('products', 'public');
        } else {
            $imagePath = $product->image; // Conserva la imagen anterior si no se actualiza
        }

        $product->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'stock' => $request->input('stock'),
            'image' => $imagePath,
            'category_id' => $request->input('category_id'),
        ]);

        return redirect()->route('products.index');
    }

    public function destroy(Product $product)
    {
        Storage::disk('public')->delete($product->image); // Elimina la imagen asociada al producto
        $product->delete();

        return redirect()->route('products.index');
    }
}
