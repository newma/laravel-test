<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Property extends Model
{
//    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'organisation','property_type','parent_property_id','uprn',
        'address','town','postcode','live'
    ];

    public function parent()
    {
        return $this->belongsTo(Property::class, 'parent_property_id');
    }

    public function children()
    {
        return $this->hasMany(Property::class, 'parent_property_id');
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }

    public function notes()
    {
        // polymorphic-ish via model_type/model_id
        return $this->morphMany(Note::class, 'model', 'model_type', 'model_id')
            ->where('model_type', 'Property');
    }
}

