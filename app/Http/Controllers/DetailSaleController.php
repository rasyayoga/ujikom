<?php

namespace App\Http\Controllers;

use App\Exports\SaleExport;
use App\Models\Customer;
use App\Models\Detail_sale;
use App\Models\Product;
use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel as Facade;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Support\Facades\Log;




class DetailSaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $todaySalesCount = Sale::whereDate('created_at', today())->count();
        $sales = Detail_sale::selectRaw('DATE(created_at) AS date, COUNT(*) AS total')
            ->groupByRaw('DATE(created_at)')
            ->orderByRaw('DATE(created_at)')
            ->get();
        
        $detail_sales = Detail_sale::with('Sale', 'Product')->get();
        $labels = $sales->pluck('date')->map(fn($date) => Carbon::parse($date)->format('d M Y'))->toArray();
        $salesData = $sales->pluck('total')->toArray();

        $productShell = Detail_sale::with('product')
        ->selectRaw('product_id, SUM(amount) as total_amount')
        ->groupBy('product_id')
        ->get();
        $labelspieChart = $productShell->map(fn($item) => $item->product->name . ' : ' . $item->total_amount)->toArray();
        $salesDatapieChart = $productShell->map(fn($item) => $item->total_amount)->toArray();
        

        //fungsi chard product
        $products = Product::with('Detail_sale')->get();
        $labelsProduct = $products->pluck('name')->toArray();
        $salesDataProduct = $products->pluck('stock')->toArray();

        //member dan nonmember
        $nonmember = Sale::where('customer_id', null)->count();
        $member = Sale::where('customer_id', '!=' , null)->count();
        return view('module.dashboard.index', compact('member', 'nonmember' ,'salesDataProduct', 'labelsProduct', 'labels', 'salesData', 'detail_sales', 'todaySalesCount', 'productShell', 'labelspieChart', 'salesDatapieChart'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    public function downloadPDF($id) {
        try {
            $sale = Sale::with('Detail_sale.Product')->findOrFail($id);

            $pdf = FacadePdf::loadView('module.pembelian.download', ['sale' => $sale]);
            Log::info('PDF berhasil diunduh untuk transaksi dengan ID ' . $id);

            return $pdf->download('Surat_receipt.pdf');
        } catch (\Exception $e) {
            Log::error('Gagal mengunduh PDF: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal mengunduh PDF');
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        $sale = Sale::with('Detail_sale.Product')->findOrFail($id);
        if($request->check_poin){
            $customer = Customer::where('id', $request->customer_id)->first();
            $pointOld = $customer->point - $request->point;
            $sale->update([
                'total_point' => $customer->point - $sale->point,
                'total_pay' => $sale->total_pay - $pointOld,
                'total_return' => $sale->total_return + $pointOld,
                'total_price' => $sale->total_price - $pointOld,
            ]);

            $customer->update([
                'name' => $request->name ? $request->name : $customer->name,
                'point' =>  $request->point,
            ]);
        }
        if ($request->name) {
            $customer = Customer::where('id', $request->customer_id)->first();
            $customer->update([
                'name' => $request->name
            ]);
        }
        return view('module.pembelian.print-sale', compact('sale'));
    }

    public function exportexcel()
    {
            if(Auth::user()){
                return Facade::download(new SaleExport, 'Penjualan.xlsx');
            }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Detail_sale $detail_sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Detail_sale $detail_sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Detail_sale $detail_sale)
    {
        //
    }
}
