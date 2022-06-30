<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'status',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function getStatusAttribute($value)
    {
        return ($value == config('custom.category_status.show')) ? __('Show') : __('Hidden');
    }

    public function scopeIsShow($query)
    {
        return $query->where('status', config('custom.category_status.show'));
    }
}
