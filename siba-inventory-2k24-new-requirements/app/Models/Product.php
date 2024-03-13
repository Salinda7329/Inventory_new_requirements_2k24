<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'po_no',
        'category_id',
        'lower_limit',
        'product_name',
        'created_by',
        'isActive',
        // ... other attributes
    ];

    /**
     * A description of the createdByUser PHP function.
     *
     * @return BelongsTo
     */
    public function createdByUser()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
    public function categoryData()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function getIsActiveProductAttribute()
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
