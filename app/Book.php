<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $guarded = [];

    public function user_book()
    {
    	return $this->hasOne(UserBook::class);
    }
}
