<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>VANDALA</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}" />
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Saira:wght@500;600;700&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Libraries Stylesheet -->
    <link href="{{ asset('fontend/lib/animate/animate.min.css" rel="stylesheet')}}">
    <link href="{{ asset('fontend/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('fontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('backend/plugins/flag-icon-css/css/flag-icon.min.css') }}">
    <!-- Template Stylesheet -->
    <link href="{{ asset('fontend/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('fontend/css/about.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
        nav svg {
            height: 20px;
        }

        @font-face {
            font-family: 'Noto Sans Lao' !important;
            src: url('{{ asset("fonts/NotoSansLao-Medium.ttf") }}');
        }
    </style>
    
    @livewireStyles
</head>
<body>
    <!-- Spinner Start -->
    <div id="spinner"
        class="show position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow maincolor" role="status"></div>
    </div>
    <!-- Spinner End -->
    {{-- navbar --}}
    @include('layouts.fontend.navbar')
    <!-- Carousel Start -->
    
        {{ $slot }}

    <!-- Footer Start -->
    @include('layouts.fontend.footer')
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn bmaincolor maincolor btn-square rounded-circle back-to-top"><i
            class="fa fa-arrow-up text-white"></i></a>
    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('fontend/lib/wow/wow.min.js')}}"></script>
    <script src="{{ asset('fontend/lib/easing/easing.min.js')}}"></script>
    <script src="{{ asset('fontend/lib/waypoints/waypoints.min.js')}}"></script>
    <script src="{{ asset('fontend/lib/owlcarousel/owl.carousel.min.js')}}"></script>
    <!-- Template Javascript -->
    <script src="{{ asset('fontend/js/main.js')}}"></script>
    @livewireScripts
</body>

</html>