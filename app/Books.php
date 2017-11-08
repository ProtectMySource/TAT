<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Books extends Model
{
  use Sortable;
  protected $table = 'books';
  protected $fillable = [
      'name', 'author', 'preview','date','content','view','like','categories_id','species_id'
  ];
  public $sortable = ['name', 'author', 'preview','date','content','view','like','categories_id','species_id'];
  public function categories(){
    return $this->hasOne('App\Categories','id','categories_id');
  }
  public function customer(){
    return $this->hasOne('App\Customers','id','author');
  }
  public function chap(){
    return $this->hasMany('App\Chaps','book_id','id');
  }
}
