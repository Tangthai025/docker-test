<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RestaurantModel extends Model
{
    protected $table = 'restaurants';
    protected $primaryKey = 'restaurant_id';
    public $timestamps = false; // มีแค่ created_at

    protected $fillable = [
        'name',
        'restaurant_img',
        'category',
        'location',
        'description',
    ];

    // ร้านหนึ่งมีหลายเมนู
    public function menus()
    {
        return $this->hasMany(MenuModel::class, 'restaurant_id', 'restaurant_id');
    }

    // URL รูปร้าน (ถ้าเก็บไฟล์ไว้ใน storage/app/public)
    public function getRestaurantImgUrlAttribute(): string
    {
        return $this->restaurant_img
            ? asset('storage/' . ltrim($this->restaurant_img, '/'))
            : asset('images/restaurant-placeholder.jpg');
    }
}

