<?php

namespace App\Models;

use App\Http\Controllers\ItemsController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;
    protected $fillable = [
        'item_user',
        'quantity_user',
        'user_remark',
        'request_by',
        'requested_timestamp',
        'type',
        'status',
        'item_id',
        'flag_request',
        'flag_return',
        'quantity',
        'sm_remark',
        'store_manager',
        'store_manager_timestamp',
        'isActive',
    ];

    public function getTypeRequestAttribute()
    {
        $status = [
            1 => 'Request',
            2 => 'Return',
            // Add more roles as needed
        ];

        return $status[$this->attributes['type']] ?? 'Unknown Status';
    }

    public function requestedByUser()
    {
        return $this->belongsTo(User::class, 'request_by', 'id');
    }

    public function getItemById()
    {
        return $this->belongsTo(Item::class, 'item_user', 'id');
    }

    public function getItemNameById()
    {
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }


    public function storeManagerAttributes()
    {
        return $this->belongsTo(User::class, 'store_manager', 'id');
    }

    public function getStatusRequestAttribute()
    {
        $status = [
            0 => '<span style="color: orange;">user_request</span>',
            1 => '<span style="color: blue;">sm_processing</span>',
            2 => '<span style="color: green;">sm_accepted</span>',
            3 => '<span style="color: red;">sm_rejected</span>',
            // Add more roles as needed
        ];

        return $status[$this->attributes['status']] ?? 'Unknown Status';
    }
    public function getRequestProcessAttribute()
    {
        $status = [
            0 => 'Process',
            1 => 'Processing',
            2 => 'Processed',
            3 => 'Processed',
            // Add more roles as needed
        ];

        return $status[$this->attributes['status']] ?? 'Unknown Status';
    }

}
