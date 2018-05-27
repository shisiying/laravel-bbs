<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{
    use SoftDeletes;

    protected $fillable = ['name','description','cover','is_recommended'];
    protected $dates = ['deleted_at'];


    public function chapters()
    {
        return $this->hasMany('App\Models\Chapter');
    }
}
