@extends($layout)

@section('title', 'Dashboard')

@section('header')
    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
        <!--begin::Title-->
        <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Dashboard</h1>
        <!--end::Title-->
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
            <li class="breadcrumb-item text-muted">Dashboard</li>
            {{-- <li class="breadcrumb-item">
                <span class="bullet bg-gray-400 w-5px h-2px"></span>
            </li> --}}
        </ul>
        <!--end::Breadcrumb-->
    </div>
@stop

@section('content')
<div class="card card-flush card-p-0 bg-transparent border-0">
    <!--begin::Body-->
    <div class="card-body">
        <!--begin::Wrapper-->
        <div class="d-flex d-grid row">
            @foreach (App\Helpers\MenuHelper::menu() as $menu)
                @if (isset($menu['submenu']))
                    <h1 class="my-4 display-5"># {{ $menu['text'] }}</h1>
                    @foreach ($menu['submenu'] as $submenu)

                        <!--begin:Menu item-->
                        <a href="{{ route($submenu['route']) }}" class="col-md-3 p-5">
                            <!--begin::Card-->   
                            <div class="card card-flush p-4 pb-5">
                                <!--begin::Body-->
                                <div class="card-body text-center">
                                    <!--begin::Food img-->
                                    <img src="assets/media/stock/food/img-2.jpg" class="rounded-3 mb-4 w-150px h-150px w-xxl-200px h-xxl-200px" alt="">
                                    <!--end::Food img-->
                                    <div class="mb-1">
                                        <!--begin::Name-->
                                        <span class="text-dark text-end fw-bold fs-1">{{ $submenu['text'] }}</span>
                                        <!--end::Name-->
                                    </div>
                                    @if(isset($submenu['description']))
                                        <!--begin::Info-->
                                        <div class="mb-2">
                                            <!--begin::Title-->
                                            <div class="text-center">
                                                <span class="fw-bold text-gray-800 cursor-pointer text-hover-primary fs-3 fs-xl-1">{{ $submenu['description'] }}</span>
                                            </div>
                                            <!--end::Title-->
                                        </div>
                                        <!--end::Info-->
                                    @endif
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Card-->
                        </a>
                        <!--emd:Menu item-->
                    @endforeach
                @else
                    <!--begin:Menu item-->
                    <a href="{{ route($menu['route']) }}" class="col-md-3 p-5">
                        <!--begin::Card-->   
                        <div class="card card-flush p-4 pb-5">
                            <!--begin::Body-->
                            <div class="card-body text-center">
                                <!--begin::Food img-->
                                <img src="assets/media/stock/food/img-2.jpg" class="rounded-3 mb-4 w-150px h-150px w-xxl-200px h-xxl-200px" alt="">
                                <!--end::Food img-->
                                <div class="mb-1">
                                    <!--begin::Name-->
                                    <span class="text-dark text-end fw-bold fs-1">{{ $menu['text'] }}</span>
                                    <!--end::Name-->
                                </div>
                                @if(isset($menu['description']))
                                    <!--begin::Info-->
                                    <div class="mb-2">
                                        <!--begin::Title-->
                                        <div class="text-center">
                                            <span class="fw-bold text-gray-800 cursor-pointer text-hover-primary fs-3 fs-xl-1">{{ $menu['description'] }}</span>
                                        </div>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Info-->
                                @endif
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Card-->
                    </a>
                    <!--end:Menu item-->
                @endif
            @endforeach
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end: Card Body-->
</div>
@stop
