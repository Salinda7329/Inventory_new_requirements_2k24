<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Input extends Model
{
    use HasFactory;
    protected $fillable = [
        'po_id',
        'item_id',
        'count',
        'created_by',
        'isActive',
        'created_at',
        'updated_at'
        // ... other attributes
    ];

    public function getIsActiveInputttribute()
    {
        $status = [
            1 => 'Active',
            0 => 'Deactivated',
            3 => 'Deleted',
            // Add more roles as needed
        ];

        return $status[$this->attributes['isActive']] ?? 'Unknown Status';
    }

    public function createdByUser()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function getmainItemData()
    {
        return $this->belongsTo(ItemsNew::class, 'item_id', 'id');
    }
    public function getmainItemRef()
    {
        return $this->belongsTo(ItemsNew::class, 'item_id', 'id');
    }
    public function getPoData()
    {
        return $this->belongsTo(Porder::class, 'po_id', 'id');
    }
}
