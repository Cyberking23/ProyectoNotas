<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    use HasFactory;

    protected $fillable = [
        'note_id',
        'remind_at',
        'name',
        'activo',
    ];

    public function note()
    {
        return $this->belongsTo(Note::class);
    }
}