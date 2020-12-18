<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>{{ $sent_report ? $sent_report->report_title : ''}}</title>
      <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
      <!-- <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"> -->
      <link rel="stylesheet" href="/vendor/chosen/chosen.min.css">
      <!-- Styles -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
      <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
      <link href="{{ asset('css/app.css') }}" rel="stylesheet">
      <link href="{{ asset('css/report.css') }}" rel="stylesheet">
      <link href="{{ asset('css/sample.css') }}" rel="stylesheet">
      <!-- Fonts -->
      <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
      <link ‎href="https://fonts.googleapis.com/css?family=europa:200,600" rel="stylesheet">
      <!-- Scripts -->
      <script src="{{ asset('js/app.js') }}" defer></script>

      <style>
      .form-control:disabled {
        background: #fff !important
      }
      </style>

  </head>
  <body>
    <div class="wrapper">

  @include('layouts.sidebar')
    </div>
    <main class="wholeContent">

      <section class="page ">
        <div class="ml-4 mt-1">
          <img src="/css/icons/stroke.png" alt="">
          <a href="{{url()->previous()}}" style="color:#1B63DC;margin-left:.25rem">{{$from}}</a>
        </div>
          <div class="text-left mt-5 ml-4">
            <h6 style="width: 100%">{{$contact->fname}} from {{$contact->company()->first()->c_name}}</h6>
            <span style="width: 100%; font-size: 10px">{{ $date }}</span>
            
          </div>

          <div class="desktopView  col-md-6 mx-auto">

            <div class="heading mt-4 ">
              <h3>{{ $sent_report ? $sent_report->report_title : '' }}</h3>
              <p class="not-mobile-content"> To: <span class="text-info "> Jane Magnesys for Netflix</span></p>
              
            </div>
            <hr class="shadow not-mobile-content">  

            <div class="sample-content">
              <p class="text-wrap">
                {!! $sent_report ? $sent_report->content : '' !!}
              </p>
            </div>

            <hr class="shadow">
            <small class="text-danger"> &lowast;required</small>
            <div class=" mobileHide">
                @for($i=0;$i<count($texts);$i++)
                <div class="mt-5">
                    <div>
                        <h3> {{ $texts[$i]->title }}<small class="text-danger" style="display:{{$texts[$i]->reqd != 'true' ? 'none':''}}">&lowast;</small></h3>
                        <p class="text-wrap c">{{ $texts[$i]->desc }}</p> 
                    </div>
                    
                    <div>
                        <textarea class="form-control text-wrap" disabled>{{ $texts[$i]->response }}</textarea>
                    </div>
                </div>
                @endfor

                @for($j=0;$j<count($metrics);$j++)
                <div class="mt-5">
                    <div>
                        <h3> {{ $metrics[$j]->title }}<small class="text-danger" style="display:{{$metrics[$j]->reqd != 'true' ? 'none':''}}">&lowast;</small></h3>
                        <p class="text-wrap c">{{ $metrics[$j]->desc }}</p> 
                    </div>
                    
                    <div>
                        <ul class="row list-unstyled col-9">
                            <li class="col-12 p-2 d-flex justify-content-between">
                                <p class="col-4">KPI name </p>
                                <p class="col-4">Format </p>
                                <p class="col-4">KPI value </p>
                            </li>
                            @for($k=0;$k<count($metrics[$j]->kpis);$k++)
                            <li class="col-12 p-2 d-flex justify-content-between">
                                <p class="col-4">{{$metrics[$j]->kpis[$k]->name}}</p>
                                <p class="col-4">{{$metrics[$j]->kpis[$k]->format}} </p>
                                <p class="col-4">{{$metrics[$j]->kpis[$k]->value}}</p>
                            </li>
                            @endfor
                        </ul>
                    </div>
                </div>
                @endfor

                @for ($m=0;$m<count($files);$m++)
                <div class="pitch container ml-n3 mt-5">
                    <h3>{{ $files[$m]->title }}<small class="text-danger" style="display:{{$files[$m]->reqd != 'true' ? 'none':''}}">&lowast;</small></h3>
                    <p class="text-wrap">{{ $files[$m]->desc }}</p>
                    <a href="{{$files[$m]->response}}" class="text-dark">Click to download file</a>
                </div>
                @endfor  

            </div>

      </section>
      <div style="height: 10rem"></div>
    </main>
  </body>
</html>
