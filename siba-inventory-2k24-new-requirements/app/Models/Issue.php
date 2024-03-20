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

    public function itemName()
    {
        return $this->belongsTo(ItemsNew::class, 'item_id', 'id');
    }
    public function toDepartment()
    {
        return $this->belongsTo(Department::class, 'issued_to', 'id');
    }

    public function issueduserData()
    {
        return $this->belongsTo(User::class, 'issued_by', 'id');
    }
}
