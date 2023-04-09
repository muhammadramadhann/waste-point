<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class GroceriesTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'nanoid',
        'user_id',
        'groceries_id',
        'quantity',
        'total_points',
        'note',
        'status',
        'invoice_number',
        'rating',
        'feedback'
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function groceries()
    {
        return $this->belongsTo(Groceries::class, 'groceries_id');
    }

    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->translatedFormat('l, j F Y - H:i');
    }
}
