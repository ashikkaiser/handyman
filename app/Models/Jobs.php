<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jobs extends Model
{
    use HasFactory;
    // protected static function boot()
    // {
    //     parent::boot();
    //     static::addGlobalScope('active', function ($builder) {
    //         $builder->where('status', 'active');
    //     });
    // }



    public function  subcategory()
    {
        return $this->belongsTo(Category::class, 'subcategory_id');
    }
    public function  category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function company()
    {
        return $this->belongsTo(CompanyProfile::class, 'company_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function applied()
    {
        return $this->hasMany(AppliedJob::class, 'job_id');
    }
}
