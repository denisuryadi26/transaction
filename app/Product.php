<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    protected $table = 'product';

    public function Category()
    {
        return $this->belongsTo(Category::class);
    }

}
