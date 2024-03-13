<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = [
        'po_no',
        'product_id',
        'brand_id',
        'item_name',
        'condition',
        'condition_updated_by',
        'condition_updated_timestamp',
        'items_remaining',
        'lower_limit',
        'owner',
        'created_by',
        'isActive',
        'created_time_stamp',
    ];

    public function createdByUser()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
    public function conditionUpdatedByUser()
    {
        return $this->belongsTo(User::class, 'condition_updated_by', 'id');
    }
    public function ownerUser()
    {
        return $this->belongsTo(User::class, 'owner', 'id');
    }
    public function categoryData()
    {
        return $this->belongsTo(Product::class, 'product_id')->select('id', 'product_name', 'category_id');
    }

    public function productData()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function brandData()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }


    public function getIsCondtionItemAttribute()
    {
        $status = [
            1 => '<span style="color: green;">Working</span>',
            2 => '<span style="color: red;">Damaged</span>',
            // Add more styles as needed
        ];

        return $status[$this->attributes['condition']] ?? '<span style="color: gray;">Unknown Status</span>';
    }


    public function getIsAvailabilityAttribute()
    {
        $status = [
            0 => '<span style="color: red;">Not-Available</span>',
            1 => '<span style="color: green;">Available</span>',
            // Add more roles as needed
        ];

        return $status[$this->attributes['availability']] ?? 'Unknown Status';
    }

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
}
