<?php


namespace App\Models\Api;


use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [

    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    /**
     * @param $id
     * @param int $count
     */
    public function plus($id, $count = 1) {
        $this->change($id, $count);
    }

    /**
     * @param $id
     * @param int $count
     */
    public function minus($id, $count = 1) {
        $this->change($id, -1 * $count);
    }

    /**
     * @param $id
     * @param int $count
     */
    private function change($id, $count = 0) {
        if ($count == 0) {
            return;
        }
        // if cart has product, change count
        if ($this->products->contains($id)) {
            $pivotRow = $this->products()->where('product_id', $id)->first()->pivot;
            $quantity = $pivotRow->quantity + $count;
            if ($quantity > 0) {
                $pivotRow->update(['quantity' => $quantity]);
            } else {
                $pivotRow->delete();
            }
        }//or -add product
        elseif ($count > 0) {
            $this->products()->attach($id, ['quantity' => $count]);
        }

    }

    /**
     * @return float|int
     */
    public function getAmount()
    {
        $amount = 0.0;
        foreach ($this->products as $product) {
            $amount = $amount + $product->price * $product->pivot->quantity;
        }
        return $amount;
    }

    /**
     * @param $id
     */
    public function remove($id)
    {
        // delete product for cart
        $this->products()->detach($id);
    }


}
