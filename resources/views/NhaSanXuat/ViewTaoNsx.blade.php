@extends('layouts.master')
@section('title')
PROJECT - Tạo nhà sản xuất mới
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
                    <h2 class="mb-0 mt-1 col text-justify">Nhà sản xuất mới</h2>
                </div>
                <div class="card-body">
                    <form class="form-text" data-action="{{route('nsx.taomoi')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row justify-content-md-center">
                            <div class="col">
                                <div class="form-group">
                                    <label style="font-weight: 700; color:#000; margin: 0.5rem 0;" for="tieude">Tên nhà sản xuất</label>
                                    <input type="text" class="form-control" name="nsx_ten" id="tieude" placeholder="Hãy nhập vào tên của nhà sản xuất....">
                                    @error('nsx_ten')
                                        <span class="text-danger" role="alert">
                                            <p>{{ $message }}</p>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label style="font-weight: 700; color:#000; margin: 1rem 0 0.5rem;" for="tieude">Thông tin của nhà sản xuất</label>
                                    <textarea class="form-control" id="summary-ckeditor" name="nsx_mota" style="height: 15rem;"></textarea>
                                    @error('nsx_mota')
                                        <span class="text-danger" role="alert">
                                            <p>{{ $message }}</p>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label style="font-weight: 700; color:#000; margin: 1rem 0 0.5rem;" for="nsx_hinhanh">Hình ảnh nhà sản xuất</label>
                                    <input type="file" class="form-control" name="nsx_hinhanh" id="formFile" placeholder="Hãy nhập vào tên của nhà sản xuất....">
                                    @error('nsx_hinhanh')
                                        <span class="text-danger" role="alert">
                                            <p>{{ $message }}</p>
                                        </span>
                                    @enderror
                                </div>
                                <hr>
                            </div>
                        </div>

                        <div class="card-footer">
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-success btn-sm">Tạo Nhà sản xuất</button>
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
