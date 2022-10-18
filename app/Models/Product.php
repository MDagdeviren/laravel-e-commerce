<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name','price','sub_category_id','image'];

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }
}
