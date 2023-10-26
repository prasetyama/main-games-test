<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Menu;

class Orders extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'menu_id',
        'receipt_id',
        'quantity',
        'price',
        'total_price'
    ];

    public function menu(){
        return $this->belongsTo(Menu::class);
    }
}
