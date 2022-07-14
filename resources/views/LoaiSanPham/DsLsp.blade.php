@extends('layouts.master')
@section('title')
PROJECT - Danh sách Loại sản phẩm
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
                    <div class="col-sm-6 col-12 text-sm-end">
                        <div class="mx-n1">
                            @unless(Auth::check())
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
                                @else
                                <a href="{{route('lsp.viewthem')}}" class="btn d-inline-flex btn-sm btn-primary mx-1">
                                    <span class=" pe-2">
                                        <i class="fa-solid fa-file-circle-plus"></i>
                                    </span>
                                    <span>Tạo danh mục sản phẩm mới</span>
                                </a>
                            @endunless
                        </div>
                    </div>
                    {{$ds->links()}}
                </div>
            </div>
        </div>

    </header>

    <!--Main-->
    <main class="py-6 bg-surface-secondary">
        <div class="container-fluid">
            <div class="card shadow border-0 mb-7">
                <div class="card-header">
                    <h5 class="mb-0">Danh sách loại sản phẩm</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-nowrap">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="text-center" style="font-weight: 700;">STT</th>
                                <th scope="col" class="text-center" style="font-weight: 700;">Tên loại sản phẩm</th>
                                <th scope="col" class="text-center" style="font-weight: 700; width:10%">Ghi chú</th>
                                <th scope="col" class="text-center" style="font-weight: 700;">Danh mục cha</th>
                                <th scope="col" class="text-center" style="font-weight: 700;width: 60%"></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($ds as $lsp)
                                <tr>
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td>{{$lsp->lsp_ten}}</td>
                                    <td>{{substr($lsp->lsp_ghichu,0,40)}}</td>
                                    <td>
                                        @php
                                            if($lsp->lsp_parent_id == NULL)
                                            {
                                                echo "Không có danh mục cha";
                                            }
                                            else
                                            {
                                                $parent = $lsp->lsp_parent->lsp_ten;
                                                echo $parent;
                                            }

                                        @endphp
                                    </td>
                                    <td class="text-end">
                                        <a type="submit" href="{{route('lsp.danhsach2',['id'=>$lsp->lsp_id])}}" class="btn btn-sm btn-secondary">
                                            <i class="fa-solid fa-eye"></i>
                                            <span>Xem</span>
                                        </a>
                                        @auth
                                        <a href="{{route('lsp.viewsua',['lsp_id'=>$lsp->lsp_id])}}" type="button" class="btn btn-sm btn-primary">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                            <span>Sửa</span>
                                        </a>
                                        <a type="button" class="btn btn-sm btn-danger" onclick="document.getElementById('delete-lsp-{{$lsp->lsp_id}}').submit();">
                                            <i class="bi bi-trash"></i>
                                            <span>Xoá</span>
                                        </a>
                                        <form id="delete-lsp-{{$lsp->lsp_id}}" action="{{route('lsp.xoa',['lsp_id'=>$lsp->lsp_id])}}" method="POST" style="display: none;">
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
                </div>
            </div>
        </div>
    </main>

</div>
@endsection
