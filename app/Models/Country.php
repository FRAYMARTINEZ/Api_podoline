<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{

    protected $table = 'countries';

    protected $fillable = ['name', 'iso_2','iso_3','iso_number','phone_code'];

    public function departments()
    {
        return $this->hasMany(Department::class);
    }
}
