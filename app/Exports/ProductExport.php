<?php

namespace App\Exports;

use App\Models\Product;
use App\Models\Sale;
use App\Models\saless;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProductExport implements FromView, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('module.export.product.index', [
            'dataproduct' => Product::orderBy('name', 'asc')->get()
        ]);
    }
    
    
    public function headings(): array
    {
        return [
            'name', 
            'price',
            'stock',
            'image',
        ];
    }

    public function map($item): array
    {
        return [
            $item->name,
            $item->price,
            $item->stock,
            $item->image,
        ];
    }
    
}