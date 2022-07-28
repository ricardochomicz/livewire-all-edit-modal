<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function setNameAttribute($value)
    {
        return $this->attributes['name'] = mb_convert_case($value, MB_CASE_TITLE, 'UTF-8');
    }

}
