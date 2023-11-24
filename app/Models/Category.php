<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'type_id'];

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function type()
    {
       return $this->belongsTo(Type::class);
    }
}
