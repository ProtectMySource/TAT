<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use App\Subs;
use App\Comments;
use App\Books;

class Customers extends Model
{
  use Sortable;
  protected $table = 'customers';
  protected $fillable = [
      'name', 'email', 'password','password2','dob','avatar'
  ];
  public $sortable = ['name', 'email', 'password','password2','dob','avatar'];

  public function subs(){
    return $this->hasMany('App\Subs','customer_id','id');
  }

  public function comments(){
    return $this->hasMany('App\Comments','customer_id','id');
  }

  public function books(){
    return $this->hasMany('App\Books','customer_id','id');
  }

}
