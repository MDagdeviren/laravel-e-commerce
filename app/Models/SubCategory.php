<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $fillable = ['name','category_id'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    } 
    
}
