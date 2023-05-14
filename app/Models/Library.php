<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Library extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function books()
    {
        return $this->hasMany(Book::class);
    }

    public function loaned()
    {
        return $this->hasMany(Book::class)->where('loaned', true);
    }

    public function inStock()
    {
        return $this->hasMany(Book::class)->where('loaned', false);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
