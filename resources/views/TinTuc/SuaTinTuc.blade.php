@extends('layouts.master')
@section('title')
PROJECT - Sửa bài viết
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
                    <div class="col-sm-6 col-12 text-sm-end">
                        <div class="mx-n1">
                            <a href="{{route('tintuc.viewtaomoi')}}" class="btn d-inline-flex btn-sm btn-primary mx-1">
                                <span class=" pe-2">
                                    <i class="fa-solid fa-file-circle-plus"></i>
                                </span>
                                <span>Tạo bài viết mới</span>
                            </a>
                            <a href="{{ url()->previous() }}" class="btn d-inline-flex btn-sm btn-primary mx-1">
                                <span class=" pe-2">
                                    <i class="fa-solid fa-file-circle-plus"></i>
                                </span>
                                <span>Quay lại</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="py-6 bg-surface-secondary" style="justify-content: center;">
        <div class="container-fluid">
            <div class="card shadow border-0 mb-7">
                <div class="card-header row">
                    <div class="icon icon-shape text-white text-lg rounded-circle" style="background-color: rgb(255, 157, 0)" >
                        <i class="fa-solid fa-file-word"></i>
                    </div>
                    <h2 class="mb-0 mt-1 col text-justify">Sửa bài viết</h2>
                </div>
                <div class="card-body">
                    <form class="form-text" data-action="{{route('tintuc.sua',['id'=>$tinTuc->tintuc_id])}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row justify-content-md-center">
                            <div class="col">
                                <div class="form-group">
                                    <label style="font-weight: 700; color:#000; margin: 0.5rem 0;" for="tieude">Tiêu đề bài viết</label>
                                    <input type="text" class="form-control" name="tieude" id="tieude" value="{{$tinTuc->tintuc_tieude}}">
                                    @error('tieude')
                                        <span class="text-danger" role="alert">
                                            <p>{{ $message }}</p>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="tomtat" style="font-weight: 700; color:#000; margin: 1rem 0 0.5rem;" for="tieude">Tóm tắt bài viết</label>
                                    <input type="text" class="form-control" name="tomtat" id="tomtat" value="{{$tinTuc->tintuc_tomtat}}">
                                    @error('tomtat')
                                        <span class="text-danger" role="alert">
                                            <p>{{ $message }}</p>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label style="font-weight: 700; color:#000; margin: 1rem 0 0.5rem;" for="tieude">Nội dung bài viết</label>
                                    <textarea class="form-control" id="summary-ckeditor" name="noidung" style="height: 15rem;">{{$tinTuc->tintuc_noidung}}</textarea>
                                    @error('noidung')
                                        <span class="text-danger" role="alert">
                                            <p>{{ $message }}</p>
                                        </span>
                                    @enderror
                                </div>
                                <hr>

                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="terms" name="trangthai"
                                    @php
                                        if($tinTuc->tintuc_trangthai == 1){
                                            echo 'checked';
                                        }
                                    @endphp
                                    >
                                    <label class="form-check-label" for="terms">Bạn có muốn công khai bài viết của mình?</a></label>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-success btn-sm">Lưu</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>







@endsection
@push('javascript')

@endpush
@push('css')

@endpush
