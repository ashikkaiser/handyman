<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected static function boot()
    {
        parent::boot();

        // static::addGlobalScope('active', function ($builder) {
        //     $builder->where('published', true);
        // });
    }



    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function company()
    {
        return $this->belongsTo(CompanyProfile::class, 'company_id');
    }
    public function  subcategory()
    {
        return $this->belongsTo(Category::class, 'subcategory_id');
    }
    public function  category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
