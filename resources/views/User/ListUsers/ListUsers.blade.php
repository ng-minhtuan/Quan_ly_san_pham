@extends('layouts.master')
@section('title')
PROJECT - Danh sách người dùng
@endsection
@section('body')
<div class="h-screen flex-grow-1 overflow-y-lg-auto">
    <!-- Header -->
    <header class="bg-surface-primary border-bottom pt-6">
        <div class="container-fluid">
            <div class="mb-npx">
                <div class="row align-items-center">
                    <div class="col-sm-6 col-12 mb-4 mb-sm-0">
                        <!-- Title -->
                        <h1 class="h2 mb-0 ls-tight">@yield('title')</h1>
                    </div>

                </div>
                {{$data->links()}}
            </div>
        </div>

    </header>

    <!--Main-->
    <main class="py-6 bg-surface-secondary">
        <div class="container-fluid">
            <div class="card shadow border-0 mb-7">
                <div class="card-header">
                    <h5 class="mb-0">Danh sách người dùng</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-nowrap">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="text-center" style="font-weight: 700;">STT</th>
                                <th scope="col" class="text-center" style="font-weight: 700;">Họ Tên</th>
                                <th scope="col" class="text-center" style="font-weight: 700;">Tên đăng nhập</th>
                                <th scope="col" class="text-center" style="font-weight: 700; padding-right: 0.5rem; padding-left: 0.5rem;">Tuổi</th>
                                <th scope="col" class="text-center" style="font-weight: 700; padding-top: 2rem;">Số lượng<br> bài đăng</th>
                                <th scope="col" class="text-center" style="font-weight: 700;">Thời gian</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($data as $users)
                                <tr>
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td>{{$users->fullname}}</td>
                                    <td>{{$users->username}}</td>
                                    <td class="text-center">
                                        @php
                                            $x = date_create_from_format('d/m/Y',$users->birthdate);
                                            $a = date_format($x,'Y/m/d');
                                            $age = Carbon\Carbon::parse($a)->diff(Carbon\Carbon::now())->format('%y');
                                            echo $age;
                                        @endphp
                                    </td>
                                    <td class="text-center">{{$users::find($users->user_id)->tinTuc->count()}}</td>

                                    <td>{{$users->created_at}}</td>
                                    <td class="text-end">
                                        {{-- {{dd($users->user_id)}} --}}
                                        <a href="{{route('list.getUser',['id'=>$users->user_id])}}" class="btn btn-sm btn-secondary">
                                            <i class="fa-solid fa-eye"></i>
                                            <span>Xem</span>
                                        </a>
                                        @auth
                                        <a href="{{route('list.editUser',['id'=>$users->user_id])}}" type="button" class="btn btn-sm btn-primary">
                                            <i class="bi bi-trash"></i>
                                            <span>Sửa</span>
                                        </a>
                                        <a type="button" class="btn btn-sm btn-danger" onclick="event.preventDefault(); document.getElementById('delete-form-{{$users->user_id}}').submit();">
                                            <i class="bi bi-trash"></i>
                                            <span>Xoá</span>
                                        </a>
                                        <form id="delete-form-{{$users->user_id}}" action="{{route('list.deleteUser',['id'=>$users->user_id])}}" method="POST" style="display: none;">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        </form>
                                        @endauth
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer border-0 py-5">
                    <span class="text-muted text-sm">
                        @php
                            $count = \App\Models\User::all()->count();
                        @endphp
                        Hiển thị danh sách {{$data->count()}} người dùng trong tổng số {{$count}} người dùng hiện tại.
                    </span>
                </div>
            </div>
        </div>
    </main>




</div>
@endsection
