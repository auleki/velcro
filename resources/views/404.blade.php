
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Welcome Back</title>
      <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
      <!-- Styles -->
      <link href="{{ asset('css/app.css') }}" rel="stylesheet">
      <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
      <!-- Scripts -->
  </head>

   <style>
       @media(min-width: 600px){
        .wholeContent{
            position: absolute;
            left: 15rem;
        }
       }
       p{
            font-family: Europa;
            font-style: normal;
            font-weight: normal;
            font-size: 24px;
            line-height: 31px;
            letter-spacing: 0.05em;
       }
       h1{
            font-family: Europa;
            font-style: normal;
            font-weight: normal;
            font-size: 120px;
            line-height: 157px;
       }
      
   </style>
  <body>

    <div class="wrapper">
        @include('layouts.sidebar')
      </div>
      <main class="wholeContent  ">
        <section class="container d-flex justify-content-center define-center">
            <div class="row d-flex col-md-10 col-sm-12 align-items-center mt-5 pt-5 ">
                <div class="col-md-7 col-sm-12 ">
                    <h1 class="text-center"> 404 </h1>
                    <p class="text-wrap">
                        We can’t find the page you’re looking for. You can check out the <a href="" class="text-info">Help guide</a> or go back <a href="" class="text-info">Home</a> 
                    </p>
                </div>

                <div class="col-md-5 col-sm-12">
                    <img src="{{ asset('css/echovc_icons/404.png') }}" class="mx-auto d-block" />
                </div>
            </div>
        </section>
      </main>

  </body>
</html>