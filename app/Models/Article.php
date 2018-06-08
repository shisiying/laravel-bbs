<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;


class Article extends Model
{
    use Searchable;
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

    /**
     * 索引的字段
     *
     * @return array
     */
    public function toSearchableArray()
    {
        return $this->only('id', 'title', 'body');
    }

}
