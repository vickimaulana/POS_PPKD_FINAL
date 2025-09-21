<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        "category_name",
        "is_deleted",
    ];

    public function scopeNotDelete($query)
    {
        return $query->where('is_deleted', false);
    }
}
