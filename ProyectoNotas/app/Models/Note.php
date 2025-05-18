<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'content', 'tipo', 'is_important', 'user_id', 'id_category'];

      // Define the relationship to Category
      public function category()
      {
          return $this->belongsTo(Category::class, 'id_category');  // Use 'id_category' if it's not the default 'category_id'
      }
      public function user()
        {
            return $this->belongsTo(\App\Models\User::class, 'user_id');
        }
}
