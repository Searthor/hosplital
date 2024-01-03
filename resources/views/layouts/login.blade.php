<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{__('lang.login')}}|VDL</title>
  <link rel="stylesheet" href="{{ asset('backend/plugins/flag-icon-css/css/flag-icon.min.css')}}">
  <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}" />
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('backend/dist/css/adminlte.min.css')}}">
  <!-- Toastr -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/toastr/toastr.min.css')}}">
  <!-- sweetalert2 -->
  <link rel="stylesheet" href="{{asset('backend/plugins/sweetalert2/sweetalert2.css')}}">
  <link rel="stylesheet" href="{{asset('backend/plugins/sweetalert2/sweetalert2.min.css')}}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('backend/plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

  <link href="{{ asset('fontend/css/loginStyle.css') }}" rel="stylesheet">
  <style>
    nav svg {
      height: 20px;
    }

    @font-face {
      font-family: 'Noto Sans Lao';
      src: url('{{ asset("fonts/NotoSansLao-Medium.ttf") }}');
    }

    /* body {
      background-image: linear-gradient(#000, #000);
      background-color: #000;
    } */
  </style>
  @livewireStyles
</head>

<body class="hold-transition login-page" style="font-family: 'Noto Sans Lao'">
  {{ $slot }}
  <!-- jQuery -->
  <script src="{{ asset('backend/plugins/jquery/jquery.min.js')}}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{ asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('backend/dist/js/adminlte.min.js')}}"></script>
  <!-- Toastr -->
  <script src="{{asset('backend/plugins/toastr/toastr.min.js')}}"></script>
  <!-- SweetAlert2 -->
  <script src="{{asset('backend/plugins/sweetalert2/sweetalert2.all.js')}}"></script>
  <script src="{{asset('backend/plugins/sweetalert2/sweetalert2.all.min.js')}}"></script>
  <script src="{{asset('backend/plugins/sweetalert2/sweetalert2.js')}}"></script>
  <script src="{{asset('backend/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  @livewireScripts
  @include('layouts.script')
  @include('layouts.sweet-alert')
  @stack('scripts')
</body>

</html>