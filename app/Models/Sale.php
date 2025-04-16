<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
class Sale extends Model
{
    use HasFactory, Notifiable; 

    protected $fillable = [
        'sale_date',
        'total_price',
        'total_pay',
        'total_return',
        'customer_id',
        'user_id',
        'point',
        'total_point',
    ];

    public function Detail_sale()
    {
        return $this->hasMany(Detail_sale::class);
    }

    public function Customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
