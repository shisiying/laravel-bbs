<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chapter extends Model
{
    use SoftDeletes;

    /**
     * 需要被转换成日期的属性。
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function note(){
        return $this->belongsTo('App\Models\Note');
    }
    public function articles()
    {
        return $this->hasMany('App\Models\Article');
    }
}
