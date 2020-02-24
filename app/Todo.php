<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Todo extends Model
{
    protected $fillable = ['task'];

    protected $guarded = ['deleted_at'];

    use SoftDeletes;
}
