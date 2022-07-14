@extends('layouts.master')
@section('title')
PROJECT - Tin Tức
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
                                <a href="{{route('tintuc.viewsua',['id'=>$tinTuc->tintuc_id])}}" class="btn d-inline-flex btn-sm btn-neutral border-base mx-1">
                                    <span class=" pe-2"> <i class="bi bi-pencil"></i> </span>
                                    <span>Sửa bài viết</span>
                                </a>
                                <a href="{{route('tintuc.viewtaomoi')}}" class="btn d-inline-flex btn-sm btn-primary mx-1">
                                    <span class=" pe-2">
                                        <i class="fa-solid fa-file-circle-plus"></i>
                                    </span>
                                    <span>Tạo bài viết mới</span>
                                </a>
                                <a class="btn d-inline-flex btn-sm btn-danger border-base mx-1" onclick="event.preventDefault(); document.getElementById('delete-form').submit();">
                                    <span class=" pe-2"> <i class="bi bi-trash"></i></span>
                                    <span>Xoá bài viết</span>
                                </a>
                                <form id="delete-form" action="{{route('tintuc.xoa',['id'=>$tinTuc->tintuc_id])}}" method="POST" style="display: none;">
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
                        <h3 class="mb-0">Tiêu đề bài viết : <span class="h1" style="font-weight: 900;">{{$tinTuc->tintuc_tieude}}</span></h3>
                    </div>
                    <div class="card-title border-0 mb-7">
                        <ul class="blog-detail font-weight-normal text-black-50 list-unstyled list-inline row m-3" >
                            <li class = "col-3"><i class="fa fa-user" style="margin-right: 0.5rem;"></i><strong>Người đăng : </strong><p class="text-muted font-weight-normal">{{ $tinTuc->find($tinTuc->user_id)->user->username}}<p></p></li>
                            <li class="col-3"><i class="fa fa-calendar" style="margin-right: 0.5rem;"></i><strong>Thời gian đăng bài :</strong> <p class="text-muted font-weight-normal">{{date('H:i:s d-m-Y',strtotime($tinTuc->tintuc_taomoi))}}</p></li>
                            <li class="col-3"><i class="fa fa-calendar" style="margin-right: 0.5rem;"></i><strong>Cập nhật gần nhất : </strong><p class="text-muted font-weight-normal">{{date('H:i:s d-m-Y',strtotime($tinTuc->tintuc_capnhat))}}</p></li>
                        </ul>
                    </div>
                    <div class="row card-body">
                        <div class="p-1 col-4">
                            <img class="left-block d-block" src="https://picsum.photos/450/300?image=1072" alt="">
                        </div>
                        <div class="col-6">
                            <div class="card-content">
                                <p>
                                    {{$tinTuc->tintuc_noidung}}
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
