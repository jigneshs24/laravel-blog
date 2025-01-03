<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Sofa\Eloquence\Eloquence;

class Blog extends Model
{
    use Eloquence;

    const ACTIVE = 1, IN_ACTIVE = 2;

    protected $fillable = [
        'admin_id', 'category_id', 'title', 'banner_image', 'short_description', 'description', 'keywords', 'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(BlogCategory::class);
    }

}
