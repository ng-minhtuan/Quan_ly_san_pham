@extends('Layouts.master')

@section('title')
    PROJECT - Trang cá nhân
@endsection


@section('body')
<div class="h-screen flex-grow-1 overflow-y-lg-auto">
    <header class="bg-surface-primary border-bottom pt-6 shadow-sm" style="padding-bottom: 1rem;">
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
                            <a href="{{Route('list.editUser',['id'=>$user->user_id])}}" class="btn d-inline-flex btn-sm btn-neutral border-base mx-1">
                                <span class=" pe-2"> <i class="bi bi-pencil"></i> </span>
                                <span>Sửa thông tin cá nhân</span>
                            </a>
                            <a class="btn d-inline-flex btn-sm btn-danger border-base mx-1" onclick="event.preventDefault(); document.getElementById('delete-form').submit();">
                                <span class=" pe-2"> <i class="bi bi-trash"></i></span>
                                <span>Xoá tài khoản</span>
                            </a>
                            <form id="delete-form" action="{{route('list.deleteUser',['id'=>$user->user_id])}}" method="POST" style="display: none;">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </header>
    <main class="py-6" style="height: 100%;
    display: flex;
    align-content: center;
    align-items: center;
    }">
        <div class="container-fluid"    style=" margin-top: 5rem;">

            <!-- Card stats -->
            <div class="row g-6 mb-6 justify-content-center">
                <div class="col-xl-10 col-sm-10 col-12">
                    <div class="shadow border-2 border-radius mb-7" style="border-radius:8px;">
                        <div class="card-body">
                            <div class="row flex-direction-row card-body">
                                <div class="col-xl-4"  style="box-shadow: 1px 0 0 0  rgb(216, 216, 216); position: relative;padding-right: 2rem;">
                                    <div class="card-img" width="100%" height="100%">
                                        <img src="{{ Storage::url($user->image)}}" class="img-radius" alt="User-Profile-Image" width="100%" height="100%">
                                    </div>
                                    <div style="width: 100%;
                                                text-align: center;
                                                margin-top: 1rem;">
                                        <a class="btn d-inline-flex btn-sm btn-outline-primary border-base mx-1" href="{{route('list.editImage',['id'=>$user->user_id])}}">
                                            <span class=" pe-2"><i class="fa-solid fa-images" ></i></span>
                                            <span class=" pe-2">Đổi ảnh đại diện</span>
                                        </a>
                                    </div>
                                </div>

                                {{-- <div style="height: 100%; width: 2px; background-color: rgb(153, 153, 153)"></div> --}}
                                <div class="col">
                                    <h4 class="m-b-20 p-b-5 b-b-default f-w-600 card-header">Thông tin cá nhân</h4>
                                    <div class="row col">
                                        <div class="row row-sm-2">
                                            <div class="card-body col-sm-2">
                                                <p class="m-b-10 f-w-600">Họ tên : </p>
                                                <hr style="margin:0.3rem 0 1rem 0;">
                                                <h6 class="text-muted f-w-400">{{$user->fullname}}</h6>
                                            </div>
                                            <div class="card-body col-sm-2">
                                                <p class="m-b-10 f-w-600">Giới tính : </p>
                                                <hr style="margin:0.3rem 0 1rem 0;">
                                                <h6 class="text-muted f-w-400">{{$user->gender}}</h6>
                                            </div>
                                        </div>
                                        <div class="row row-sm-2">
                                            <div class="card-body col-sm-2">
                                                <p class="m-b-10 f-w-600">Tài khoản : </p>
                                                <hr style="margin:0.3rem 0 1rem 0;">
                                                <h6 class="text-muted f-w-400">{{$user->username}}</h6>
                                            </div>
                                            <div class="card-body col-sm-2">
                                                <p class="m-b-10 f-w-600">Năm sinh : </p>
                                                <hr style="margin:0.3rem 0 1rem 0;">
                                                <h6 class="text-muted f-w-400">{{$user->birthdate}}</h6>
                                            </div>
                                        </div>
                                        <div class="row row-sm-2">
                                            <div class="card-body col-sm-2">
                                                <p class="m-b-10 f-w-600">Địa chỉ Email : </p>
                                                <hr style="margin:0.3rem 0 1rem 0;">
                                                <h6 class="text-muted f-w-400">{{$user->email}}</h6>
                                            </div>
                                            <div class="card-body col-sm-2">
                                                <p class="m-b-10 f-w-600">Ngày gia nhập</p>
                                                <hr style="margin:0.3rem 0 1rem 0;">
                                                <h6 class="text-muted f-w-400">{{$user->created_at}}</h6>
                                            </div>
                                        </div>
                                        <div class="row row-sm-2">
                                            <div class="card-body col-sm-2">
                                                <p class="m-b-10 f-w-600">Số lượng bài đăng</p>
                                                <hr style="margin:0.3rem 0 0.5rem 0;">
                                                <div style="display:flex;  justify-content:space-between;">
                                                <h6 class="text-muted f-w-400" style="display: flex; align-items: center;">{{$user->tinTuc()->get()->count()}}</h6>
                                                <a href="{{route('list.tintuc',['id'=>$user->user_id])}}" class="btn btn-block" style="height: 2rem; color:rgb(0, 89, 255); padding: 0 1rem; align-items: center; display: flex; align-content: center;font-weight: normal; border: 1px solid rgba(45, 78, 66, 0.72);">
                                                    <i class="fa-brands fa-readme" style="margin-right: 0.5rem;padding-top: 0.1rem;"></i>Xem
                                                </a>
                                                </div>
                                            </div>
                                            <div class="card-body col-sm-2">
                                                <p class="m-b-10 f-w-600">Lần cập nhật gần nhất</p>
                                                <hr style="margin:0.3rem 0 1rem 0;">
                                                <h6 class="text-muted f-w-400">{{$user->updated_at}}</h6>
                                            </div>
                                        </div>
                                    <div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection

