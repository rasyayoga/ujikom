<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
class Detail_sale extends Model
{
    use HasFactory, Notifiable; 

    protected $fillable = [
        'sale_id',
        'product_id',
        'amount',
        'subtotal',
    ];

    public function Sale()
    {
        return $this->belongsTo(Sale::class);
    }
    public function Product()
    {
        return $this->belongsTo(Product::class);
    }
}
