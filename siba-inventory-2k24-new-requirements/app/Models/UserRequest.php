<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRequest extends Model
{
    use HasFactory;
	protected $fillable = [
        'product_id',
        'quantity',
        'user_id',
        'requested_time',
        'department_head_approval',
        'department_head_id',
        'department_head_time',
        'isactive',
    ];
}
