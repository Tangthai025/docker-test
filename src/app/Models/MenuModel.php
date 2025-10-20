<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuModel extends Model
{
    protected $table = 'menus';
    protected $primaryKey = 'menu_id';
    public $timestamps = false;

    protected $fillable = ['restaurant_id','name','menu_img','price','description'];

    // เมนูนี้อยู่ร้านไหน
    public function restaurant()
    {
        return $this->belongsTo(RestaurantModel::class, 'restaurant_id', 'restaurant_id');
    }
}
