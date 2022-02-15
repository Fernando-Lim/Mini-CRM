<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Companie extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'logo',
        'website',
        'created_by_id',
        'updated_by_id'
    ];

    public function employees(){
        return $this->hasMany(Employee::class);
    }
}
