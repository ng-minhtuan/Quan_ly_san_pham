@extends('layouts.master')

@section('title')
PROJECT - Tìm kiếm
@endsection

@section('body')
<style>
    body{
        background-color: aquamarine;
    }
</style>
<div class="h-screen flex-grow-1 overflow-y-lg-auto">
    <!-- Header -->
    <header class="bg-surface-primary border-bottom pt-6" style="z-index: 1000;padding-bottom: 1rem;">
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
            <div class="form-group row g-6 mb-7" style = "padding:0 0.8rem;">
                <input type="text" name="search" id="search" class="form-control input-lg" placeholder="Nhập vào từ cần tìm kiếm" />
            </div>
            <hr>
           {{ csrf_field() }}
            <div class="card shadow border-0 mb-7">
                <div class="card-header">
                    <h5 class="mb-0">Gợi ý tìm kiếm</h5>
                </div>
                <div class="table-responsive" id="SearchListContent">

                </div>
            </div>
        </div>
    </main>
</div>
@endsection
@push('javascript')
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
    jQuery(document).ready(function(){

        $('#search').keyup(function(){ //bắt sự kiện keyup khi người dùng gõ từ khóa tim kiếm

            var query = $(this).val(); //lấy gía trị ng dùng gõ
            if(query != '') //kiểm tra khác rỗng thì thực hiện đoạn lệnh bên dưới
            {
            var _token = $('input[name="_token"]').val(); // token để mã hóa dữ liệu
            $.ajax({
                url:'/search',
                method:"POST", // phương thức gửi dữ liệu.
                data:{query:query, _token:_token},
                success:function(data){ //dữ liệu nhận về
                        console.log(data);
                    $('#SearchListContent').fadeIn();
                    $('#SearchListContent').html(data); //nhận dữ liệu dạng html và gán vào cặp thẻ có id là SearchListContent
                }
                });
            }
        });

    $(document).on('click','#redirectToUrl',function(){
        $('#SearchListContent').val($(this).text());
        $('#SearchListContent').fadeOut();
        let getRedirectUrl = $(this).attr('data-redirect-url');
        window.location.href= getRedirectUrl;
    });
});
</script>
@endpush
