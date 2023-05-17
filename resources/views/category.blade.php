@extends("layouts.layout")
@section("title",$category->name)
@section("main")
    <div class="row">
        <div class="col-lg-3 col-md-5">
            @include("html.home.sidebar")
        </div>
        <div class="col-lg-9 col-md-7">
            <div class="filter__item">
                <div class="row">
                    <div class="col-lg-4 col-md-5">
                        <div class="filter__sort">
                            <span>Show: </span>
                            <a href="{{url()->full()."&limit=12"}}">12 </a> |
                            <a href="{{url()->full()."&limit=18"}}">18</a> products
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="filter__found">
                            <h6><span>{{$products->total()}}</span> Products found</h6>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-3">
                        <div class="filter__option">
                            <span class="icon_grid-2x2"></span>
                            <span class="icon_ul"></span>
                        </div>
                    </div>
                </div>
            </div>
            @include("html.home.grid")
        </div>
    </div>
@endsection
