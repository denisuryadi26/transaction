<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductTransaction extends Model
{
    //demi keamanan kalian harusnya ubah ini ke fillable ya
    protected $guarded = [];
    protected $table = 'product_transaction';

    
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
