<footer class="footer">
    <div class="container">
        <div class="row footer-top">

            <div class="col-sm-5 col-lg-5">

                <p class="padding-top-xsm">我们是高品质的分享社区，致力于为论坛用户提供一个分享创造、结识伙伴、协同互助的平台。</p>


                <br>
                <span style="font-size:0.9em">
                  Powered by <a href="https://xhzyxed.cn" target="_blank" style="color:inherit">sevenshi</a>
              </span><br>
                <span style="font-size:0.9em">
                  Designed by <span style="color: #e27575;font-size: 14px;">❤</span> <a href="https://github.com/summerblue" target="_blank" style="color:inherit">Seven</a>
              </span>
            </div>

            <div class="col-sm-6 col-lg-6 col-lg-offset-1">

                <div class="row">
                    <div class="col-sm-4">
                        <h4>赞助商</h4>
                        <ul class="list-unstyled">
                            @if(isset($banners['footer-sponsor']))
                                @foreach($banners['footer-sponsor'] as $banner)
                                    <a href="{{ $banner->link }}" target="_blank"><img src="{{ $banner->image_url }}" class="popover-with-html footer-sponsor-link" width="98" data-placement="top" data-content="{{ $banner->title }}"></a>
                                @endforeach
                            @endif
                        </ul>
                    </div>

                    <div class="col-sm-4">
                        <h4>备案信息</h4>
                        <ul class="list-unstyled">
                            <li> </li>
                            <li> </li>
                            <li> </li>
                        </ul>
                    </div>
                    <div class="col-sm-4">
                        <h4>其他信息</h4>
                        <ul class="list-unstyled">
                            <li><a href="/about"><i class="fa fa-info-circle" aria-hidden="true"></i> 关于我们</a></li>
                        </ul>
                    </div>

                </div>

            </div>
        </div>
        <br>
        <br>
</footer>