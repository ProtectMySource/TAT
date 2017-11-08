<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Species extends Model
{
  use Sortable;
  protected $table = 'species';
  protected $fillable = [
      'name'
  ];
  public $sortable = ['name'];
}
