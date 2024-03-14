<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Po extends Model
{
    use HasFactory;
    protected $fillable = [
        'po_no',
        'image',
        'created_by',
        'isActive',
        // ... other attributes
    ];
}
