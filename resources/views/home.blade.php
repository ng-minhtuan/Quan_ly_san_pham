@extends('layouts.master')

@section('title')
PROJECT - Trang chủ
@endsection

@section('body')
<style>
    body{
        background-color: aquamarine;
    }
</style>
<div class="h-screen flex-grow-1 overflow-y-lg-auto">
    <!-- Header -->
    <header class="bg-surface-primary border-bottom pt-6" style="height:5rem;">
        <div class="container-fluid">
            <div class="mb-npx">
                <div class="row align-items-center">
                    <div class="col-sm-6 col-12 mb-4 mb-sm-0">
                        <!-- Title -->
                        <h1 class="h2 mb-0 ls-tight">@yield('title')</h1>
                    </div>
                    <!-- Actions -->
                    <div class="col-sm-6 col-12 text-sm-end">
                        <div class="mx-n1">
                            <a href="{{route('search.get')}}" class="btn d-inline-flex btn-sm btn-secondary mx-1">
                                <span class=" pe-2">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </span>
                                <span>Tìm kiếm</span>
                            </a>
                            <a href="{{route('tintuc.viewtaomoi')}}" class="btn d-inline-flex btn-sm btn-primary mx-1">
                                <span class=" pe-2">
                                    <i class="fa-solid fa-file-circle-plus"></i>
                                </span>
                                <span>Tạo bài viết mới</span>
                            </a>

                            @unless (Auth::check())
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
                            @endunless
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>


    <!--Main-->
    <main class="py-6 bg-surface-secondary">
        <div class="container-fluid">

            <!-- Card stats -->
            <div class="row g-6 mb-6">
                <div class="col-xl-4 col-sm-6 col-12">
                    <div class="card shadow border-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col"> <span class="h3 font-bold mb-0 font- ">Tin Tức</span> <span class="h6 font-semibold text-muted text-sm d-block mb-2"> Số lượng Tin Tức : {{App\Models\TinTuc::dsTinTuc()->count()}}</span> </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-tertiary text-white text-lg rounded-circle">
                                        <i class="fa-solid fa-newspaper"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-sm-6 col-12">
                    <div class="card shadow border-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col"> <span class="h3 font-bold mb-0 font- ">Sản Phẩm</span> <span class="h6 font-semibold text-muted text-sm d-block mb-2"> Số lượng Sản phẩm : {{App\Models\SanPham::get()->Count()}}</span> </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-warning text-white text-lg rounded-circle"> <i class="fa-solid fa-store"></i> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-sm-6 col-12">
                    <div class="card shadow border-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col"> <span class="h3 font-bold mb-0 font- ">Tài khoản</span> <span class="h6 font-semibold text-muted text-sm d-block mb-2"> Số lượng tài khoản : {{App\Models\User::dsNguoiDung()->count()}}</span> </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-primary text-white text-lg rounded-circle"> <i class="fa-solid fa-users"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            {{-- Bảng Tin tức mới nhất --}}
            <div class="card shadow border-0 mb-7">
                <div class="card-header">
                    <h5 class="mb-0">Tin tức mới nhất</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-nowrap">

                        <thead class="thead-light">
                            <tr>
                                <th scope="col" style="font-weight: 700;">STT</th>
                                <th scope="col" style="font-weight: 700; width: 15%;">Tiêu đề</th>
                                <th scope="col" style="font-weight: 700;">Người đăng</th>
                                <th scope="col" style="font-weight: 700;">Thời gian</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($dataHome['dsTinTucPublic'] as $tinTuc)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{substr($tinTuc->tintuc_tieude,0,40)}}</td>
                                    {{-- <td>{{$tinTuc->tintuc_noidung}}</td> --}}
                                    <td>{{$tinTuc->user->username}}</td>
                                    <td>{{$tinTuc->tintuc_taomoi}}</td>

                                    <td class="text-end">
                                        <a href="{{route('tintuc.doc',['id' => $tinTuc->tintuc_id])}}" id="items" class="btn btn-sm btn-secondary">
                                            <i class="fa-solid fa-eye"></i>
                                            <span>Xem</span>
                                        </a>

                                        @auth

                                        <a type="button" class="btn btn-sm btn-danger" onclick="event.preventDefault(); document.getElementById('delete-form-tintuc-{{$tinTuc->tintuc_id}}').submit();">
                                            <i class="bi bi-trash"></i>
                                            <span>Xoá</span>
                                        </a>

                                        <form id="delete-form-tintuc-{{$tinTuc->tintuc_id}}" action="{{route('tintuc.xoa',['id'=>$tinTuc->tintuc_id])}}" method="POST" style="display: none;">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        </form>
                                        @endauth
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Bảng Danh sách người dùng mới nhất --}}
            <div class="card shadow border-0 mb-7">
                <div class="card-header">
                    <h5 class="mb-0">Người dùng mới nhất</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-nowrap">

                        <thead class="thead-light">
                            <tr>
                                <th scope="col" style="font-weight: 700;">STT</th>
                                <th scope="col" style="font-weight: 700;">Họ Tên</th>
                                <th scope="col" style="font-weight: 700;">Username</th>
                                <th scope="col" style="font-weight: 700;">Tuổi</th>
                                <th scope="col" style="font-weight: 700;">Thời gian</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($dataHome['dsUser'] as $user)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$user->fullname}}</td>
                                    <td>{{$user->username}}</td>
                                    <td>
                                        @php
                                            $x = date_create_from_format('d/m/Y',$user->birthdate);
                                            $a = date_format($x,'Y/m/d');
                                            $age = Carbon\Carbon::parse($a)->diff(Carbon\Carbon::now())->format('%y');
                                            echo $age;
                                        @endphp
                                    </td>
                                    {{-- <td>{{dd(\app\models\User::find(1)->TinTuc);}}<td> --}}

                                    <td>{{$user->created_at}}</td>

                                    <td class="text-end">
                                        <a href="{{Route('list.getUser',['id'=>$user->user_id])}}" class="btn btn-sm btn-secondary">
                                            <i class="fa-solid fa-eye"></i>
                                            <span>Xem</span>
                                        </a>
                                        @auth
                                        <a type="button" class="btn btn-sm btn-danger" onclick="event.preventDefault(); document.getElementById('delete-form-user-{{$user->user_id}}').submit();">
                                            <i class="bi bi-trash"></i>
                                            <span>Xoá</span>
                                        </a>
                                        <form id="delete-form-user-{{$user->user_id}}" action="{{route('list.deleteUser',['id'=>$user->user_id])}}" method="POST" style="display: none;">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        </form>
                                        @endauth
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Bảng danh sách sản phẩm --}}
            <div class="card shadow border-0 mb-7">
                <div class="card-header">
                    <h5 class="mb-0">Sản phẩm mới nhất</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-nowrap">

                        <thead class="thead-light">
                            <tr>
                                <th scope="col" style="font-weight: 700;">STT</th>
                                <th scope="col" style="font-weight: 700;">Tên sản phẩm</th>
                                <th scope="col" style="font-weight: 700;">Giá</th>
                                <th scope="col" style="font-weight: 700; width:30%">Thông Tin</th>
                                <th scope="col" style="font-weight: 700;">Thời gian</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($dataHome['dsSanPham'] as $sp)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$sp->sp_ten}}</td>
                                    <td>{{$sp->sp_gia}}</td>
                                    <td>{{subStr($sp->sp_thongtin,0,35)}}</td>
                                    <td>{{$sp->sp_capnhat}}</td>

                                    <td class="text-end">
                                        <a href="{{Route('sp.xem',['id'=>$sp->sp_id])}}" class="btn btn-sm btn-secondary">
                                            <i class="fa-solid fa-eye"></i>
                                            <span>Xem</span>
                                        </a>
                                        @auth
                                        <a type="button" class="btn btn-sm btn-danger" onclick="event.preventDefault(); document.getElementById('delete-form-sp-{{$sp->sp_id}}').submit();">
                                            <i class="bi bi-trash"></i>
                                            <span>Xoá</span>
                                        </a>
                                        <form id="delete-form-sp-{{$sp->sp_id}}" action="{{route('sp.xoa',['id'=>$sp->sp_id])}}" method="POST" style="display: none;">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        </form>
                                        @endauth
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection
