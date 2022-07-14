<!DOCTYPE html>
<html lang="en">
<meta name="viewport" content="width=device-width, initial-scale=1.0">


<!-- fonts style -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href=" https://therichpost.com/responsivestyle/index.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.4.0/font/bootstrap-icons.min.css" rel="stylesheet">
@stack('css')
<!--Fontawesome-->
<script src="https://kit.fontawesome.com/08ed40bd1d.js" crossorigin="anonymous"></script>

<title>@yield('title')</title>

<style>
    .logo {
        font-size: 3rem;
    }
    ::-webkit-scrollbar{
        width: 0.4rem;
        height: 0.4rem;
        background-color: #F5F5F5;}
    ::-webkit-scrollbar-track {
        border-radius: 10px;
        background: rgba(38, 38, 38, 0.1);
        border: 1px solid #ccc;}
    ::-webkit-scrollbar-thumb {
        border-radius: 10px;
        background: linear-gradient(left, #fff, #e4e4e4);
        border: 1px solid #aaa;
        }
    ::-webkit-scrollbar-thumb:hover {
        background: #fff;
    }

    ::-webkit-scrollbar-thumb:active {
        background: linear-gradient(left, #22ADD4, #1E98BA);
    }
</style>
</head>

<body>
    <!-- Banner -->
    @if(session()->has('success'))
        <p class="w-full text-truncate text-center alert-success rounded-0 py-2 border-0 position-relative" style="z-index: 1000;">
            <strong> {{session()->get('success')}}</strong>
        </p>
    @endif
    @if(session()->has('error'))
        <p class="w-full text-truncate text-center alert-danger rounded-0 py-2 border-0 position-relative" style="z-index: 1000;">
            <strong> {{session()->get('error')}}</strong>
        </p>
    @endif

    <!-- Dashboard -->
    <div class="d-flex flex-column flex-lg-row h-lg-full bg-surface-secondary">
        <!-- Vertical Navbar -->
        @include('Layouts/Includes/navbar')
        <!-- Main content -->
        @yield('body')
    </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
@stack('javascript')
</html>
