@php
use App\Models\CategoryModel as CategoryModel;

    $categoryModel = new CategoryModel();
    $listCategory  =  $categoryModel->listItems(null,['task' => 'news_list_Category']);
    $xhtmlMenu = null;
    $xhtmlMenu = sprintf('<ul class="main_nav_list d-flex flex-row align-items-center justify-content-start">');
    foreach ($listCategory as $value) {
        $xhtmlMenu .= sprintf('<li class="menu_mm"><a href="#">%s</a></li>', $value['name']);
    }

    $xhtmlMenu .= sprintf('</ul>');
@endphp
<div class="header_content_container">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="header_content d-flex flex-row align-items-center justfy-content-start">
                    <div class="logo_container">
                        <a href="#">
                            <div class="logo"><span>ZEND</span>VN</div>
                        </a>
                    </div>
                    <div class="header_extra ml-auto d-flex flex-row align-items-center justify-content-start">
                        <a href="#">
                            <img class="background_image" src="{{ asset('user/images/zendvn-online.png') }}">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Header Navigation & Search -->
<div class="header_nav_container" id="header">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="header_nav_content d-flex flex-row align-items-center justify-content-start">
                    <!-- Logo -->
                    <div class="logo_container">
                        <a href="#">
                            <div class="logo"><span>ZEND</span>VN</div>
                        </a>
                    </div>
                    <!-- Navigation -->
                    <nav class="main_nav">
                            {!! $xhtmlMenu !!}
                    </nav>
                    <!-- Hamburger -->
                    <div class="hamburger ml-auto menu_mm"><i class="fa fa-bars  trans_200 menu_mm"
                                                              aria-hidden="true"></i></div>
                </div>
            </div>
        </div>
    </div>
</div>