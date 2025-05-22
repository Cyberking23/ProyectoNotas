<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    use HasFactory;
    protected  $primaryKey = 'id';
    protected $fillable = [
        'note_id',
        'remind_at',
        'name',
        'sent',
        'activo',
    ];

   public function note()
    {
        return $this->belongsTo(\App\Models\Note::class, 'note_id');
    }
}