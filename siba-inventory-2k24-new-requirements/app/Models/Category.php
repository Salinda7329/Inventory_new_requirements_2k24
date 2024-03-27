<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_name',
        'created_by',
        'created_at',
        'updated_at',
        'isActive',
    ];

    public function createdByUser()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function getIsActiveCategoryAttribute()
    {
        $status = [
            1 => '<span style="color: green;">Active</span>',
            2 => '<span style="color: red;">Deactivated</span>',
            3 => '<span style="color: red;">Deleted</span>',
            // Add more roles as needed
        ];

        return $status[$this->attributes['isActive']] ?? 'Unknown Status';
    }
}
