<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Detail_sale;
use App\Models\Product;
use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sale = Sale::with('Customer', 'User', 'Detail_sale')->orderBy('id','desc')->get();
        return view('module.pembelian.index', compact('sale'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $product = Product::all();
        return view('module.pembelian.create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!$request->has('shop')) {
            return back()->with('error', 'Pilih produk terlebih dahulu!');
        }

        session()->forget('shop');

        $selectedProducts = $request->shop;

        if (!is_array($selectedProducts)) {
            return back()->with('error', 'Format data tidak valid!');
        }

        $filteredProducts = collect($selectedProducts)
            ->mapWithKeys(function ($item) {
                $parts = explode(';', $item);
                if (count($parts) > 3) {
                    $id = $parts[0];
                    return [$id => $item];
                }
                return [];
            })
            ->values()
            ->toArray();

        session(['shop' => $filteredProducts]);
        return redirect()->route('sale.post');
    }

    public function post()
    {
        $shop = session('shop', []);
        return view('module.pembelian.detail', compact('shop'));
    }

    public function viewsale(Request $request)
    {
        $request->validate([
            'total_pay' => 'required'
        ],[
            'total_pay.required' => 'masukan jumlah yang akan dibayar'
        ]);
        $newPrice = (int) preg_replace('/\D/', '', $request->total_price);
        $newPay = (int) preg_replace('/\D/', '', $request->total_pay);
        $newreturn = $newPay - $newPrice;
        if($request->member === 'Member') {
            $existCustomer = Customer::where('no_hp', $request->no_hp)->first();
            $point = floor($newPrice / 100);
            if ($existCustomer) {
                $existCustomer->update([
                    'point' => $existCustomer->point + $point, 
                ]);
                $customer_id = $existCustomer->id;
            } else {

                $existCustomer = Customer::create([
                    'name' => '',
                    'no_hp' => $request->no_hp,
                    'point' => $point,
                ]);
                $customer_id = $existCustomer->id;
            }

            $sale = Sale::create([
                'sale_date' => now(),
                'total_price' => $newPrice,
                'total_pay' => $newPay,
                'total_return' => $newreturn,
                'customer_id' => $customer_id,
                'user_id' => FacadesAuth::id(),
                'point' => floor($newPrice / 100),
                'total_point' => 0
            ]);
            
            $detailSalesData = [];
        
            foreach ($request->shop as $shopItem) {
                $item = explode(';', $shopItem);
                $productId = (int) $item[0];
                $amount = (int) $item[3];
                $subtotal = (int) $item[4];

                $detailSalesData[] = [
                    'sale_id' => $sale->id,
                    'product_id' => $productId,
                    'amount' => $amount,
                    'subtotal' => $subtotal,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                $product = Product::find($productId);
                if ($product) {
                    $newStock = $product->stock - $amount;
                    if ($newStock < 0) {
                        return redirect()->back()->withErrors(['error' => 'Stok tidak mencukupi untuk produk ' . $product->name]);
                    }
                    $product->update(['stock' => $newStock]);
                }
            }
            Detail_sale::insert($detailSalesData);
            return redirect()->route('viewmembersale', ['id' => Sale::latest()->first()->id])
                ->with('message', 'Silahkan daftar sebagai member');
        }else {
            $sale = Sale::create([
                'sale_date' => Carbon::now(),
                'total_price' => $newPrice,
                'total_pay' => $newPay,
                'total_return' => $newreturn,
                'customer_id' => $request->customer_id,
                'user_id' => FacadesAuth::id(),
                'point' => 0,
                'total_point' => 0,
            ]);

            $detailSalesData = [];

            foreach ($request->shop as $shopItem) {
                $item = explode(';', $shopItem);
                $productId = (int) $item[0];
                $amount = (int) $item[3];
                $subtotal = (int) $item[4];

                $detailSalesData[] = [
                    'sale_id' => $sale->id,
                    'product_id' => $productId,
                    'amount' => $amount,
                    'subtotal' => $subtotal,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                $product = Product::find($productId);
                if ($product) {
                    $newStock = $product->stock - $amount;
                    if ($newStock < 0) {
                        return redirect()->back()->withErrors(['error' => 'Stok tidak mencukupi untuk produk ' . $product->name]);
                    }
                    $product->update(['stock' => $newStock]);
                }
            }
            Detail_sale::insert($detailSalesData);
            return redirect()->route('sales.print.show', ['id' => $sale->id])->with('Silahkan Print');
        }

    }
    
    /**
     * Display the specified resource.
     */
    public function createmember($id)
    {
        $sale = Sale::with('Detail_sale.Product')->findOrFail($id);
        // Menentukan apakah customer sudah pernah melakukan pembelian sebelumnya
        $notFirst = Sale::where('customer_id', $sale->customer->id)->count() != 1 ? true : false;
        return view('module.pembelian.view-member', compact('sale','notFirst'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        //
    }
}








