<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'transaction_id',
        'product_id',
        'price',
        'resi',
        'shipping_status',
        'code'
    ];

    public function product() {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    public function transaction() {
        return $this->hasOne(Transaction::class, 'id', 'transaction_id');
    }
}
