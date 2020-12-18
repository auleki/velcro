    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Add Chart</title>
      <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
      <!-- <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"> -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
      <!-- Styles -->
      <link href="{{ asset('css/app.css') }}" rel="stylesheet">
      <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
      <link href="{{ asset('css/report.css') }}" rel="stylesheet">
      <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">

      <!-- Fonts -->
      <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
      <link ‎href="https://fonts.googleapis.com/css?family=europa:200,600" rel="stylesheet">

      <!-- Scripts -->
      <script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/classic/ckeditor.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js"></script>
      <script src="{{ asset('js/app.js') }}" defer></script>
  </head>
<style>
    .add-header a{
        color: #333333;
        font-size: 18px;

    }
  .exact-class{
        border-bottom: 2px solid #19B9FD;
    }
    .card-header{
        border-bottom: none;
        background: #EEEEEE;
    }

    .side-section{

        height: 100vh;
    }

    .wholeContent{
        width: 85%;
    }

    @media (max-width: 500px){
        .wholeContent{
            width: 100% !important;
        }

        select{
            width: 100% !important;
        }
    }

    .add-header a:hover{
        opacity: 0.6;
        padding-left: 5px;
    }

    .hide-metrics {
        display: none
    }
</style>
    <div class="wrapper">
      @include('layouts.sidebar')
    </div>

    <main class="wholeContent mt-2">
        <div class="row">
            <div class="col-md-7 col-xl-9 col-sm-12">


                    <div class="ml-n5 col-sm-12 mt-3 pt-3 row justify-content-center">
                    <div class="col-md-11 col-sm-6 ml-5  ">
                        <div class=" ml-1 mt-3">
                            {{-- <h4>Coca-Cola</h4> --}}
                            <div class="row " style="margin-left: .1em">
                                <p id='chart_title_p'></p>
                                <!-- <i class="fas fa-chevron-down ml-auto"> </i> -->
                            </div>
                        </div>
                        <div>
                            <div class="d-flex justify-content-center" id="spinner" style="display:none !important">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                            <canvas id="myChart" width="400" height="400"></canvas>
                        </div>
                    </div> 
                    </div>

            </div>
            <div class="col-md-5 col-xl-3 col-sm-12 ml-md-n3 pl-md-2 m-3 pt-4 mt-md-n2 side-section" style="">
                <div class="add-header d-flex justify-content-between" >
                    <div>
                        <a href="/add_chart/{{$dashboard}}" class="exact-class" >Metric </a>
                        <a href="/export_report" class="ml-3" >Export </a>

                        <div class="float-right ml-3">
                            <button type='button' onclick='cancelAddMetric()' class="btn btn-default"> Cancel</button>
                            <button type='button' onclick='createChart("{{$dashboard}}")' class="btn btn-primary"> Save</button>
                        </div>

                        <div class="form mt-4">
                            <form action="" class="form-group" id='add_metric_form'>
                                <div class="form-group">
                                    <label for=""> Chart title<small class="text-danger"> &lowast;</small></label>
                                    <input type="text" placeholder="Sales and Exit" class="form-control" id='chart_title'>
                                </div>

                                <div class="form-group">
                                    <label for=""> Chart type<small class="text-danger"> &lowast;</small></label>
                                    <select name="" id="chart_type" class="form-control">
                                        <option value="line"> Line</option>
                                        <option value="bar"> Bar</option>
                                        <option value="radar"> Radar</option>
                                        <option value="pie"> Pie</option>
                                    </select>
                                </div>

                                <!-- <div class="form-group">
                                    <div class="row ml-1 ">
                                        <p class=""> Metric Source<small class="text-danger"> &lowast;</small></p>
                                    </div>
                                    <select name="metric_source" id="metric_source" class="form-control mt-n3" onchange="fetchMetrics(this)">
                                        <option value=""> Select metric source </option>
                                            @foreach($sources as $source)
                                            <option value='{{$source->id}}_{{$source->tool}}_{{$source->name}}' >{{$source->pre}} {{$source->name}}</option>
                                            @endforeach


                                    </select>
                                </div> -->

                                <div class="form-group" id='metrics-cont'>
                                    <div class="row ml-1 ">
                                        <p class=""> Metric</p>
                                        <p class="ml-auto mr-3 text-info">New metric</p>
                                    </div>
                                    <select name="metric" id="metric" class="form-control mt-n3" onchange="selectMetric(this)" autocomplete="off">
                                        <!-- <option value="">Select your metric</option> -->
                                        <option value=""> Select metric source </option>
                                        @foreach($sources as $source)
                                        <optgroup label="{{$source->pre}} {{$source->name}}" style="font-size:12px">
                                            @foreach($source->metrics as $metric)
                                            <option value='{{$source->tool == "google"? $metric->column_name."_".$metric->row : $metric}}' data-row="{{$source->tool == 'google'? $metric->row : $metric}}">{{$source->tool == 'google'?$metric->name:$metric}}</option>
                                            @endforeach
                                        </optgroup>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group" id="selected_metric"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src='/js/selectMetric.js'></script>
    <script src='/js/createChart.js'></script>

    <script>

    </script>
</body>
</html>
