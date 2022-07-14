@extends('layouts.master')

@section('title')
PROJECT - Danh sách Nhà Sản Xuất
@endsection

@section('body')
<style>
body {
  background-color:  #eee;
}
.title {

    margin-bottom: 50px;
    text-transform: uppercase;
}

.card-block {
    font-size: 1em;
    position: relative;
    margin: 0;
    padding: 1em;
    border: none;
    border-top: 1px solid rgba(34, 36, 38, .1);
    box-shadow: none;

}
.card {
    font-size: 1em;
    overflow: hidden;
    padding: 5;
    border: none;
    border-radius: .28571429rem;
    box-shadow: 0 1px 3px 0 #d4d4d5, 0 0 0 1px #d4d4d5;
    margin-top:20px;
}

.carousel-indicators li {
    border-radius: 12px;
    width: 12px;
    height: 12px;
    background-color: #404040;
}
.carousel-indicators li {
    border-radius: 12px;
    width: 12px;
    height: 12px;
    background-color: #404040;
}
.carousel-indicators .active {
    background-color: white;
    max-width: 12px;
    margin: 0 3px;
    height: 12px;
}
.carousel-control-prev-icon {
    background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23fff' viewBox='0 0 8 8'%3E%3Cpath d='M5.25 0l-4 4 4 4 1.5-1.5-2.5-2.5 2.5-2.5-1.5-1.5z'/%3E%3C/svg%3E") !important;
}

.carousel-control-next-icon {
    background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23fff' viewBox='0 0 8 8'%3E%3Cpath d='M2.75 0l-1.5 1.5 2.5 2.5-2.5 2.5 1.5 1.5 4-4-4-4z'/%3E%3C/svg%3E") !important;
}
    flex-direction: column;
}

.btn {
  margin-top: auto;
}
</style>
<div class="h-screen flex-grow-1 overflow-y-lg-auto" style="position: relative;">
    <!-- Header -->
    <header class="bg-surface-primary border-bottom pt-6" style="z-index: 1000;">
        <div class="container-fluid">
            <div class="mb-npx">
                <div class="row align-items-center">
                    <div class="col-sm-6 col-12 mb-1 mb-sm-0">
                        <!-- Title -->
                        <h1 class="h2 mb-0 ls-tight">@yield('title')</h1>
                    </div>
                    <div class="col-sm-6 col-12 text-sm-end">
                        <div class="mx-n1">
                            @unless(Auth::check())
                                <a href="{{Route('getLogin')}}" class="btn d-inline-flex btn-sm btn-primary mx-1">
                                    <span class=" pe-2">
                                        <i class="fa-solid fa-right-to-bracket"></i>
                                    </span>
                                    <span>Đăng nhập</span>
                                </a>
                                <a href="{{route('getRegister')}}" class=" btn d-inline-flex btn-sm btn-neutral border-base mx-1">
                                    <span class=" pe-2">
                                        <i class="fa-solid fa-user-plus"></i>
                                    </span>
                                    <span>Đăng ký</span>
                                </a>
                                @else
                                <a href="{{route('nsx.viewtaomoi')}}" class="btn d-inline-flex btn-sm btn-primary mx-1">
                                    <span class=" pe-2">
                                        <i class="fa-solid fa-file-circle-plus"></i>
                                    </span>
                                    <span>Tạo Nhà sản xuất mới</span>
                                </a>
                            @endunless
                        </div>
                    </div>

                </div>
                <div class="row align-items-center">
                    <div class="col-sm-6 col-12 text-sm-end">
                    {{$ds->links()}}
                    </div>
                    <div class="col-sm-6 col-12 text-sm-end" style="display: flex;justify-content: flex-end;">
                        <p class="pagination nav nav-tabs mt-4 overflow-x border-0">Hiện thị {{$ds->count()}} trong tổng số &nbsp; <b>{{\App\Models\NhaSanXuat::get()->count()}}</b> &nbsp; Nhà sản xuất hiện có</p>
                    </div>
            </div>
        </div>

    </header>



    <main class="py-6 bg-surface-secondary">
        @foreach($ds as $nsx)
        <section class="light">
            <div class="container py-2">
                <!-- Card Start -->
                <div class="card">
                    <div class="row ">

                        <div class="col-md-7 px-3">
                            <div class="card-block px-6">
                                <h4 class="card-title h3 mb-0" style="margin-bottom: 0.3rem;">{{$nsx->nsx_ten}} </h4>
                                <div class="row ">
                                    <p class="text-muted text-monospace text-sm-left">Thời điểm tạo mới : {{date('H:i:s d-m-Y',strtotime($nsx->nsx_taomoi))}}
                                    </p>
                                    <p class = "text-muted text-monospace text-sm-left">Cập nhật lần cuối : {{date('H:i:s d-m-Y',strtotime($nsx->nsx_capnhat))}}</p>
                                </div>
                                <hr style="margin: 0.5rem 0 0.5rem 0">
                                <p class="card-text">{{$nsx->nsx_mota}}</p>
                                <hr style="margin: 0.5rem 0 1rem 0">
                                <a href="{{route('nsx.xem',['id'=>$nsx->nsx_id])}}" class="mt-auto btn btn-primary m-lg-1">
                                    <i class="fa-brands fa-readme" style="margin-right: 0.5rem;"></i>Thông tin chi tiết
                                </a>
                                @auth
                                <a href= "{{route('nsx.viewsua',['id'=>$nsx->nsx_id])}}" class="mt-auto btn btn-secondary m-lg-1 ">
                                    <i class="fa-solid fa-pen-to-square" style="margin-right: 0.5rem;"></i>Sửa thông tin
                                </a>
                                <a href="" class="mt-auto btn btn-danger m-lg-1" onclick="event.preventDefault(); document.getElementById('delete-form-{{$nsx->nsx_id}}').submit();">
                                    <i class="fa-solid fa-trash" style="margin-right: 0.5rem;"></i>Xoá
                                </a>
                                <form id="delete-form-{{$nsx->nsx_id}}" action="{{route('nsx.xoa',['id'=>$nsx->nsx_id])}}" method="post" style="display:hidden">
                                    {{csrf_field()}}
                                </form>
                                @endauth
                            </div>
                        </div>
                            <!-- Carousel start -->
                        <div class="col-md-5">
                            <div id="CarouselTest" class="carousel slide" data-ride="carousel" style="height: 100%">
                                <div class="carousel-inner" style="height: 100%">
                                    <div class="carousel-item active" style="height: 100%">
                                        <img class="center-block mx-auto d-block" style="width: 100%; height: 100%;" src="{{$nsx->nsx_hinhanh}}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                            <!-- End of carousel -->
                    </div>
            </div>
        </section>
        @endforeach
                    <!-- End of card -->

</div>
@endsection
