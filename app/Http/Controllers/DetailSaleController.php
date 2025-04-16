<?php

namespace App\Http\Controllers;

use App\Exports\SaleExport;
use App\Models\Customer;
use App\Models\Detail_sale;
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
        $currentDate = Carbon::now()->toDateString();
        $todaySalesCount = Detail_sale::whereDate('created_at', $currentDate)->count();
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
        
        return view('module.dashboard.index', compact('labels', 'salesData', 'detail_sales', 'todaySalesCount', 'productShell', 'labelspieChart', 'salesDatapieChart'));
        
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
            $sale->update([
                'total_point' => $customer->point,
                'total_pay' => $sale->total_pay - $customer->point,
                'total_return' => $sale->total_return + $customer->point,
                'total_discount' => $sale->total_price - $customer->point,
            ]);

            $customer->update([
                'name' => $request->name ? $request->name : $customer->name,
                'point' => 0
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
            return Facade::download(new SaleExport, 'Penjualan.xlsx');
        
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
