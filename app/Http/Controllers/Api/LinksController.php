<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Transformers\LinkTransformer;
use App\Models\Link;

class LinksController extends Controller
{
    public function index(Link $link)
    {
        $links = $link->getAllCached();
        return $this->response->collection($links,new LinkTransformer());
    }
}
