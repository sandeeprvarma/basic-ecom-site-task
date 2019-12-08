<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Products extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id','title','description','image','price'
    ];

    public static function orders()
    {
        return DB::table('orders')
                ->join('products','orders.product_id','=','products.id')  
                ->select('orders.*', 'products.*')
                ->get();
    }
}
