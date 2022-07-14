@extends('layouts.master')

@section('title')
PROJECT- Đăng ký tài khoản
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
        <div class="container-fluid">
            <!-- Card stats -->


            <div class = "row text-left">
                <form class="form-signin" action="{{ route('postRegister') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="card-header text-center">
                        <p class="h3 font-bold mb-0 font-">Đăng ký tài khoản<p>
                    </div>
                    <div class="form-group" style="margin-top:1rem;">
                        <label for="inputName" class="">Họ và Tên:</label>
                        <input type="text" name="fullname" class="form-control" placeholder="Họ và Tên" value="{{ old('fullname') }}">

                        @error('fullname')
                            <span class="text-danger" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group form-row flex-md-row" style=" display:flex; flex-direction: row; flex-wrap: nowrap; align-items: center;margin-top:1rem;">
                        <label for="gender" style="margin-right: 10px; margin-bottom: 0;">Giới tính :</label>
                        <div  style=" display:flex; flex-direction: row; flex-wrap: nowrap; align-items: center;">
                            <input type="radio" name="gender" class="" style="width: 16px; height:16px;margin-right: 10px;" value="Nam">
                                <label for="gender" style="margin-right: 10px; margin-bottom: 0;">Nam</label>
                            <input type="radio" name="gender" class="" style="width: 16px; height:16px;margin-right: 10px;" value="Nữ">
                                <label for="gender" style="margin-right: 10px; margin-bottom: 0;">Nữ</label>
                        </div>
                    </div>
                    @error('gender')
                            <span class="text-danger" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror

                    <div class="form-group" style="margin-top:1rem;">
                        <label for="inputPasswordConfirmation" class="">Năm sinh:</label>
                        <input type="date" name="birthdate" class="form-control" value="{{old('datebirth')}}">
                        @error('birthdate')
                            <span class="text-danger" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group" style="margin-top:1rem;">
                        <label for="inputName" class="">Tên đăng nhập:</label>
                        <input type="text" name="username" class="form-control" placeholder="Tên đăng nhập" value="{{ old('username') }}">

                        @error('username')
                            <span class="text-danger" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>


                    <div class="form-group" style="margin-top:1rem;">
                        <label for="inputEmail" class="">Địa chỉ E-mail:</label>
                        <input type="email" name="email" class="form-control" placeholder="Địa chỉ E-mail" value="{{ old('email') }}">

                        @error('email')
                            <span class="text-danger" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group" style="margin-top:1rem;">
                        <label for="inputPassword" class="">Mật khẩu:</label>
                        <input type="password" name="password" class="form-control" placeholder="Mật khẩu">

                        @error('password')
                            <span class="text-danger" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group" style="margin-top:1rem;">
                        <label for="inputPasswordConfirmation" class="">Xác thực mật khẩu:</label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Nhập lại mật khẩu">

                        @error('password_confirmation')
                            <span class="text-danger" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class=" form-group" style="margin-top:1rem;margin-bottom: 1.5rem;">
                        <label for="image">Ảnh đại diện :</label>
                        <input type="file" class="form-control" name="image" accept="png,jpeg,gif,jpg" placeholder="Chọn ảnh đại diện">

                        @error('image')
                        <span class="text-danger" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                    @enderror
                    </div>
                    <hr>
                    <div class="checkbox mb-3 row" style="margin-top:1rem;">
                            <button class="btn btn-lg btn-primary btn-block" type="submit">Đăng ký tài khoản</button>
                    </div>
                    <p class="text-center form-group" style="margin-top: 1rem;">Bạn đã có tài khoản <a href="{{ route('getLogin') }}">Đăng nhập</a></p>

                    <p class="mt-5 text-center mb-3 text-muted">© PROJECT_REGISTER {{ now()->year}}</p>

                </form>
            </div>
        </div>
    </main>
</div>
@endsection
