<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
  protected $table = 'comments';
  protected $fillable = [
      'book_id', 'user_id', 'date','content'
  ];
}
