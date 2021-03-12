<?php
//© 2020 Copyright: Tahu Coding
namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoryProduct extends Model
{
        //demi keamanan kalian harusnya ubah ini ke fillable ya
        protected $guarded = [];
        protected $table = 'history_product';


        public function user(){
                return $this->belongsTo(User::class);
        }
}
