<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Sofa\Eloquence\Eloquence;

class BlogCategory extends Model
{
    use Eloquence;

    const  ACTIVE = 1, IN_ACTIVE = 2;

    protected $fillable = [
        'admin_id', 'name', 'description', 'status'
    ];

    public function scopeActive($q)
    {
        $q->where('status', self::ACTIVE);
    }

    public function admin()
    {
        return $this->belongsTo(User::class);
    }

}
