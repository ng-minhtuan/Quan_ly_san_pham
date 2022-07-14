@extends('layouts.master')
@section('title')
PROJECT - Thông tin Nhà sản xuất
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

                    <!-- Actions -->

                    <div class="col-sm-6 col-12 text-sm-end">
                        <div class="mx-n1">
                            @auth
                                <a href="{{route('lsp.viewsua',['lsp_id'=> $lsp->lsp_id])}}" class="btn d-inline-flex btn-sm btn-neutral border-base mx-1">
                                    <span class=" pe-2"> <i class="bi bi-pencil"></i> </span>
                                    <span>Sửa danh mục</span>
                                </a>
                                <a href="{{route('lsp.viewthem')}}" class="btn d-inline-flex btn-sm btn-primary mx-1">
                                    <span class=" pe-2">
                                        <i class="fa-solid fa-file-circle-plus"></i>
                                    </span>
                                    <span>Tạo danh mục mới</span>
                                </a>
                                <a class="btn d-inline-flex btn-sm btn-danger border-base mx-1" onclick="event.preventDefault(); document.getElementById('delete-form-{{$lsp->lsp_id}}').submit();">
                                    <span class=" pe-2"> <i class="bi bi-trash"></i></span>
                                    <span>Xoá danh mục</span>
                                </a>
                                <form id="delete-form" action="delete-form-{{$lsp->lsp_id}}" method="POST" style="display: none;">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                </form>
                            @else
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
                            @endauth
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </header>

    <main class="py-6" style="height: 100%; align-content: center; align-items: center;">
        <div class="container-fluid" style="padding-bottom:2rem;">
            <div class="frames-container-application">
                <div class="card shadow border-0 mb-7">
                    <div class="card-header">
                        <h3 class="mb-0">Tên danh mục : <span class="h1" style="font-weight: 900;"> {{$lsp->lsp_ten}} </span></h3>
                    </div>
                    <div class="card-title border-0 mb-7" style="margin-bottom: 0 !important;">
                        <ul class="blog-detail font-weight-normal text-black-50 list-unstyled list-inline row m-3" >
                            <li class="col-3"><i class="fa fa-calendar" style="margin-right: 0.5rem;"></i><strong>Thời gian tạo mới :</strong> <p class="text-muted font-weight-normal">{{date('H:i:s d-m-Y',strtotime($lsp->lsp_taomoi))}}</p></li>
                            <li class="col-3"><i class="fa-solid fa-clock-rotate-left" style="margin-right: 0.5rem;"></i><strong>Cập nhật gần nhất : </strong><p class="text-muted font-weight-normal">{{date('H:i:s d-m-Y',strtotime($lsp->lsp_capnhat))}}</p></li>
                            <li class="col-3">
                                <i class="fa-solid fa-list-check" style="margin-right: 0.5rem;"></i>
                                <strong>Số danh mục con : </strong>
                                <p class="text-muted font-weight-normal">
                                    @php
                                    if($lsp->lsp_parent_id == NULL)
                                    {
                                        $count =$lsp->lsp_child->count();
                                        echo $count;
                                    }
                                    else
                                    {
                                        echo 'Không có danh mục con';
                                    }
                                    @endphp
                                </p>
                            </li>
                        </ul>
                    </div>
                    <hr style="margin: 0;">
                    <div class="row card-body">
                        <div class="col-6">
                            <div class="card-content">
                                <strong>Ghi chú : </strong>
                                <p>
                                    {{$lsp->lsp_ghichu}}
                                </p>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="card shadow border-0 mb-7">
                    <div class="card-header">
                        <h5 class="mb-0">Danh sách danh mục con</h5>
                    </div>
                    <div class="table-responsive text-center">
                        <table class="table table-hover table-nowrap">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="text-center" style="font-weight: 700;">STT</th>
                                    <th scope="col" class="text-center" style="font-weight: 700;">Tên danh mục</th>
                                    <th scope="col" class="text-center" style="font-weight: 700; width:10%">Ghi chú</th>
                                    <th scope="col" class="text-center" style="font-weight: 700;width: 60%"></th>
                                </tr>
                            </thead>

                            <tbody>
                                @if($lsp->lsp_parent_id == NULL)
                                {!!$ds =  $lsp->lsp_child()->latest()->paginate(10)!!}
                                @foreach($ds as $lsp1)
                                    <tr>
                                        <td class="text-center">{{$loop->iteration}}</td>
                                        <td>{{$lsp1->lsp_ten}}</td>
                                        <td>{{substr($lsp1->lsp_ghichu,0,40)}}</td>
                                        <td class="text-end">
                                            <a type="submit" href="{{route('lsp.danhsach2',['id'=>$lsp1->lsp_id])}}" class="btn btn-sm btn-secondary">
                                                <i class="fa-solid fa-eye"></i>
                                                <span>Xem</span>
                                            </a>
                                            @auth
                                            <a href="{{route('lsp.viewsua',['lsp_id'=>$lsp1->lsp_id])}}" type="button" class="btn btn-sm btn-primary">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                                <span>Sửa</span>
                                            </a>
                                            <a type="button" class="btn btn-sm btn-danger" onclick="document.getElementById('delete-lsp-{{$lsp1->lsp_id}}').submit();">
                                                <i class="bi bi-trash"></i>
                                                <span>Xoá</span>
                                            </a>
                                            <form id="delete-lsp-{{$lsp1->lsp_id}}" action="{{route('lsp.xoa',['lsp_id'=>$lsp1->lsp_id])}}" method="POST" style="display: none;">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            </form>
                                            @endauth
                                        </td>
                                    </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="4"><p>{{$ds = 'Không có danh mục con'}}</p></td>
                                </tr>

                                @endif
                            </tbody>

                        </table>
                    </div>

                    {{-- {{(!is_string($ds))?$ds->links():""}} --}}

                </div>
            </div>
        </div>
    </main>
</div>
@endsection
