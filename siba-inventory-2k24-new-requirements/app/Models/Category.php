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
            1 =>'Active',
            2 => 'Deactivated',
            3 => 'Deleted',
            // Add more roles as needed
        ];

        return $status[$this->attributes['isActive']] ?? 'Unknown Status';
    }
}
