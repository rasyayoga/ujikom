<?php

namespace App\Exports;

use App\Models\Sale;
use App\Models\saless;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SaleExport implements FromView, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('module.export.index', [
            'invoices' => Sale::all()
        ]);
    }
    
    public function headings(): array
    {
        return [
            'nama pembeli',
            'No HP Pembeli',
            'point Pembeli',
            'product',
            'Total Harga',
            'total bayar',
            'total discount point',
            'total kembalian',
            'tanggal pembelian',
        ];
    }

    public function map($item): array
    {
        return [
            optional($item->customer)->name ?? 'Bukan Member',
            optional($item->customer)->no_hp ?? '-',
            optional($item->customer)->point ?? 0,
            $item->detail_sales->map(function ($detail) {
                return optional($detail->product)->name
                    ? optional($detail->product)->name . ' (' . $detail->amount . ' : Rp. ' . number_format( $detail->subtotal, 0, ',', '.') . ')'
                    : 'Produk tidak tersedia';
            })->implode(', '), 
            $item->detail_sales->sum('subtotal'), 
            $item->total_pay,
            $item->total_price - optional($item->customer)->point ?? 0,
            $item->total_return,
            $item->created_at,
        ];
    }
    
}