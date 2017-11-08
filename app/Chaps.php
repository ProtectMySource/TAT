<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chaps extends Model
{
  protected $table = 'chaps';
  protected $fillable = [
      'books_id','date','content'
  ];
}
