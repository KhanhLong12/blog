@php
    use App\Helps\Template;
@endphp

@if(count($itemsListSlider) > 0)
     <div class="home_slider_container">
        <div class="owl-carousel owl-theme home_slider">
            <!-- Slide -->

            @foreach($itemsListSlider as $key => $val)
                @php
                    $category       = 'technology';
                    $name           = $val['name'];
                    $description    = $val['description'];
                    $thumb          = Template::showThumbNews($val->thumb, $val->name);
                @endphp

                <div class="owl-item home_slider_item">
                    {!! $thumb !!}
                    <div class="home_slider_content text-center">
                        <div class="home_slider_content_inner" data-animation-in="fadeIn"
                             data-animation-out="animate-out fadeOut">
                            <div class="home_category"><a href="category.html">{!! $category !!}</a></div>
                            <div class="home_title">{!! $name  !!}</div>
                            <div class="home_text">{!! $description  !!}
                            </div>
                            <div class="home_button trans_200"><a href="#">read more</a></div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        @if(count($itemsListSlider) > 1)
        <!-- Home Slider Navigation -->
            <div class="home_slider_nav home_slider_prev trans_200"><i class="fa fa-angle-left trans_200"
                                                                       aria-hidden="true"></i></div>
            <div class="home_slider_nav home_slider_next trans_200"><i class="fa fa-angle-right trans_200"
                                                                       aria-hidden="true"></i></div>
        @endif
    </div>
@endif