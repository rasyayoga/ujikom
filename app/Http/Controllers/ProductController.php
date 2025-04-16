<?php

namespace App\Http\Controllers;

use App\Models\Product;
use FontLib\Table\Type\name;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('module.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('module.product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        dd($request->all());
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'image' => 'nullable|max:8000'
        ]);

        // $imagePath = $request->file('image')->store('products', 'public');

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => 'random'
        ]);

        return redirect()->route('product')->with('success', 'berhasil menambahkan data');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product, $id)
    {
        $products = Product::find($id);
        if(!$products) {
            return redirect()->back();
        }
        return view('module.product.edit', compact('products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product, $id)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'image' => 'nullable',
        ]);

        $product = Product::findOrFail($id);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $product->image = $imagePath;
        }

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
        ]);

        return redirect()->route('product')->with('success', 'berhasil mengupdate data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product, $id)
    {
        $users = Product::findOrFail($id);
        $users->delete();
        return redirect()->back();
    }
}
