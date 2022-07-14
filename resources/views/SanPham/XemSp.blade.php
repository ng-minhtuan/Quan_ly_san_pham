@extends('layouts.master')
@section('title')
PROJECT - Thông tin Sản phẩm
@endsection
@section('body')
<div class="h-screen flex-grow-1 overflow-y-lg-auto" style="position: relative;">
    <!-- Header -->
    <header class="bg-surface-primary border-bottom pt-6" style="z-index: 1000;padding-bottom: 1rem;">
        <div class="container-fluid">
            <div class="mb-npx">
                <div class="row align-items-center">
                    <div class="col-sm-6 col-12 mb-1 mb-sm-0">
                        <!-- Title -->
                        <h1 class="h2 mb-0 ls-tight">@yield('title')</h1>
                    </div>

                    <!-- Actions -->

                    <div class="col-sm-6 col-12 text-sm-end">
                        <div class="mx-n1">
                            @auth
                                <a href={{route('sp.viewsua',['id'=>$sp->sp_id])}}" class="btn d-inline-flex btn-sm btn-neutral border-base mx-1">
                                    <span class=" pe-2"> <i class="bi bi-pencil"></i> </span>
                                    <span>Sửa thông tin</span>
                                </a>
                                <a href="{{route('sp.viewthem')}}" class="btn d-inline-flex btn-sm btn-primary mx-1">
                                    <span class=" pe-2">
                                        <i class="fa-solid fa-file-circle-plus"></i>
                                    </span>
                                    <span>Thêm sản phẩm mới</span>
                                </a>
                                <a class="btn d-inline-flex btn-sm btn-danger border-base mx-1" onclick="event.preventDefault(); document.getElementById('delete-form-{{$sp->sp_id}}').submit();">
                                    <span class=" pe-2"> <i class="bi bi-trash"></i></span>
                                    <span>Xoá sản phẩm</span>
                                </a>
                                <form id="delete-form-{{$sp->sp_id}}" action="{{route('sp.xoa',['id'=>$sp->sp_id])}}" method="POST" style="display: none;">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                </form>
                            @else
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
                            @endauth
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </header>

    <main class="py-6" style="height: 100%; align-content: center; align-items: center;">
        <div class="container-fluid">
            <div class="frames-container-application">
                <div class="card shadow border-0 mb-7">
                    <div class="card-header">
                        <h3 class="mb-0">Tên sản phẩm <span class="h1" style="font-weight: 900;"> {{ $sp->sp_ten }} </span></h3>
                    </div>
                    <div class="card-title border-0 mb-7" style="margin-bottom: 0 !important;">
                        <ul class="blog-detail font-weight-normal text-black-50 list-unstyled list-inline row m-3" >
                            <li class="col-3"><i class="fa fa-calendar" style="margin-right: 0.5rem;"></i><strong>Thời gian tạo mới :</strong> <p class="text-muted font-weight-normal">{{date('H:i:s d-m-Y',strtotime($sp->sp_taomoi))}}</p></li>
                            <li class="col-3"><i class="fa-solid fa-clock-rotate-left" style="margin-right: 0.5rem;"></i><strong>Cập nhật gần nhất : </strong><p class="text-muted font-weight-normal">{{date('H:i:s d-m-Y',strtotime($sp->sp_capnhat))}}</p></li>
                            <li class="col-3"><i class="fa-solid fa-building" style="margin-right: 0.5rem;"></i><strong>Tên nhà sản xuất :</strong> <p class="text-muted font-weight-normal">{{$sp->nhaSanXuat->nsx_ten}}</p></li>
                            <li class="col-3"><i class="fa-brands fa-elementor" style="margin-right: 0.5rem;"></i><strong>Thuộc loại danh mục :</strong> <p class="text-muted font-weight-normal">{{$sp->loaiSanPham->lsp_ten}}</p></li>
                        </ul>
                    </div>
                    <hr style="marign: 0;">
                    <div class="row card-body">
                        <div class="p-1 col-4">
                            <img class="left-block d-block" src="{{Storage::url($sp->sp_hinhanh)}}" alt="{{$sp->sp_ten}}">
                        </div>
                        <div class="col-8">
                            <div class="card-content">
                                <p>
                                    {{$sp->sp_thongtin}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection
