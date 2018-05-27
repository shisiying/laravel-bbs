<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cache;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;


class Link extends Model
{
    use SoftDeletes;
    // For admin log
    use RevisionableTrait;
    protected $keepRevisionOf = [
        'deleted_at'
    ];

    protected $fillable = ['title','link','position','order','image_url','target','description'];

    public $cache_key = 'larabbs_links';

    public $ad_cache_key = 'xhz-xed_links';

    protected $cache_expire_in_minutes =1440;

    public function getAllCached()
    {
        return Cache::remember($this->cache_key,$this->cache_expire_in_minutes,function(){
            return $this->all();
        });
    }

    public  function allByPosition()
    {
        Cache::forget($this->ad_cache_key);

        $data = Cache::remember($this->ad_cache_key,$this->cache_expire_in_minutes,function(){
            $return = [];
            $data   = Link::orderBy('position', 'DESC')
                ->orderBy('order', 'ASC')
                ->get();

            foreach ($data as $banner) {
                $return[$banner->position][] = $banner;
            }
            return $return;
        });
        return $data;
    }
}
