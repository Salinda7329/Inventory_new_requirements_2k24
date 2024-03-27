<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemsNew extends Model
{
    use HasFactory;
    use HasFactory;
    protected $fillable = [
        'item_name',
        'item_ref',
        'category_id',
        'items_remaining',
        'lower_limit',
        'item_price',
        'created_by',
        'isActive'
    ];

    public function getIsActiveItemAttribute()
    {
        $status = [
            1 => '<span style="color: green;">Active</span>',
            2 => '<span style="color: red;">Deactivated</span>',
            3 => '<span style="color: red;">Deleted</span>',
            // Add more roles as needed
        ];

        return $status[$this->attributes['isActive']] ?? 'Unknown Status';
    }

    public function getIsActiveItemAttributeBlade()
    {
        $status = [
            1 => '<span style="color: green;">Active</span>',
            2 => '<span style="color: red;">Deactivated</span>',
            3 => '<span style="color: red;">Deleted</span>',
            // Add more statuses as needed
        ];

        return $status[$this->isActive] ?? 'Unknown';
    }

    public function categoryData()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function createdByUser()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function lastStockInput()
    {
        return $this->belongsTo(Input::class, 'id', 'item_id');
    }

    public function lastStockInputPo()
    {
        return $this->belongsTo(Input::class, 'id', 'item_id');
    }
}
