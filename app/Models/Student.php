<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'surname','birthday', 'address', 'phone', 'city_id', 'grupe_id'];

    // Susiejimas su miestu
    public function city()
    {
        return $this->belongsTo(City::class);
    }
    // Susiejimas su grupe
    public function grupe()
    {
        return $this->belongsTo(Grupe::class);
    }
}
