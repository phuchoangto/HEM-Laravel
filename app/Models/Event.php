<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'description',
        'start_at',
        'end_at',
        'location',
        'image',
        'faculty_id',
    ];

    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_event', 'event_id', 'student_id');
    }

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }
}
