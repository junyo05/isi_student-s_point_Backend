<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Filieres extends Model
{
    //
    protected $fillable = ['nom'];

    public function classes() {
        return $this->hasMany(Classes::class, 'filieres_id');
    }

}
