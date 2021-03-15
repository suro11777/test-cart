<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'amount',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function order_products()
    {
        return $this->hasMany(OrderProduct::class);
    }
}
