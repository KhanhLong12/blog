@extends('new.main')
@section('content')
<div class="container">
            <div class="row">
                <!-- Main Content -->
                <div class="col-lg-9">
                    @include('new.pages.home.child-content.category')
                </div>
                <!-- Sidebar -->
                <div class="col-lg-3">
                    <div class="sidebar">
                        <!-- Latest Posts -->
                        @include('new.pages.home.component.recentPosts')
                        <!-- Advertisement -->
                        <!-- Extra -->
                        @include('new.pages.home.component.extra')
                        <!-- Most Viewed -->
                        @include('new.pages.home.component.mostViews')
                        <!-- Tags -->
                        @include('new.pages.home.component.tags')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection