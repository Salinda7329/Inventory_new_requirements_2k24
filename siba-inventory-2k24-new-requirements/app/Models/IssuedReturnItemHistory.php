<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IssuedReturnItemHistory extends Model
{
    use HasFactory;
	protected $fillable = [
        'request_id',
        'issue_or_return',
        'issue_remark',
        'issued_by',
        'issued_time_stamp',
        'return_remark',
        'received_by',
        'returned_time_stamp',
        'isactive',
    ];
}
