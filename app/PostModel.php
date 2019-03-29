<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostModel extends Model
{
    protected $table = "tb_post";
    public $timestamps = false;
}
