<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compose extends Model
{
  protected $fillable = [
      'title', 'subject', 'btn1', 'body'
  ];
}
