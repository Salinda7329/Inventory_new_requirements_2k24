<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grn extends Model
{
    use HasFactory;

    protected $fillable = [
        'requested_by',
        'good_receiving_note_number',
        'company',
        'item_to_be_used_location',
        'handed_over_by',
        'handed_over_date',
        'received_by',
        'received_date',
    ];
}
