<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
  protected $fillable = [
      'TextAnswer','posts','post_id','votes', 'created_at'
  ];


}
