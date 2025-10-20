<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LikedModel extends Model
{
    protected $table = 'likes';        // ชื่อตาราง
    protected $primaryKey = 'like_id'; // คีย์หลัก
    public $timestamps = false;        // มีแค่ created_at

    protected $fillable = [
        'review_id',
        'user_id',
    ];

    /** ความสัมพันธ์ */
    public function review()
    {
        return $this->belongsTo(ReviewModel::class, 'review_id', 'review_id');
    }

    public function user()
    {
        return $this->belongsTo(UserModel::class, 'user_id', 'user_id');
    }

    /** Scopes ช่วยกรอง */
    public function scopeForReview($q, int $reviewId)
    {
        return $q->where('review_id', $reviewId);
    }

    public function scopeByUser($q, int $userId)
    {
        return $q->where('user_id', $userId);
    }

    /**
     * Toggle like: true = เปลี่ยนเป็น "ไลก์แล้ว", false = "ยกเลิกไลก์"
     */
    public static function toggleFor(int $reviewId, int $userId): bool
    {
        $existing = static::where('review_id', $reviewId)->where('user_id', $userId)->first();

        if ($existing) {
            $existing->delete();
            return false; // ยกเลิกไลก์
        }

        static::create(['review_id' => $reviewId, 'user_id' => $userId]);
        return true; // กดไลก์
    }
}
