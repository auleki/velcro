<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <!--responsiveness-->
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=yes">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>echoCV @yield('title')</title>
                <!-- Fonts and icons-->

                   @livewireStyles
                   
                {{-- css --}}
       <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        
        {{--  <link href="{{ asset('css/select2.css') }}" rel="stylesheet">  --}}
        <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
        
        <link href="{{ asset('css/select2-bs4.css') }}" rel="stylesheet">
        <!-- Styles -->

      
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
        <link href="{{ asset('css/home.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/company.css')}}">
        <script  src="{{ asset('js/dash.js') }}" defer></script>


        @yield('styles')


</head>
<body>

<div class="wrapper">



        @include('layouts.sidebar')


            <!-- Page Content -->
            <section class="onboard">

                @yield('content')

            </section>




</div>

      @livewireScripts
    <!--Pop up modal jquery script-->
    {{--  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js" type="text/javascript"></script> 


    <!--chart js-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.min.js"></script>

    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" type="text/javascript"></script> 
     <script type="text/javascript" src="{{ asset('js/select2full.js') }}"></script> 

    <script  src="{{ asset('js/share.js') }}"></script>

     @yield('script')

</body>
@yield('modal')
</html>
