@extends('layouts.master')
@section('title')
PROJECT-Đổi ảnh đại diện
@endsection
@section('body')
<div class="h-screen flex-grow-1 overflow-y-lg-auto">
    <header class="bg-surface-primary border-bottom pt-6" style="height:5rem;">
        <div class="container-fluid">
            <div class="mb-npx">
                <div class="row align-items-center">
                    <div class="col-sm-6 col-12 mb-4 mb-sm-0">
                        <!-- Title -->
                        <h1 class="h2 mb-0 ls-tight">@yield('title')</h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <main class="py-6 bg-surface-secondary" style="justify-content: center;">
        <div class="container-fluid" style="padding-top: 2rem;">
            <!-- Card stats -->
            <div class="row g-6 mb-6" style="justify-content: center;">
                <div class="col-xl-4 col-sm-6 col-12">
                    <div class="card shadow border-0  mb-7">
                        <div class="card-body">
                            <div class="row card" style="align-content: center;">
                                <form class="form-signin row" action="{{route('user.updateImage')}}" method="POST" enctype="multipart/form-data" style="align-items: center;padding-top: 1rem; padding-bottom: 1.5rem">
                                    <div class="card-header text-center">
                                        <p class="h3 font-bold mb-0 font-">Cập nhật ảnh đại diện<p>
                                    </div>
                                    @csrf
                                    <div class="form-group" style = "display:flex; flex-direction: column; padding: 1rem;">
                                            <p style="font-weight: 700; color:#000; margin: 1rem 0 0.5rem;">Hình ảnh hiện tại</p>
                                            <img class="left-block d-block" src="{{Storage::url(auth()->user()->image)}}" alt="{{auth()->user()->username}}">

                                        <label style="font-weight: 700; color:#000; margin: 1rem 0 0.5rem;" for="tieude">Hình ảnh cập nhât</label>
                                        <input type="file" class="form-control" name="image" id="formFile" placeholder="Hãy nhập vào tên của nhà sản xuất....">
                                        @error('image')
                                            <span class="text-danger" role="alert">
                                                <p>{{ $message }}</p>
                                            </span>
                                        @enderror

                                    </div>
                                    <hr>
                                    <button class="btn btn-md btn-primary btn-block" type="submit" style="margin-top: 1rem;">Đổi ảnh đại diện</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
