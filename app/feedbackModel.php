<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class feedbackModel extends Model
{
    protected $table ='tb_feedback';
    protected $filltable = [
        'id',
        'feedback',
        'username',
        'mail',
        'status'
    ];
}
