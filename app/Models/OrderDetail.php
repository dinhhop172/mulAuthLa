<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'order_details';
    protected $fillable = ['quantity', 'price'];

    /**
     * Get the orders that owns the OrderDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function orders(): BelongsTo
    {
        return $this->belongsTo('App\Models\Orders', 'order_id', 'id');
    }

    /**
     * Get the products that owns the OrderDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo('App\Models\Product', 'product_id', 'id');
    }
}
