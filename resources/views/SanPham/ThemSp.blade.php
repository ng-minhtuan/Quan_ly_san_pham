@extends('layouts.master')
@section('title')
PROJECT - Thêm sản phẩm mới
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
                    <div class="icon icon-shape text-white text-lg rounded-circle" style="background-color: rgb(16, 172, 162)" >
                        <i class="fa-solid fa-file-word"></i>
                    </div>
                    <h2 class="mb-0 mt-1 col text-justify">Thêm sản phẩm mới</h2>
                </div>
                <div class="card-body">
                    <form class="form-text" data-action="{{route('sp.them')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row justify-content-md-center">
                            <div class="col">
                                <div class="form-group">
                                    <label style="font-weight: 700; color:#000; margin: 0.5rem 0;" for="lsp_ten">Tên sản phẩm</label>
                                    <input type="text" class="form-control" name="sp_ten" id="tieude" placeholder="Hãy nhập vào tên sản phẩm....">
                                    @error('sp_ten')
                                        <span class="text-danger" role="alert">
                                            <p>{{ $message }}</p>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label style="font-weight: 700; color:#000; margin: 0.5rem 0;" for="lsp_ten">Giá sản phẩm</label>
                                    <input type="text" class="form-control" name="sp_gia" id="tieude" placeholder="Hãy nhập vào giá của sản phẩm....">
                                    @error('sp_gia')
                                        <span class="text-danger" role="alert">
                                            <p>{{ $message }}</p>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label style="font-weight: 700; color:#000; margin: 1rem 0 0.5rem;" for="lsp_ghichu">Thông tin sản phẩm</label>
                                    <textarea class="form-control" id="summary-ckeditor" name="sp_thongtin" style="height: 15rem;"></textarea>
                                    @error('sp_thongtin')
                                        <span class="text-danger" role="alert">
                                            <p>{{ $message }}</p>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label style="font-weight: 700; color:#000; margin: 1rem 0 0.5rem;" for="lsp">Thuộc danh mục sản phẩm</label>
                                    <select id="lsp" name="lsp" class="form-select form-select-sm" aria-label=".form-select-sm example" style="width:30%; display:inline-block;" value = "{{old('lsp')}}">
                                        <option value="" >Không thuộc danh mục nào</option>
                                        @foreach($data['danh_muc'] as $lsp)
                                            <option value="{{$lsp->lsp_ten}}" {{(old('lsp') == $lsp->lsp_ten)? 'selected' : ''}}>{{$lsp->lsp_ten}}</option>
                                        @endforeach
                                    </select>
                                    @error('lsp')
                                        <span class="text-danger" role="alert">
                                            <p>{{ $message }}</p>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label style="font-weight: 700; color:#000; margin: 1rem 0 0.5rem; padding-right: 3.4rem;" for="nsx">Chọn nhà sản xuất</label>
                                    <select id="nsx" name="nsx" class="form-select form-select-sm" aria-label=".form-select-sm example" style="width:30%; display:inline-block;" value = "{{old('nsx')}}">
                                        <option value= "">Không thuộc nhà sản xuất nào</option>
                                        @foreach($data['nsx'] as $nsx)

                                            <option {{(old('nsx') == $nsx->nsx_ten)? 'selected' : ''}} value="{{$nsx->nsx_ten}}">{{$nsx->nsx_ten}}</option>

                                        @endforeach
                                    </select>
                                    @error('nsx')
                                        <span class="text-danger" role="alert">
                                            <p>{{ $message }}</p>
                                        </span>
                                    @enderror
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label style="font-weight: 700; color:#000; margin: 1rem 0 0.5rem;" for="tieude">Hình ảnh sản phẩm</label>
                                    <input type="file" accept="png,jpeg,jpg,gif" class="form-control" name="sp_hinhanh" id="formFile" placeholder="Hãy nhập vào tên của nhà sản xuất....">
                                    @error('sp_hinhanh')
                                        <span class="text-danger" role="alert">
                                            <p>{{ $message }}</p>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-success btn-sm">Thêm sản phẩm</button>
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
