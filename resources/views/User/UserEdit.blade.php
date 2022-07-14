@extends('Layouts.master')
@section('title')
    PROJECT - Sửa thông tin cá nhân
@endsection

@section('body')

<div class="h-screen flex-grow-1 overflow-y-lg-auto">
    <header class="bg-surface-primary border-bottom pt-6">
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
                <form class="form-signin" action="{{ route('user.update') }}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="card-header text-center">
                        <p class="h3 font-bold mb-0 font-">@yield('title')<p>
                    </div>
                    <div class="form-group" style="margin-top:1rem;">
                        <label for="inputName" class="">Họ và Tên:</label>
                        <input type="text" name="fullname" class="form-control" placeholder="Họ và Tên" value="{{ auth()->user()->fullname }}">

                        @error('fullname')
                            <span class="text-danger" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group form-row flex-md-row" style=" display:flex; flex-direction: row; flex-wrap: nowrap; align-items: center;margin-top:1rem;">
                        <label for="gender" style="margin-right: 10px; margin-bottom: 0;">Giới tính :</label>
                        <div  style=" display:flex; flex-direction: row; flex-wrap: nowrap; align-items: center;">
                            <input type="radio" name="gender" class="" style="width: 16px; height:16px;margin-right: 10px;" value="Nam"
                            @if (auth()->user()->gender == 'Nam')
                                checked
                            @endif
                            >
                                <label for="gender" style="margin-right: 10px; margin-bottom: 0;">Nam</label>
                            <input type="radio" name="gender" class="" style="width: 16px; height:16px;margin-right: 10px;" value="Nữ"
                            @if (auth()->user()->gender =='Nữ')
                                checked
                            @endif
                            >
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
                        @php
                            $a = date_create_from_format('d/m/Y',auth()->user()->birthdate);
                            $date = date_format($a, 'Y/m/d');
                        @endphp
                        <input type="date" name="birthdate" id="myDate" class="form-control" value= "{{ date('Y-m-d',strtotime($date)) }}">

                        @error('birthdate')
                            <span class="text-danger" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group" style="margin-top:1rem;">
                        <label for="inputName" class="">Tên đăng nhập:</label>
                        <input type="text" name="username" class="form-control" placeholder="Tên đăng nhập" value="">

                        @error('username')
                            <span class="text-danger" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>


                    <div class="form-group" style="margin-top:1rem;">
                        <label for="inputEmail" class="">Địa chỉ E-mail:</label>
                        <input type="email" name="email" class="form-control" placeholder="Địa chỉ E-mail" value="">

                        @error('email')
                            <span class="text-danger" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group" style = "display:flex;">
                        <div class="p-3 col-4">
                            <p style="font-weight: 700; color:#000; margin: 1rem 0 0.5rem;">Hình ảnh hiện tại</p>
                            <img class="left-block d-block" src="{{Storage::url(auth()->user()->image)}}" alt="{{auth()->user()->username}}">

                        </div>
                        <div class="p-3 col-8">
                        <label style="font-weight: 700; color:#000; margin: 1rem 0 0.5rem;" for="tieude">Hình ảnh cập nhât</label>
                        <input type="file" class="form-control" name="image" id="formFile" placeholder="Hãy nhập vào tên của nhà sản xuất....">
                        @error('image')
                            <span class="text-danger" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                        </div>
                    </div>
                    <hr>
                    <div class="checkbox mb-3 row" style="margin-top:2rem;">
                        <button class="btn btn-lg btn-primary btn-block" type="submit">Cập nhật thông tin</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</div>



@endsection

