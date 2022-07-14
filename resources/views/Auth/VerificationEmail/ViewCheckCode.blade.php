@extends('layouts.master')
@section('title')
PROJECT-Xác thực Tài khoản
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
                            <div class="row card" style="align-content: center; padding-top: 1rem; padding-bottom:1.5rem;">
                                <form class="form-signin row" action="#" method="POST" style="align-items: center">
                                    <div class="card-header text-center" style="padding: 1rem 0;">
                                        <p class="h3 font-bold mb-0 font-">Xác thực tài khoản<p>
                                    </div>
                                    @csrf
                                    <div class="form-group" style="margin-top: 1rem; padding: 1.5rem 0;">
                                        <label for="code" class="col-form-label-lg">Mã xác thực : </label>
                                        <input type="text" name="code" class="form-control" placeholder="Hãy nhập vào mã xác thực của bạn">

                                        @error('code')
                                            <span class="text-danger text-md-center" role="alert">
                                                <p>{{ $message }}</p>
                                            </span>
                                        @enderror
                                    </div class = "form-signin row">
                                    <button class="btn btn-md btn-primary btn-block" type="submit" style="margin-top: 1rem;">Xác thực</button>
                                </form>
                                <div class = "form-signin row" style="margin-top: 0.5rem;">
                                <a href="{{route('xacthuc.view')}}" class="btn btn-md btn-secondary btn-block">Yêu cầu gửi lại Email xác thực</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
