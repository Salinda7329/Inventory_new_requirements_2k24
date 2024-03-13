<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warranty extends Model
{
    use HasFactory;
	protected $fillable = [
        'item_id',
        'description',
        'quantity',
        'document_link',
        'claim_status',
        'created_time',
        'finance_head_approval',
        'finance_head_time',
        'isactive',
    ];
}
