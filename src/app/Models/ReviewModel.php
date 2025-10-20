<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReviewModel extends Model
{
    protected $table = 'reviews';
    protected $primaryKey = 'review_id';
    public $timestamps = false; // มีแค่ created_at

    protected $fillable = [
        'user_id',
        'restaurant_id', // อนุญาตว่างได้ตาม schema
        'menu_id',       // อนุญาตว่างได้ตาม schema
        'rating',
        'comment',
    ];

    // ความสัมพันธ์พื้นฐาน
    public function user()       { return $this->belongsTo(\App\Models\UserModel::class, 'user_id', 'user_id'); }
    public function restaurant() { return $this->belongsTo(\App\Models\RestaurantModel::class, 'restaurant_id', 'restaurant_id'); }
    public function menu()       { return $this->belongsTo(\App\Models\MenuModel::class, 'menu_id', 'menu_id'); }
}
