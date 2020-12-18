<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Create Metrics</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <!-- <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"> -->
        <!-- Styles -->
        <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
        <link href="{{ asset('css/report.css') }}" rel="stylesheet">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link ‎href="https://fonts.googleapis.com/css?family=europa:200600" rel="stylesheet">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

  </head>
  <body>
    <div class="wrapper">
      @include('layouts.sidebar')
    </div>
        <main class="wholeContent">
          <section class="rep d-flex">
            <div class="mr-5">
              Metrics
            </div>

            <div class="d-flex align-self-center" style="font-size:1rem; margin-left:20vw">
              <div class="mr-3" onclick="window.location='/metrics/line'">Line</div>
              <div class="mr-3" onclick="window.location='/metrics/pie'">Pie</div>
              <div class="mr-3" onclick="window.location='/metrics/bar'">Bar</div>
              <div class="mr-3" onclick="window.location='/metrics/dot'" style="width:4rem">Dot Line</div>
              <div class="mr-3" onclick="window.location='/metrics/donut'">Doughnut</div>
            </div>

          </section>

          <div class="container mt-5">
            {!! $chart->container() !!}
          </div>

        </main>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>

        {!! $chart->script() !!}

        <script type="text/javascript">
            var original_api_url = {{ $chart->id }}_api_url;
            $(".sel").change(function(){
                var year = $(this).val();
                {{ $chart->id }}_refresh(original_api_url + "?year="+year);
            });
        </script>
    </body>
</html>
