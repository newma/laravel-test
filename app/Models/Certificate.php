<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Certificate extends Model
{
//    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'stream_name','property_id','issue_date','next_due_date'
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function notes()
    {
        return $this->morphMany(Note::class, 'model', 'model_type', 'model_id')
            ->where('model_type', 'Certificate');
    }
}
