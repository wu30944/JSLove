<!--/gallery-->
<div class="gallery" id="gallery">
    <div class="container">
        <div class="gallery-main">
            <div class="gallery-top">
                @foreach($GalleryPhoto as $Index=>$item)
                <div class="gallery-top-img portfolio-grids">
                    <a href="{{$item->photo_path}}" class="b-link-stripe b-animate-go lightninBox" data-lb-group="1">
                        <img src="{{$item->photo_path}}" class="img-responsive" alt="" />
                        <div class="p-mask">
                            <h4><span>Heading here</span></h4>
                        </div>
                    </a>
                </div>
                @endforeach
                <div class="gallery-top-img">
                    <h3>{{$Gallery->title}}</h3>
                    <span> </span>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="gallery-bottom">
                <div class="col-md-6">
                    {!! $Gallery->content !!}
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
<!--//gallery-->