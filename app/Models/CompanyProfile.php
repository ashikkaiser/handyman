<?php

namespace App\Models;

use App\Geographical\Geographical;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyProfile extends Model
{
    use HasFactory, Geographical;

    protected $dates = ['created_at', 'updated_at', 'expiry_date', 'payment_date'];
    const LATITUDE  = 'business_latitude';
    const LONGITUDE = 'business_longitude';


    public function ScopeApproved($query)
    {
        return $query->where('is_active', true);
    }

    public function ScopePending($query)
    {
        return $query->where('is_active', false);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'company_id');
    }
    public function packages()
    {
        return $this->belongsTo(Package::class, 'package_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->hasMany(Category::class, 'id', 'business_category');
    }
}
