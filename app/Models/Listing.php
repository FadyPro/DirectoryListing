<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Listing extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = [];

    function category() {
        return $this->belongsTo(Category::class);
    }

    function location() {
        return $this->belongsTo(Location::class);
    }

    function user() {
        return $this->belongsTo(User::class);
    }

    function gallery() {
        return $this->hasMany(ListingImageGallery::class, 'listing_id', 'id');
    }

    function amenities() {
        return $this->hasMany(ListingAmenity::class, 'listing_id', 'id');
    }

    function videoGallery() {
        return $this->hasMany(ListingVideoGallery::class, 'listing_id', 'id');
    }

    function schedules() {
        return $this->hasMany(ListingSchedule::class, 'listing_id', 'id');
    }

    function reviews() {
        return $this->hasMany(Review::class);
    }
}
