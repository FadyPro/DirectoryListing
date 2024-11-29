<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListingAmenity extends Model
{
    use HasFactory;

    function amenity()  {
        return $this->belongsTo(Amenity::class, 'amenity_id', 'id');
    }
}
