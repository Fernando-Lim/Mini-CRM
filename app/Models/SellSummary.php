<?php

namespace App\Models;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Item;

class SellSummary extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'employee_id',
        'price_total',
        'discount_total',
        'total'
    ];

    public function employee(){
        return $this->belongsTo(Employee::class);
    }
    public function sell(){
        return $this->belongsTo(Sell::class);
    }
    public function companie(){
        return $this->belongsTo(Companie::class);
    }

}
