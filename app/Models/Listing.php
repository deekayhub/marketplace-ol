<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    protected $fillable = [
        'user_id',
        'type',
        'title',
        'slug',
        'description',
        'category_id',
        'sub_category_id',
        'country_id',
        'state_id',
        'city_id',
        'area_id',
        'price',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }
    public function images()
    {
        return $this->hasMany(ListingImage::class);
    }
}
