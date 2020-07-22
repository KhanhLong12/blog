<div class="main_content">
    <!-- Featured -->
    <div class="featured">
        <!-- Featured Title -->
        @include('new.pages.home.component.featured_title')
    </div>
    <!-- Category -->
        @foreach($itemsListCategoryIndex as $key => $value)
            @if($value['display'] == 'list')
                @include('new.pages.home.child-content.category_list')
            @elseif($value['display'] == 'grid')
                @include('new.pages.home.child-content.category_grid')
            @endif
        @endforeach
</div>