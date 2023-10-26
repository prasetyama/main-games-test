<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Receipt extends Model
{
    use HasFactory;

    protected $table = 'receipt';

    protected $fillable = [
        'user_id',
    ];

    public function orders(){
        return $this->hasMany('App\Models\orders','receipt_id','id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
