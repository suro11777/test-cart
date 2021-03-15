<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{

    protected $fillable = [
        'product_id',
        'name',
        'price',
        'quantity',
        'cost',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
