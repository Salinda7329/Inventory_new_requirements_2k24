<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    use HasFactory;
    protected $fillable = [
        'item_id',
        'count',
        'issued_to',
        'issue_remark',
        'issued_by',
        'isActive',
        // ... other attributes
    ];
}
