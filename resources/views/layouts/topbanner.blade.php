
<div class="row grid topbanner">
    @if(isset($banners['website_top']))
        @foreach($banners['website_top'] as $banner)
            <div class="col-md-3 col-sm-6 col-xs-6 projects-card grid-item">
              <div class="thumbnail" >
                  <a href="@if($banner->link){{$banner->link}}@else javascript:; @endif" class="no-pjax">
                      @if (empty($banner->qiniu_img_url))
                                <img src="https://dn-phphub.qbox.me/uploads/banners/EptWCkT1qDDvtn5nV2id.png?imageView2/1/w/424/h/212" />
                       @else
                                <img src="{{$banner->qiniu_img_url}}?imageView2/1/w/424/h/212"/>
                      @endif
                  </a>
                <div class="caption">
                  <h3 style="font-size:1.1em;font-weight:bord" class="card-title"><a href="@if($banner->link){{$banner->link}}@else javascript:; @endif" class="no-pjax">{{$banner->title}}</a></h3>
                  <p class="card-description hidden-xs">{{$banner->description}}</p>
                </div>
              </div>
            </div>
        @endforeach
    @endif
</div>
