<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subs extends Model
{
  protected $table = 'subs';
  protected $fillable = [
      'book_id', 'user_id'
  ];
}
