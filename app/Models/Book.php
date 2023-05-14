<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function library()
    {
        return $this->belongsTo(Library::class);
    }

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

}
