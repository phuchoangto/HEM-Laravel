<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'description',
        'image',
    ];

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
