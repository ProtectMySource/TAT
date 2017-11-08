<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Customers extends Model
{
  use Sortable;
  protected $table = 'customers';
  protected $fillable = [
      'name', 'email', 'password','password2','dob','avatar'
  ];
  public $sortable = ['name', 'email', 'password','password2','dob','avatar'];

}
