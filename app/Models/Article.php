<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Article extends Model
{
    use SoftDeletes;
    protected $fillable = ['body','title','chapter_id','link','type','author','user_id'];
    protected $dates = ['deleted_at'];

    public function chapter(){
        return $this->belongsTo('App\Models\Chapter');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');

    }

}
