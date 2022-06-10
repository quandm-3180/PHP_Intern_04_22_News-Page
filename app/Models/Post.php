<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'content',
        'category_id',
        'user_id',
        'is_popular',
    ];

    public function getStatusAttribute($value)
    {
        $postStatus = null;
        switch ($value) {
            case config('custom.post_status.pending'):
                $postStatus = __('Pending');
                break;
            case config('custom.post_status.cancel'):
                $postStatus = __('Cancel');
                break;
            case config('custom.post_status.approved'):
                $postStatus = __('Approved');
                break;
            case config('custom.post_status.rejected'):
                $postStatus = __('Rejected');
                break;
            default:
                $postStatus = __('Pending');
                break;
        }

        return $postStatus;
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('M, d Y');
    }

    public function scopeIsApproved($query)
    {
        return $query->where('status', config('custom.post_status.approved'));
    }

    public function scopeIsPopular($query)
    {
        return $query->where('is_popular', config('custom.post_popular.yes'));
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
