<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
	protected $fillable = [
        'brand_name',
        'created_by',
        'created_at',
        'updated_at',
        'isActive',
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

    public function getIsActiveBrandAttribute()
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
