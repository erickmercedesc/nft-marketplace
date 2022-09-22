<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'txId',
        'data'
    ];

    public function User() {
        return $this->belongsTo(User::class)->withTrashed();
    }

}
