<?php

namespace App\Models;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Item;

class Sell extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'item_id',
        'price',
        'discount',
        'employee_id'
    ];
    public $timestamps = false;
    public function employee(){
        return $this->belongsTo(Employee::class);
    }

    public function item(){
        return $this->belongsTo(Item::class);
    }
    
}
