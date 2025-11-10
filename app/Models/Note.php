<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = ['model_type','model_id','note'];

    public function model()
    {
        return $this->morphTo(null, 'model_type', 'model_id');
    }
}
