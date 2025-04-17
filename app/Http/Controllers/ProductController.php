<?php

namespace App\Http\Controllers;

use App\Exports\ProductExport;
use App\Models\Detail_sale;
use App\Models\Product;
use FontLib\Table\Type\name;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel as Facade;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $max_data = 10;
        $query = Product::with('Detail_sale')->orderBy('id','asc');

        $products = $query->paginate($max_data)->withQueryString();

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
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'image' => 'nullable|max:8000|image'
        ],[
            'image.max' => 'silahkan pilih foto yang ukuranya lebih kecil'
        ]);

        $imagePath = $request->file('image')->store('products', 'public');

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $imagePath
        ]);

        return redirect()->route('product')->with('success', 'berhasil menambahkan data');
    }

    public function updatestock(Request $request, $id)
    {
        $request->validate([
            'stock' => 'required'
        ]);

        $product = Product::find($id);

        if(!$product) {
            return redirect()->back();
        }
        $product->update([
            'stock' => $request->stock
        ]);

        return redirect()->back();
    }
    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    public function exportProduct()
    {
            if(Auth::user()){
                return Facade::download(new ProductExport, 'Prodouct.xlsx');
            }
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
            'image' => 'nullable|image|max:8192' 
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
    public function destroy($id)
    {
        $isProductUsed = Detail_sale::where('product_id', $id)->exists();
    
        if ($isProductUsed) {
            return redirect()->route('product')->with('error', 'Produk tidak bisa dihapus karena sudah masuk transaksi.');
        }
    
        Product::where('id', $id)->delete();
        
        return redirect()->route('product')->with('success', 'Berhasil menghapus produk.');
    }
    
}
