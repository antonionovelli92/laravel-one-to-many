<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'author', 'description', 'content', 'slug', 'image', 'url_project', 'url_generic', 'is_published', 'category_id'];


    // Assegno la relazione con le categorie
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
