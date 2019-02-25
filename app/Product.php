<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
   'name','description','photo','price','category_id',
    ];
    public function getPhotoAttribute($photo){
        return asset($photo);
    }

    public function category(){
       return $this->belongsTo('app\Category');
   }
}
