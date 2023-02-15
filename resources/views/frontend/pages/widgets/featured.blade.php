<!-- featured-area start -->
<div class="featured-area featured-area2">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="featured-active2 owl-carousel next-prev-style">
                   @foreach ($categories as $category)
                    <div class="featured-wrap">
                        <div class="featured-img">
                            {{-- /*<img src="{{asset('uploads/category')}}/{{$category->category_image}}" alt=""> --}}
                            <img src="{{asset('assets/frontend/images/product/1.jpg')}}" alt="">
                            <div class="featured-content">
                                <a href="shop.html">{{$category->title}}</a>
                            </div>
                        </div>
                    </div>
                   @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!-- featured-area end -->
