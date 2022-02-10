<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'companie_id',
        'email',
        'phone',
        'password',
        'created_by_id',
        'updated_by_id'
    ];

    public function companie(){
        return $this->belongsTo(Companie::class);
    }
    
}
