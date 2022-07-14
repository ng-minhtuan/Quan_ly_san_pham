@extends('layouts.master')

@section('title')
PROJECT - Danh sách Nhà Sản Xuất
@endsection

@section('body')
<style>

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
                                <a href="{{route('sp.viewthem')}}" class="btn d-inline-flex btn-sm btn-primary mx-1">
                                    <span class=" pe-2">
                                        <i class="fa-solid fa-file-circle-plus"></i>
                                    </span>
                                    <span>Thêm sản phẩm mới</span>
                                </a>
                            @endunless
                        </div>
                    </div>

                </div>
                <div class="row align-items-center">
                    <div class="col-sm-6 col-12 text-sm-end">
                        {{$ds->links()}}
                    </div>
                </div>
        </div>

    </header>



    <main class="py-lg-5 bg-surface-secondary" style="display:flex;">

        <div class="container" style="display:flex; flex-wrap: wrap;">
            @foreach($ds as $san_pham)
            <div class="card mx-auto col-md-3 col-10 mt-5" style="width:30%; margin: 0 5rem;">
                <img class='mx-auto img-thumbnail'
                    src="{{Storage::url($san_pham->sp_hinhanh)}}"
                    width="auto" height="auto"/>
                <div class="card-body text-left mx-auto">
                    <div class=''>
                        <h5 class="card-title font-weight-bold">{{$san_pham->sp_ten}}</h5>
                        <p class="card-text"><b>Giá : </b>{{$san_pham->sp_gia}}</p>
                        <hr>
                        <a href="{{route('sp.xem',['id'=>$san_pham->sp_id])}}" class="mt-auto btn btn-primary m-lg-1" style="width: 100%;">
                            <i class="fa-brands fa-readme" style="margin-right: 0.5rem;"></i>Thông tin chi tiết
                        </a>
                        @auth
                        <a href= "{{route('sp.viewsua',['id'=>$san_pham->sp_id])}}" class="mt-auto btn btn-secondary m-lg-1 " style="width: 100%;">
                            <i class="fa-solid fa-pen-to-square" style="margin-right: 0.5rem;"></i>Sửa thông tin
                        </a>
                        <a href="" class="mt-auto btn btn-danger m-lg-1" onclick="event.preventDefault(); document.getElementById('delete-form-{{$san_pham->sp_id}}').submit();" style="width: 100%;">
                            <i class="fa-solid fa-trash" style="margin-right: 0.5rem;"></i>Xoá
                        </a>
                        <form id="delete-form-{{$san_pham->sp_id}}" action="{{route('sp.xoa',['id'=>$san_pham->sp_id])}}" method="post" style="display:hidden">
                            {{csrf_field()}}
                        </form>
                        @endauth
                    </div>
                </div>
            </div>
            @endforeach
        </div>

</div>
@endsection
