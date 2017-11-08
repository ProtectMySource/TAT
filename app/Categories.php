<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Categories extends Model
{
  use Sortable;
  protected $table = 'categories';
  protected $fillable = [
      'name'
  ];
  public $sortable = ['name'];
}
