@extends('layouts.master')
@section('title')
PROJECT-Đăng nhập
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
                                <form class="form-signin row" action="{{ route('postLogin') }}" method="POST" style="align-items: center;padding-top: 1rem; padding-bottom: 1.5rem">
                                    <div class="card-header text-center">
                                        <p class="h3 font-bold mb-0 font-">Đăng nhập<p>
                                    </div>
                                    @csrf
                                    <div class="form-group" style="margin-top: 1rem;">
                                        <label for="inputEmail" class="sr-only">Địa chỉ Email</label>
                                        <input type="email" name="email" class="form-control" placeholder="Email address">

                                        @error('email')
                                            <span class="text-danger text-md-center" role="alert">
                                                <p>{{ $message }}</p>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group" style="margin-top: 1rem;">
                                        <label for="inputPassword" class="sr-only">Mật khẩu</label>
                                        <input type="password" name="password" class="form-control" placeholder="Password">

                                        @error('password')
                                            <span class="text-danger text-md-center" role="alert">
                                                <p>{{ $message }}</p>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="checkbox mb-3" style="margin-top: 1rem;">
                                        <label>
                                            <input type="checkbox" name="remember" value="remember-me"> Nhớ tài khoản
                                        </label>
                                    </div>

                                    <button class="btn btn-md btn-primary btn-block" type="submit" style="margin-top: 1rem;">Đăng nhập</button>

                                    <a class="btn btn-md btn-secondery btn-block " href="{{ route('getRegister') }}" style="margin-top: 1rem;border: 1px solid rgb(25, 200, 171) !important;">Tạo tài khoản </a>
                                    <a class="btn btn-md btn-success btn-block " href="{{ route('view.checkcode') }}" style="margin-top: 1rem;">Kích hoạt tài khoản </a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
