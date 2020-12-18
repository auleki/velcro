<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Met extends Model
{
  protected $table = 'met';
  public $timestamps = true;

  protected $fillable = [
  'name', 'name1'
  ];
}
